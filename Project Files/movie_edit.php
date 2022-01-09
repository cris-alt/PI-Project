<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ||  htmlspecialchars($_SESSION["userlevel"]) == "user"){
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$title = trim($_GET["initial_title"]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT m.title, m.year, m.poster, m.runtime, m.description, m.trailer, c.name 
FROM movie m JOIN cast c on m.title = c.title 
WHERE c.role = 'director' AND m.title = '$title'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        $director = $row["name"];
        $year = $row["year"];
        $runtime = $row["runtime"];
        $description = $row["description"];
        $trailer = $row["trailer"];
        $poster = $row["poster"];
    }
}
$conn->close();

//$director = $year = $runtime = $description = $trailer = $poster =
$actor1 = $actor2 = $actor3 = $genre1 = $genre2 = $genre3 = "34";
$title_err = $director_err = $year_err = $runtime_err = $description_err = $trailer_err = $poster_err = $actor1_err = $actor2_err = $actor3_err = $genre_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate title
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter the title.";
    } else{
        // Prepare a select statement
        $sql = "SELECT title FROM movie WHERE title = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_title);

            // Set parameters
            $param_title = trim($_POST["title"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $title_err = "This title already exists.";
                } else{
                    $title = trim($_POST["title"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate director
    if(empty(trim($_POST["director"]))){
        $director_err = "Please enter the director name.";
    } else{
        $director = trim($_POST["director"]);
    }

    // Validate year
    if(empty(trim($_POST["year"]))){
        $year_err = "Please enter a year.";
    } elseif(strlen(trim($_POST["year"])) < 4 or strlen(trim($_POST["year"])) > 5){
        $year_err = "Please enter a valid year.";
    } else{
        $year = trim($_POST["year"]);
    }

    // Validate runtime
    if(empty(trim($_POST["runtime"]))){
        $runtime_err = "Please enter the runtime.";
    } elseif(trim($_POST["runtime"]) < 0){
        $runtime_err = "Please enter a valid runtime.";
    } else{
        $runtime = trim($_POST["runtime"]);
    }

    // Validate description
    if(empty(trim($_POST["description"]))){
        $description_err = "Please enter a description.";
    } else{
        $description = trim($_POST["description"]);
    }

    // Validate trailer
//    $trailer = filter_var($trailer, FILTER_SANITIZE_URL);
    if(empty(trim($_POST["trailer"]))){
        $trailer_err = "Please enter a trailer link.";
    } elseif(filter_var(trim($_POST["trailer"]), FILTER_VALIDATE_URL) != TRUE){
        $trailer_err = "Please enter a valid link.";
    } else{
        $trailer = trim($_POST["trailer"]);
    }

    // Validate poster
//    $poster = filter_var($poster, FILTER_SANITIZE_URL);
    if(empty(trim($_POST["poster"]))){
        $poster_err = "Please enter a poster link.";
    } elseif(filter_var(trim($_POST["poster"]), FILTER_VALIDATE_URL) != TRUE or strtolower(substr(getimagesize(trim($_POST["poster"]))['mime'], 0, 5)) != 'image' ){
        $poster_err = "Please enter a valid link.";
    } else{
        $poster = trim($_POST["poster"]);
    }

    // Validate actors
    if(empty(trim($_POST["actor1"]))){
        $actor1_err = "Please enter an actor.";
    } else{
        $actor1 = trim($_POST["actor1"]);
    }
    if(empty(trim($_POST["actor2"]))){
        $actor2_err = "Please enter an actor.";
    } else{
        $actor2 = trim($_POST["actor2"]);
    }
    if(empty(trim($_POST["actor3"]))){
        $actor3_err = "Please enter an actor.";
    } else{
        $actor3 = trim($_POST["actor3"]);
    }

    // Validate genres
    if(trim($_POST["genre1"]) == '' && trim($_POST["genre2"]) == '' && trim($_POST["genre3"]) == ''){
        $genre_err = "Please enter at least one genre.";
    } else{
        $genre1 = trim($_POST["genre1"]);
        $genre2 = trim($_POST["genre2"]);
        $genre3 = trim($_POST["genre3"]);
    }

    $main_insert = FALSE;
    // Check input errors before inserting in database
    if(empty($title_err) && empty($director_err) && empty($description_err) && empty($year_err) && empty($runtime_err) && empty($trailer_err) && empty($poster_err) && empty($actor1_err) && empty($actor2_err) && empty($actor3_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO movie (title, year, runtime, description, trailer, poster) VALUES (?, ?, ?, ?, ?, ?)";
        $sql_d = "INSERT INTO cast (title, role, name) VALUES (?, ?, ?)";
        $sql_a1 = "INSERT INTO cast (title, role, name) VALUES (?, ?, ?)";
        $sql_a2 = "INSERT INTO cast (title, role, name) VALUES (?, ?, ?)";
        $sql_a3 = "INSERT INTO cast (title, role, name) VALUES (?, ?, ?)";

        if(($stmt = mysqli_prepare($link, $sql)) && ($stmt_d = mysqli_prepare($link, $sql_d)) && ($stmt_a1 = mysqli_prepare($link, $sql_a1)) && ($stmt_a2 = mysqli_prepare($link, $sql_a2)) && ($stmt_a3 = mysqli_prepare($link, $sql_a3))){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siisss", $param_title, $param_year, $param_runtime, $param_description, $param_trailer, $param_poster);
            mysqli_stmt_bind_param($stmt_d, "sss", $param_title_d, $param_role_d, $param_name_d);
            mysqli_stmt_bind_param($stmt_a1, "sss", $param_title_a1, $param_role_a1, $param_name_a1);
            mysqli_stmt_bind_param($stmt_a2, "sss", $param_title_a2, $param_role_a2, $param_name_a2);
            mysqli_stmt_bind_param($stmt_a3, "sss", $param_title_a3, $param_role_a3, $param_name_a3);

            // Set parameters
            $param_title = trim($_POST["title"]);
            $param_year = trim($_POST["year"]);
            $param_description = trim($_POST["description"]);
            $param_runtime = trim($_POST["runtime"]);
            $param_trailer = trim($_POST["trailer"]);
            $param_poster = trim($_POST["poster"]);
            // Set parameters
            $param_title_d = trim($_POST["title"]);
            $param_name_d = trim($_POST["director"]);
            $param_role_d = "director";
            // Set parameters
            $param_title_a1 = trim($_POST["title"]);
            $param_name_a1 = trim($_POST["actor1"]);
            $param_role_a1 = "actor";
            // Set parameters
            $param_title_a2 = trim($_POST["title"]);
            $param_name_a2 = trim($_POST["actor2"]);
            $param_role_a2 = "actor";
            // Set parameters
            $param_title_a3 = trim($_POST["title"]);
            $param_name_a3 = trim($_POST["actor3"]);
            $param_role_a3 = "actor";

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt_d) && mysqli_stmt_execute($stmt_a1) && mysqli_stmt_execute($stmt_a2) && mysqli_stmt_execute($stmt_a3)){
                // Redirect
                echo 'alert("Movie added successfully!")';
                $main_insert = TRUE;
                header("location: admin_movie_list.php");

            } else{
                echo 'alert("Oops! Something went wrong. Please try again later.")';
            }

            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt_d);
            mysqli_stmt_close($stmt_a1);
            mysqli_stmt_close($stmt_a2);
            mysqli_stmt_close($stmt_a3);

        }

    }



    if(empty($genre_err) && $main_insert){
        if(! empty($genre1)){
            // Prepare an insert statement
            $sql_g1 = "INSERT INTO type (catname, title) VALUES (?, ?)";

            if($stmt_g1 = mysqli_prepare($link, $sql_g1)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt_g1, "ss", $param_catname_g1, $param_title_g1);

                // Set parameters
                $param_catname_g1 = trim($_POST["genre1"]);;
                $param_title_g1 = trim($_POST["title"]);;

                mysqli_stmt_execute($stmt_g1);
                mysqli_stmt_close($stmt_g1);
            }
        }

        if(! empty($genre2)){
            // Prepare an insert statement
            $sql_g2 = "INSERT INTO type (catname, title) VALUES (?, ?)";

            if($stmt_g2 = mysqli_prepare($link, $sql_g2)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt_g2, "ss", $param_catname_g2, $param_title_g2);

                // Set parameters
                $param_catname_g2 = trim($_POST["genre2"]);;
                $param_title_g2 = trim($_POST["title"]);;

                mysqli_stmt_execute($stmt_g2);
                mysqli_stmt_close($stmt_g2);
            }
        }

        if(! empty($genre3)){
            // Prepare an insert statement
            $sql_g3 = "INSERT INTO type (catname, title) VALUES (?, ?)";

            if($stmt_g3 = mysqli_prepare($link, $sql_g3)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt_g3, "ss", $param_catname_g3, $param_title_g3);

                // Set parameters
                $param_catname_g3 = trim($_POST["genre3"]);;
                $param_title_g3 = trim($_POST["title"]);;

                mysqli_stmt_execute($stmt_g3);
                mysqli_stmt_close($stmt_g3);
            }
        }
    }

    // Close connection
    mysqli_close($link);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-black bg-black">
    <a class="navbar-brand disabled" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="admin_dashboard.php">Home </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_movie_list.php">Movies</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Add New Movies</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="float: right" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>
