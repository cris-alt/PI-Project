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
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <link href='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>

    <style>
        body {
            background-color: black;
        }

        .welcome_banner {
            width: 1200px;
            height: 300px;
            background-color: #950101;
            border-radius: 10px;
            margin: auto;
            padding: 50px;
            text-align: center;
            background-image: url("IMAGES/circles_back.png");
            background-repeat: no-repeat;
            background-size: cover;
            border: 0px;
        }

        .pbanner {
            vertical-align: center;
            color: #f0f0f0;
            font-size: 100px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        .grid-container {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: auto auto auto;
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

        .section_one {
            margin: 0;
            padding: 0 170px 0 170px;
        }
    </style>
    <style>
        .grid-container-two {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 250px 250px 250px 250px 250px;
            padding: 10px 45px 10px 45px;
            /*border: solid 1px red;*/
        }

        .grid-item {
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
            grid-row-gap: 10px;
            grid-template-columns: auto;
            grid-template-rows: auto auto 40px;
            /*border: solid 1px green;*/
        }

        .movie_specs {
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
            padding: 0 50px 0 50px;
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

        .welcome_banner {
            width: 1350px;
            height: 300px;
            background-color: #950101;
            border-radius: 10px;
            margin: auto;
            padding: 50px;
            text-align: center;
            background-image: url("IMAGES/circles_back.png");
            background-repeat: no-repeat;
            background-size: cover;
            border: 0px;
        }

        .pbanner {
            vertical-align: center;
            color: #f0f0f0;
            font-size: 100px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        .my-nav {
            font-size: 20px;
            background-color: rgba(0, 0, 0, .8);
        }

        .grid-container-main {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: auto;
            padding: 100px;
            /*border: solid 2px white;*/

        }

        .grid-container-cards {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 250px 250px 250px 250px 250px;
            /*border: solid 2px green;*/
            margin: 0;
        }

        .section-title {
            font-family: Arial, Helvetica, sans-serif;
            /*font-weight: bold;*/
            font-weight: lighter;
            font-size: 40px;
            color: whitesmoke;
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .gallery {
            background: black;
        }

        .gallery-cell {
            width: 66%;
            height: 200px;
            margin-right: 10px;
            background: #8C8;
            counter-increment: gallery-cell;
        }

        /* cell number */
        .gallery-cell:before {
            display: block;
            text-align: center;
            content: counter(gallery-cell);
            line-height: 200px;
            font-size: 80px;
            color: white;
        }

        .flickity-prev-next-button {
            background-color: black;
            top: 50%;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            /* vertically center */
            transform: translateY(-50%);
        }

        .flickity-prev-next-button.previous { left: -50px; }
        .flickity-prev-next-button.next { right: -50px; }

        .grid-container-levels {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 150px 150px 150px 150px 150px 150px 150px 150px;
            /*padding: 10px 45px 10px 45px;*/

        }

        .level{
            display: grid;
            grid-template-rows: 100px 50px;
            grid-rows-gap: 10px ;
        }
        .grid-item-levels {
            display: grid;
            grid-template-rows: 15px 40px 15px;
            grid-rows-gap: 10px 10px;
            background-color: rgba(149, 1, 1, 1);
            color: whitesmoke;
            padding: 8px;
            font-size: 15px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            border-radius: 10px;
            border: solid 4px #950101;
        }
        .grid-item-levels:hover {
            background-color: rgba(149, 1, 1, .9);
        }
        .checked-level {
            background-color: rgba(196, 196, 196, 1);
            color: gray;
            border: solid 4px rgb(196, 196, 196);
        }
        .checked-level:hover {
            background-color: rgba(196, 196, 196, .9);
        }

        .grid-item-levels-description {
            color: #950101;
            padding: 2px;
            font-size: 15px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        .checked-desc {
            color: rgb(196, 196, 196);
        }

        .grid-container-review {
            display: grid;
            grid-column-gap: 10px;
            grid-template-columns: auto auto auto;
            padding: 0;
            /*border: solid 1px red;*/
        }

        .grid-item-review {
            background-color: red;
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

        /*.gallery, .flickity-viewport, .flickity-slider {*/
        /*    min-height: 490px;*/
        /*}*/

        .flickity-page-dots .dot{
            opacity: .25;
        }

        .flickity-page-dots .dot.is-selected {
            filter: alpha(opacity=100);
            opacity: .5;
        }

    </style>

    <script>
        function showDetails(str){
            document.getElementById(str).style.display = "block";
        }

        function hideDetails(str){
            document.getElementById(str).style.display = "none";
        }
    </script>

</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-black bg-black my-nav">
    <a class="navbar-brand disabled" href="user_dashboard.php">ReviewSite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="user_dashboard.php">Home </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="categories.php">Movies</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="user_profile.php">Profile</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="float: right" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<div class="grid-container-main">

    <p class="section-title">Your Current User Level</p>
    <div class="grid-container-levels">
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 1) echo "checked-level";?>" onmouseover="showDetails('level1')" onmouseout="hideDetails('level1')">
                <p>Level</p>
                <p style="font-size: 30px">1</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 1) echo "checked-desc";?>" id="level1" style="display: none">
                <p>Create an account.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 2) echo "checked-level";?>" onmouseover="showDetails('level2')" onmouseout="hideDetails('level2')">
                <p>Level</p>
                <p style="font-size: 30px">2</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 2) echo "checked-desc";?>" id="level2" style="display: none">
                <p>Create your watchlist.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 3) echo "checked-level";?>" onmouseover="showDetails('level3')" onmouseout="hideDetails('level3')">
                <p>Level</p>
                <p style="font-size: 30px">3</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 3) echo "checked-desc";?>" id="level3" style="display: none">
                <p>Rate 5 movies.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 4) echo "checked-level";?>" onmouseover="showDetails('level4')" onmouseout="hideDetails('level4')">
                <p>Level</p>
                <p style="font-size: 30px">4</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 4) echo "checked-desc";?>" id="level4" style="display: none">
                <p>Review 10 movies.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 5) echo "checked-level";?>" onmouseover="showDetails('level5')" onmouseout="hideDetails('level5')">
                <p>Level</p>
                <p style="font-size: 30px">5</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 5) echo "checked-desc";?>" id="level5" style="display: none">
                <p>Review 25 movies.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 6) echo "checked-level";?>"  onmouseover="showDetails('level6')" onmouseout="hideDetails('level6')">
                <p>Level</p>
                <p style="font-size: 30px">6</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 6) echo "checked-desc";?>" id="level6" style="display: none">
                <p>Review 50 movies.</p>
            </div>
        </div>
        <div class="level">
            <div class="grid-item-levels <?php if($_SESSION["level"] >= 7) echo "checked-level";?>" onmouseover="showDetails('level7')" onmouseout="hideDetails('level7')">
                <p>Level</p>
                <p style="font-size: 30px">7</p>
                <p>User</p>
            </div>
            <div class="grid-item-levels-description <?php if($_SESSION["level"] >= 7) echo "checked-desc";?>" id="level7" style="display: none">
                <p>Review 100 movies.</p>
            </div>
        </div>

        <div class="grid-item-levels" style="grid-template-rows: 90px 20px">
            <p><i class="far fa-user-circle" style="font-size: 80px"></i></p>
            <p><?php echo $_SESSION["username"]; ?></p>
        </div>
    </div>

    <br>
    <div style="background-color: whitesmoke; height: 2px; width: 100%; opacity: .1"></div>

    <br><p class="section-title">Recommendations For You</p>
    <?php include 'GET/get_recoms.php';?>
    <br><br><p class="section-title" style="font-weight: normal; font-size: 25px; margin-top: -30px">Recommendations Based on Your Favourite Genres</p>
    <div class="grid-container-review" style="margin-top: -20px; grid-template-columns: 250px 250px 250px 250px 250px; grid-column-gap: 20px;">
        <?php include 'GET/get_user_categories.php';?>
    </div>

    <br><p class="section-title">Movie Trivia</p>
    <p class="section-title" style="font-weight: normal; font-size: 25px; margin-top: -30px">Did You Know?</p>
    <?php include 'GET/get_trivia.php';?>

    <br><div style="background-color: whitesmoke; height: 2px; width: 100%; opacity: .1"></div>

    <br><p class="section-title">Your Watchlist</p>
    <?php include 'GET/get_watchlist.php';?>

    <br><p class="section-title">Your Reviews</p>
    <?php include 'GET/get_user_reviews.php';?>

    <br><br>

</div>

</body>
</html>