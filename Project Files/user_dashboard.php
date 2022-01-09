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
    <title>Dashboard</title>
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
            grid-template-columns: auto auto auto auto auto;
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

        .gallery, .flickity-viewport, .flickity-slider {
            min-height: 490px;
        }

    </style>

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

    <div class="welcome_banner">
        <p class="pbanner">Watch. Rate. Review.</p>
    </div>

    <br><p class="section-title">New Movies</p>

    <!-- Flickity HTML init -->
    <div class="gallery js-flickity"
         data-flickity-options='{ "wrapAround": true }'>
        <?php include 'GET/get_newmovies.php';?>
    </div>

    <br><p class="section-title">Top Rated Movies</p>

    <!-- Flickity HTML init -->
    <div class="gallery js-flickity"
         data-flickity-options='{ "wrapAround": true }'>
        <?php include 'GET/get_top_movies.php';?>
    </div>

    <br><p class="section-title">Popular Movies</p>

    <!-- Flickity HTML init -->
    <div class="gallery js-flickity"
         data-flickity-options='{ "wrapAround": true }'>
        <?php include 'GET/get_popular_movies.php';?>
    </div>

    <br><br>

</div>

</body>
</html>