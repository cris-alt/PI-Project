<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ||  htmlspecialchars($_SESSION["userlevel"]) == "user"){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Movie</title>

    <style>
        .grid-container-two {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 550px 550px;
            padding: 50px;
        }

        .grid-item {
            background-color: #191919;
            color: whitesmoke;
            padding: 8px;
            font-size: 16px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 10px;
        }

        .movie_card {
            display: grid;
            grid-column-gap: 10px;
            grid-row-gap: 10px;
            grid-template-columns: 100px auto 50px;
        }

        .movie_specs {
            color: whitesmoke;
            padding: 8px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            border-radius: 8px;
        }

        .buttons {
            display: grid;
            grid-row-gap: 4px;
            grid-template-columns: auto;
            grid-template-rows: auto auto auto;
        }

        .button_item {
            color: whitesmoke;
            padding: 8px;
        }

        .section_one {
            margin: 0;
            padding: 0 170px 0 170px;
        }

        .myButtonIcon{
            background-color: rgba(0, 0, 0, 0);
            border-width: 0;
            padding: 0;
            color: whitesmoke;
            text-align: center;
            font-size: 16px;
            cursor:pointer;
            outline: none;
        }

        .myButtonIcon:focus {outline:0;}
        .myButtonIcon:hover {color: darkgray;}

        .modal-content {
            background-color: #191919;
        }
    </style>

</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <style>
        .grid-container {
            display: grid;
            grid-column-gap: 10px;
            grid-row-gap: 18px;
            /*border: solid 1px aqua;*/
            grid-template-columns: auto;
            margin: -10px;
            grid-template-rows: 30px 20px 20px 80px 60px 60px 60px;
        }

        .grid-item {
            background-color: #191919;
            color: whitesmoke;
            padding: 2px;
            font-size: 16px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 10px;
            /*border: solid 1px lightpink;*/
        }


        .grid-container-two {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: auto;
            padding: 0;
            /*border: solid 1px red;*/
        }

        .grid-item-two {
            background-color: #191919;
            color: whitesmoke;
            padding: 8px;
            font-size: 16px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 10px;
            /*border: solid 1px blue;*/
        }

        .movie_card {
            display: grid;
            grid-column-gap: 10px;
            grid-row-gap: -20px;
            grid-template-columns: 120px auto;
            /*border: solid 1px green;*/
        }

        .movie_specs {
            display: grid;
            grid-template-columns: auto;
            color: whitesmoke;
            padding: 8px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            border-radius: 8px;
            /*border: solid 1px yellow;*/
        }

        .infos {
            display: grid;
            grid-template-rows: auto auto auto;
            grid-column-gap: 10px;
            grid-row-gap: -20px;
            border-radius: 8px;
            /*border: solid 1px red;*/
        }
        .line {
            display: grid;
            grid-template-columns: auto;
            color: whitesmoke;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            border-radius: 8px;
            /*border: solid 1px darkslategray;*/
        }

        .section {
            margin: 0;
            padding: 200px 500px 0 500px;
        }


    </style>

</head>
<body>

<div class="section">
    <div class="grid-container-two">
        <div class="grid-item" >
    <div class="movie_card" >
    <div class="movie_specs" style="padding: 0">
        <?php
        $conn = new mysqli("localhost", "root", "", "reviewsite");
        if($conn->connect_error) {
            exit('Could not connect');
        }

        $title = trim($_GET["title"]);
        $sqlCast = "SELECT poster FROM movie WHERE title = '$title'";
        $result = $conn->query($sqlCast);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<img src="' . $row["poster"] . '" style="width: 120px; margin: 5px; float: left; border-radius: 8px">';
            }
        }
        ?>
    </div>
    <div class="movie_specs">
        <div class="infos">
        <?php
        $conn = new mysqli("localhost", "root", "", "reviewsite");
        if($conn->connect_error) {
            exit('Could not connect');
        }

        $title = trim($_GET["title"]);
$sql = "SELECT m.title, m.year, c.name 
FROM movie m JOIN cast c on m.title = c.title 
WHERE c.role = 'director' and m.title = '$title'" ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="line"><p style="font-weight: bold; font-size: 35px; margin:0; padding:0">' .$row["title"]. '</p> </div>
        <div class="line"><p style="opacity: 0.6; font-size: 20px; margin:0; padding:0">' .$row["year"]. '</p> </div>';
            }
        }
        ?>

        <?php
        $conn = new mysqli("localhost", "root", "", "reviewsite");
        if($conn->connect_error) {
            exit('Could not connect');
        }

        $title = trim($_GET["title"]);
        $sqlCast = "SELECT COUNT(rate) as number FROM review WHERE title = '$title' GROUP BY '$title'";
        $result = $conn->query($sqlCast);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo  '<div class="line"><p style="opacity: 0.6; font-size: 20px; margin:0; padding:0">' .$row["number"]. ' reviews</p> </div>';
            }
        } else echo '<div class="line"><p style=" font-size: 20px; margin:0; padding:0">No reviews yet</p> </div>';
        ?>

        </div>
    </div>
</div>
</div>
    </div>
    <br>
    <div class="grid-container-two">
        <div class="grid-item" style="padding: 20px">
            <p style="font-size: 25px">Are you sure you want to delete this movie?</p>
            <form action="delete_movie.php" method="get" >
                <button style="float: left; color: #950101" id="delete" class="myButtonIcon" name="title" value="<?php echo trim($_GET["title"]); ?>">
                    DELETE
                </button>

                <button style="float: right" id="delete" class="myButtonIcon" name="title" value="ABORT_DELETION">
                    CANCEL
                </button>
            </form>
        </div>
    </div>
</div>
</div>


</body>
</html>

</body>
</html>