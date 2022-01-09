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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <style>
        .welcome-banner {
            width: 100%;
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

        .p-banner {
            vertical-align: center;
            color: #f0f0f0;
            font-size: 50px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        .section-title {
            font-family: Arial, Helvetica, sans-serif;
            /*font-weight: bold;*/
            font-weight: lighter;
            font-size: 40px;
            color: whitesmoke;
        }

        .grid-container-main {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: auto;
            padding: 100px;
            /*border: solid 2px white;*/

        }

        .grid-container-numbers {
            display: grid;
            grid-column-gap: 1px;
            grid-row-gap: 1px;
            grid-template-columns: 150px auto 150px;
            padding: 0;
            /*border: solid 1px blue;*/
            border-radius: 10px;
            background-color: #0c0c0c;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;

        }

        .grid-item {
            background-color: #0c0c0c;
            color: whitesmoke;
            padding: 8px;
            font-size: 16px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 10px;
            box-shadow: 0 0 1px 1px #191919;
            border: solid 1px paleturquoise;

        }

        .number {
            font-size: 50px;
            color: whitesmoke;
            /*border: solid 1px greenyellow;*/
            display: flex;
            justify-content: center;
        }

        .number-label {
            font-size: 17px;
            color: red;
            /*display: flex;*/
            /*justify-content: center;*/
            /*border: solid 5px goldenrod;*/
        }

        .first-limit {
            color: #950101;
        }

        .percentages {
            display: grid;
            grid-template-rows: 20px 25px;
            border-radius: 5px;
            /*border: solid 5px pink;*/
            padding-top: 20px;
        }

        .percentage-bar {
            display: grid;
            /*grid-template-columns: 99% 1%;*/
            border-radius: 5px;
            padding: 0 10px 0 10px;
            /*border: solid 1px darkslategray;*/
        }

        .all-time {
            background-color: #950101;
            color: #950101;
            width: 100%;
            border-radius: 5px 0 0 5px;
        }

        .new {
            background-color: whitesmoke;
            color: whitesmoke;
            width: 100%;
            border-radius: 0 5px 5px 0;
        }

        .tags {
            display: grid;
            grid-template-columns: auto auto;
            border-radius: 5px;
            padding: 0 10px 0 10px;
            /*border: solid 1px coral;*/
        }

        .number-label-left {
            font-size: 17px;
            color: #950101;
        }

        .number-label-right {
            font-size: 17px;
            color: whitesmoke;
        }

        .my-nav {
            font-size: 20px;
            background-color: rgba(0, 0, 0, .8);
        }

    </style>

</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-black bg-black my-nav">
    <a class="navbar-brand disabled" href="admin_dashboard.php">ReviewSite</a>
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
                <a class="nav-link" href="add_movies.php">Add New Movies</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<div class="grid-container-main">

    <div class="welcome-banner">
        <p class="p-banner">Welcome Back!</p>
        <p class="p-banner">See what happened while you were gone...</p>
    </div>

    <br><p class="section-title">Site in Numbers</p>

    <?php include 'GET/get_user_number.php';?>

    <?php include 'GET/get_movie_number.php';?>

    <?php include 'GET/get_review_number.php';?>

    <br><p class="section-title">Movies on Categories</p>

    <?php include 'GET/get_category_number.php';?>

</div>

</body>
</html>