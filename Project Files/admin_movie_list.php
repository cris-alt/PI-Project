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
    <title>Movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <style>
        .my-nav {
            font-size: 20px;
            background-color: rgba(0, 0, 0, .8);
        }

        .grid-container-two {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 550px 550px;
            padding: 50px;
        }

        .grid-item {
            background-color: #0c0c0c;
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

        .grid-container-cards {
            display: grid;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            grid-template-columns: 49% 49%;
            /*border: solid 2px greenyellow;*/

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

    <p class="section-title">All Movies</p>

    <div class="grid-container-cards">
        <?php include 'GET/get_movie_list.php';?>
    </div>

</div>

</body>
</html>