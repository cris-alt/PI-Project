<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ||  htmlspecialchars($_SESSION["userlevel"]) == "admin"){
    header("location: login.php");
    exit;
}

echo ' 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">
 <style>
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

        .review {
            display: grid;
            grid-template-columns: auto;
            grid-row-gap: 5px;
            color: whitesmoke;
            padding: 4px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            border-radius: 8px;
            /*border: solid 1px yellow;*/
        }

        .review-data {
            display: grid;
            grid-template-columns: auto auto;
            color: whitesmoke;
            font-family: Arial, Helvetica, sans-serif;
            /*border: solid 1px yellow;*/
        }

        .username {
            font-size: 14px;
            color: whitesmoke;
            opacity: 0.6;
            float: left;
        }

        .date {
            font-size: 14px;
            color: whitesmoke;
            opacity: 0.6;
            text-align: right;
        }

        .review-text {
            font-size: 15px;
            color: whitesmoke;
            float: left;
        }

        .submit-button {
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            border-radius: 8px;
            color: whitesmoke;
            margin-top: 10px;
            padding: 5px;
        }
    </style>';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";

$stars = $_GET['review-stars'];
$text = addslashes(trim($_GET['review-text']));
$title = addslashes(trim($_GET["title"]));
$uname = $_SESSION["username"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql2 = "INSERT INTO review (rate, username, title, review)
	VALUES ('$stars', '$uname', '$title', '$text')";

if (mysqli_query($conn, $sql2)) {
//    $location = "location: movie_page.php?title=" . $title;
//   header($location);
    echo '<center><br><br><br><br><br><br><br><br>
<div class="grid-item-two" style="width: 40%">
            <div class="review">
            <div class="review-text" style="opacity: 0.7">Your review has been added successfuly!</div><br>
                <div class="review-data">
                    <div class="username"><i class="far fa-user-circle"></i> ' . $uname . '</div>
                </div>
            <div>';
        for($i = 0; $i < $stars; $i++)
             echo '<span><i class="fas fa-star"></i></span>';
        echo ' </div>
                <div class="review-text">' . $text . '</div>
            </div>
        </div>
        <br>

<button onclick="history.back()" class="submit-button">Go Back</button>

</center>';


} else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);

?>


