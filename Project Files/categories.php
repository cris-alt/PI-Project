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
    <title>Movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">

    <style>
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
        .grid-item::selection {
            color: #191919;
            background-color: #950101;
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

        .category{
            padding: 4px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 40px;
            color: whitesmoke;
            margin: 15px 15px 15px 65px;
            background-color: rgba(0, 0, 0, 0);
            border: solid 2px rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            width: fit-content;
            margin-left: 45px;
        }
        .category:focus{
            outline:0;
        }

        option{
            background-color: rgba(0, 0, 0, 1);
            font-size: 30px;
        }
        .category:focus{
            outline:0;
        }

    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-black bg-black">
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
<div class="section_one">
    <form action="">
    <select name="category" id="category" class="category" onchange="showMovies()">
        <option value="empty">All Categories </option>
        <?php include 'GET/get_categories.php';?>
    </select>
        <select name="method" id="method" class="category" style="float: right; margin-right: 45px" onchange="showMovies()">
            <option value="empty">Sort by </option>
            <option value="namea">Name a-z </option>
            <option value="named">Name z-a </option>
            <option value="popular">Popularity </option>
            <option value="rate">Rate </option>
            <option value="new">New </option>
            <option value="old">Old </option>
        </select>
    </form>

    <div id="movies" class="grid-container-two">
        <?php include 'GET/get_movies_all_categories.php';?>
    </div>
    <br><br>
</div>

<script>
    function showMovies() {
        var str = document.getElementById("category").value;
        var method =  document.getElementById("method").value;
        if (str == "") {
            document.getElementById("movies").innerHTML = "nothing here";
            return;
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("movies").innerHTML = this.responseText;
        }



        xhttp.open("GET", "GET/get_movies_on_categories.php?q=" + str + "&m=" + method);
        xhttp.send();
    }
</script>

</body>
</html>