<div class="section">
    <form action="

								<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <?php
//        if(!empty($login_err)){
//            echo '
//
//								<div class="alert alert-danger" role="alert">' . $login_err . '</div>';
//        }
        ?> <table>
            <tr>
                <td style="padding: 20px; float: top">
                    <img src="IMAGES/movie_poster_default.png" id="poster_frame" style="width: 445px; border-radius: 5px; float: top">
                </td>
                <td style="padding: 20px">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Title</span>
                        </div>
                        <input type="text" placeholder="Enter the movie title" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $title; ?>">
                        <span class="invalid-feedback"> <?php echo $title_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Director</span>
                        </div>
                        <input type="text" placeholder="Enter the movie director" name="director" class="form-control <?php echo (!empty($director_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $director; ?>">
                        <span class="invalid-feedback"> <?php echo $director_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Year</span>
                        </div>
                        <input type="number" placeholder="Enter the year of release" name="year" class="form-control <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $year; ?>">
                        <span class="invalid-feedback"> <?php echo $year_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Runtime</span>
                        </div>
                        <input type="number" placeholder="Enter the movie runtime" name="runtime" class="form-control <?php echo (!empty($runtime_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $runtime; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="">minutes</span>
                        </div>
                        <span class="invalid-feedback"> <?php echo $runtime_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Genres</label>
                        </div>
                        <select id="inputGroupSelect01" name="genre1" class="custom-select form-control <?php echo (!empty($genre_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $genre1; ?>" <option value="<?php echo $genre1; ?>"></option> <?php include 'GET/get_genre.php';?>
                        </select>
                        <select id="inputGroupSelect02" name="genre2" class="custom-select form-control <?php echo (!empty($genre_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $genre2; ?>" <option value="<?php echo $genre2; ?>"></option> <?php include 'GET/get_genre.php';?>
                        </select>
                        <select id="inputGroupSelect03" name="genre3" class="custom-select form-control <?php echo (!empty($genre_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $genre3; ?>" <option value="<?php echo $genre3; ?>"></option> <?php include 'GET/get_genre.php';?>
                        </select>
                        <span class="invalid-feedback"> <?php echo $genre_err; ?> </span>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Cast</span>
                        </div>
                        <input type="text" placeholder="Enter the actor's name" name="actor1" class="form-control <?php echo (!empty($actor1_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $actor1; ?>">
                        <input type="text" placeholder="Enter the actor's name" name="actor2" class="form-control <?php echo (!empty($actor2_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $actor2; ?>">
                        <input type="text" placeholder="Enter the actor's name" name="actor3" class="form-control <?php echo (!empty($actor3_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $actor3; ?>">
                        <span class="invalid-feedback"> <?php echo $actor1_err; ?> <?php echo $actor2_err; ?>  <?php echo $actor3_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Description</span>
                        </div>
                        <textarea name="description" placeholder="Enter a short description" rows="3" cols="50" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $description; ?>"> </textarea>
                        <span class="invalid-feedback"> <?php echo $description_err; ?> </span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Trailer</span>
                        </div>
                        <input type="text" name="trailer" placeholder="Enter a link to the movie trailer" class="form-control <?php echo (!empty($trailer_err)) ? 'is-invalid' : ''; ?> " value="<?php echo $trailer; ?>">
                        <span class="invalid-feedback"><?php echo $trailer_err; ?></span>
                    </div>

                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Poster</span>
                        </div>
                        <input type="text" name="poster" id="poster_link" placeholder="Enter a link to the movie poster" onchange="vizualize_poster()" class="form-control <?php echo (!empty($poster_err)) ? 'is-invalid' : ''; ?> " value="<?php echo $poster; ?>">
                        <span class="invalid-feedback"><?php echo $poster_err; ?></span>
                    </div>

                    <br>
                    <br>
                    <table style="width: 100%; align-content: center">
                        <tr>
                            <td style="float: left">
                                <button class="myButton myButtonSecondary" type="reset">Cancel</button>
                            </td>
                            <td style="float: right">
                                <button class="myButton myButtonPrimary" type="submit">Save</button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    function checkURL(url) {
        return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
    }

    function vizualize_poster() {
        if(checkURL(document.getElementById("poster_link").value) == true)
            document.getElementById("poster_frame").src = document.getElementById("poster_link").value;
        else document.getElementById("poster_frame").src = "IMAGES/movie_poster_default.png";
    }
</script>
<!--    <h1 class="my-5">Hi, admin <b>--> <?php //echo htmlspecialchars($_SESSION["username"]); ?>
<!--</b>. Welcome to our site.</h1>-->
<!--    <p>-->
<!--        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
<!--        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>-->
<!--    </p>-->
</body>
</html>