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
            grid-template-rows: 30px 20px 80px 20px 60px 60px 60px;
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

        .myTrailer{
            cursor:pointer;
            background-color: #ff2727;
            color: white;
            font-weight: lighter;
            font-family: Arial, Helvetica, sans-serif;
            /*font-weight: bold;*/
            border-radius: 4px;
            border-width: 0;
            font-size: 15px;
            padding: 1px 15px 1px 15px;
            width: fit-content;
        }

        .myTrailer:hover{
            background-color: #e52323;
        }
        .myTrailer:focus {outline:0;}



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
            grid-template-columns: 300px auto;
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
        p:hover {
            overflow:visible;
        }

    .buttons {
            display: grid;
            /*grid-row-gap: 4px;*/
            grid-template-columns: auto auto;
        }

        .button_item {
            color: whitesmoke;
            padding: 0;
            /*border: solid 1px purple;*/
            height: 25px;
        }

        .section_one {
            margin: 0;
            padding: 100px 190px 0 190px;
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
            float: right;
        }

        .myButtonIcon:focus {outline:0;}
        .myButtonIcon:hover {color: darkgray;}

        .myPerson{
            font-size: 15px;
            align-content: center;
            border-radius: 4px;
            background-color: rgba(51, 51, 51, 0.4);
            color: #313538;
            padding: 0px 5px 0px 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            width: fit-content;
            display: inline-block;
            color: rgba(245, 245, 245, 0.8);
            margin: 2px;
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

        .review-form {
            display: grid;
            grid-template-columns: auto;
            grid-row-gap: -5px;
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

    </style>

</head>
<body>

<div class="section_one">
    <div class="grid-container-two">
        <div class="grid-item-two">
            <div class="movie_card" id="tenet" >
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
                                echo '<img src="' . $row["poster"] . '" style="width: 300px; border-radius: 8px; max-height: 445px;">';
                            }
                        }
                        ?>
                </div>
                <div class="movie_specs">
                    <div class="grid-container">
                        <?php
                        $conn = new mysqli("localhost", "root", "", "reviewsite");
                        if($conn->connect_error) {
                            exit('Could not connect');
                        }

                        $title = trim($_GET["title"]);
                        $sqlCast = "SELECT title, runtime, year, description, poster, trailer FROM movie WHERE title = '$title'";
                        $result = $conn->query($sqlCast);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="grid-item">
                            <p style="font-weight: bold; font-size: 25px; margin:0; padding:0; float: left;">' . $row["title"] . '</p>
                        </div>
                        <div class="grid-item">
                            <p style="opacity: 0.6; font-size: 15px; margin:0; padding:0; float: left;">' . $row["year"] . '  ●  ' . $row["runtime"] . ' minutes </p>
                        </div>
                        <div class="grid-item">
                            <p style="opacity: 0.9; font-size: 17px; margin:0; padding:0; float: left; text-align: left">' . $row["description"] . '</p>
                        </div>
                        <div class="grid-item">
                            <a href="' . $row["trailer"] . '" target="_blank"><button style="float: left" class="myTrailer"><i class="fas fa-play-circle"></i> Trailer</button></a>
                        </div>';
                            }
                        }
                        ?>

                        <div class="grid-item">
                            <p style="opacity: 0.9; font-size: 15px; margin:0; padding:0; float: left;">Categories</p> <br>
                            <div style="height: 50px; padding: 5px; float: left;">
                                <?php
                                $conn = new mysqli("localhost", "root", "", "reviewsite");
                                if($conn->connect_error) {
                                    exit('Could not connect');
                                }

                                $title = trim($_GET["title"]);
                                $sqlType = "SELECT catname FROM type WHERE title = '$title'";
                                $result = $conn->query($sqlType);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($rowT = $result->fetch_assoc()) {
                                        echo '<div class="myPerson">' . $rowT["catname"] . '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "reviewsite");
                        if($conn->connect_error) {
                            exit('Could not connect');
                        }

                        $title = trim($_GET["title"]);
                        $sqlCast = "SELECT name as director FROM cast WHERE role = 'director' AND title = '$title'";
                        $result = $conn->query($sqlCast);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="grid-item">
                            <p style="opacity: 0.9; font-size: 15px; margin:0; padding:0; float: left;">Director</p> <br>
                            <div style="height: 50px; padding: 5px; float: left;">
                                <div class="myPerson">' . $row["director"] . '</div>
                            </div>
                        </div>';
                            }
                        }
                        ?>

                        <div class="grid-item">
                            <p style="opacity: 0.9; font-size: 15px; margin:0; padding:0; float: left;">Cast</p> <br>
                            <div style="height: 50px; padding: 5px; float: left;">

                                <?php
                                $conn = new mysqli("localhost", "root", "", "reviewsite");
                                if($conn->connect_error) {
                                    exit('Could not connect');
                                }

                                $title = trim($_GET["title"]);
                                $sqlCast = "SELECT name FROM cast WHERE role = 'actor' AND title = '$title'";
                                $result = $conn->query($sqlCast);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="myPerson">' . $row["name"] . '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="movie_specs" style="background-color: rgba(0, 0, 0, 0.4)">
                    <div class="buttons" style="float: bottom">
                        <div class="button_item" >
                            <p><i class="fas fa-star"></i>
                            <?php
                            $conn = new mysqli("localhost", "root", "", "reviewsite");
                            if($conn->connect_error) {
                                exit('Could not connect');
                            }

                            $title = trim($_GET["title"]);
                            $sqlCast = "SELECT TRUNCATE(SUM(rate)/COUNT(rate), 1) as note FROM review WHERE title = '$title' GROUP BY '$title'";
                            $result = $conn->query($sqlCast);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo $row["note"];
                                }
                            } else echo "0.0";
                            ?>
                            </p>
                        </div>
                        <div class="button_item">
<!--                            <button style="float: right" class="myReview">Review</button>-->
                            <p style="float: right;">
                                <?php
                                $conn = new mysqli("localhost", "root", "", "reviewsite");
                                if($conn->connect_error) {
                                    exit('Could not connect');
                                }

                                $title = trim($_GET["title"]);
                                $sqlCast = "SELECT COUNT(rate) as note FROM review WHERE title = '$title' GROUP BY '$title'";
                                $result = $conn->query($sqlCast);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo $row["note"] . " reviews";
                                    }
                                }
                                else echo "no reviews"
                                ?>
                            </p>
                        </div>
                </div>
            </div>
            </div>
        </div>

        <?php include 'GET/get_reviews.php';?>

    </div>
</div>

<br><br>
</body>
</html>