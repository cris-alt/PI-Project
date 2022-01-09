<?php

echo '<style>  .grid-container-review {
            display: grid;
            grid-column-gap: 8px;
            grid-template-columns: 250px 250px 250px 250px 250px;
            grid-template-rows: auto;
            padding: 0;
            width: 100%;
            /*border: solid 1px red;*/
        }

        .grid-item-review {
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
            grid-template-columns: fit-content(100%) auto;
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
            float: right;
        }

        .review-text {
            font-size: 15px;
            color: whitesmoke;
            float: left;
        }
        
        flickity-viewport, flickity-slider, gallery js-flickity {
            min-height: 150px;
            height: fit-content;
        }
        
        </style>';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";

$uname = $_SESSION["username"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(r.title) as number, t.catname 
FROM review r JOIN type t ON r.title = t.title 
WHERE r.username = '$uname'
GROUP BY t.catname
ORDER BY number DESC LIMIT 5";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="grid-item-review" style="height: 50px; background-color: rgba(24, 24, 24, .5); font-size: 30px; padding: 0; text-align: center; font-weight: bolder; color: whitesmoke"> <p style="margin: 0; padding: 0">'
               . $row["catname"] .
           ' </p></div>';
    }

} else echo '<br><p style="font-size: 15px; color: whitesmoke; margin-top: -60px">   You haven\'t any favourite categories yet. </p>';

$conn->close();

?>

