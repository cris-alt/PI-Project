<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ||  htmlspecialchars($_SESSION["userlevel"]) == "admin"){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo trim($_GET["title"]); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 50px;
            padding-top: 0;
            width: 120px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
            font-size: 20px;
        }

        .rating label:last-child .icon {
            color: #000;
            font-size: 20px;
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
            color: #09f;
            font-size: 20px;
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #09f;
            font-size: 20px;
        }
    </style>
    <script>
        $(':radio').change(function() {
            console.log('New star rating: ' + this.value);
        });
    </script>
    <script>
        function setVisible(){
            document.getElementById("the-form").style.display = "block";
        }
    </script>

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
            display: inline-block;
        }

        .myTrailer:hover{
            background-color: #e52323;
        }
        .myTrailer:focus {outline:0;}

        .myWatchlist{
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
            display: inline-block;
            float: left;
            margin-left: 10px;
        }

        .myWatchlist:hover{
            background-color: #e52323;
        }
        .myWatchlist:focus {outline:0;}

        .myReview{
            cursor:pointer;
            background-color: #070707;
            color: white;
            font-weight: lighter;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 0px 8px 8px 0px;
            border-width: 0;
            font-size: 20px;
            padding: 5px 85px 5px 85px;
            width: fit-content;
            margin: -8px -8px -8px -8px;

        }

        .myReview:hover{
            background-color: #000000;
        }
        .myReview:focus {outline:0;}

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
            padding: 50px 190px 0 190px;
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
            grid-template-columns: fit-content(100%) auto auto;
            grid-column-gap: 10px;
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

        textarea {
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            border-radius: 8px;
            color: whitesmoke;
        }

        textarea:focus {
            border: rgba(0, 0, 0, 0.5);
            outline: 0;
        }

        .submit-button {
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            border-radius: 8px;
            color: whitesmoke;
            margin-top: 10px;
            padding: 5px;
        }
    </style>

</head>
<body>

<div class="section_one">
    <div class="grid-container-two">
        <div class="grid-item-two">
            <div class="movie_card">
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
                            
                            
                            ';
                            }
                        }
                        ?>

                        <?php
                        $conn = new mysqli("localhost", "root", "", "reviewsite");
                        if($conn->connect_error) {
                            exit('Could not connect');
                        }

                        $uname = $_SESSION["username"];
                        $title = trim($_GET["title"]);

                        $sql = "SELECT username FROM watchlist WHERE title = '$title' and username = '$uname'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<form method="get" action="remove_from_watchlist.php">
                            <input name= title value="' . $title . '" hidden>
                            <button class="myWatchlist"><i class="fas fa-stream"></i> Remove from Your Watchlist</button></form>
                        </div>';

                        } else echo '<form method="get" action="add_to_watchlist.php">
                            <input name= title value="' . $title . '" hidden>
                            <button class="myWatchlist"><i class="fas fa-stream"></i> Add to Watchlist</button></form>
                        </div>';
                        $conn->close();
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
                            $conn->close();
                            ?>
                            </p>
                        </div>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "reviewsite");
                        if($conn->connect_error) {
                            exit('Could not connect');
                        }

                        $uname = $_SESSION["username"];
                        $title = trim($_GET["title"]);

                        $sql = "SELECT rate FROM review WHERE title = '$title' and username = '$uname'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                                echo '<div class="button_item">
                            <button style="float: right; padding-left: 55px; padding-right: 55px; opacity: 0.8" class="myReview" >You rated ' . $row["rate"] . ' <i class="fas fa-star" style="font-size: 18px"></i></button>
                            </div>';

                        } else echo '<div class="button_item">
                            <button style="float: right" class="myReview" onclick="setVisible()">Review</button>
                        </div>';
                        $conn->close();
                        ?>
                </div>
            </div>
            </div>
        </div>

        <div class="grid-item-two"  id="the-form" style="display: none">
            <div>
                <form class="review-form" id="review-form" method="GET" action="add_review.php">
                    <div class="rating" id="review-stars">
                    <label>
                        <input type="radio" name="review-stars" value="1" />
                        <span class="icon"><i class="fas fa-star"></i></span>
                    </label>
                    <label>
                        <input type="radio" name="review-stars" value="2" />
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                    </label>
                    <label>
                        <input type="radio" name="review-stars" value="3" />
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                    </label>
                    <label>
                        <input type="radio" name="review-stars" value="4" />
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                    </label>
                    <label>
                        <input type="radio" name="review-stars" value="5" />
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="icon"><i class="fas fa-star"></i></span>
                    </label>
                </div>
                    <textarea rows="3" placeholder=" Add a review text." name="review-text"></textarea>
<!--                    the title-->
                    <input type="text" name="title" hidden <?php echo 'value = " ' . $title .  ' "'; ?> />
                    <button class="submit-button" type="submit">Submit Review</button>



                </form>
            </div>
        </div>

        <?php include 'GET/get_reviews.php';?>

    </div>
</div>

<br><br>
</body>
</html>