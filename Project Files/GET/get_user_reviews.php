<?php

echo '<style>  .grid-container-review {
            display: grid;
            grid-column-gap: 8px;
            grid-template-columns: 440px 440px 440px;
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

$sql = "SELECT rate, review, DATE_FORMAT(date, '%d.%m.%Y') as datef, date, title, LENGTH(review) as leng FROM review WHERE username = '$uname' ORDER BY leng DESC";
$result = $conn->query($sql);
$count = 0;

if ($result !== false && $result->num_rows > 0) {
    echo '<div class="gallery js-flickity"
         data-flickity-options=\'{ "wrapAround": true }\' style="height: 150px" >';
    while ($row = $result->fetch_assoc()) {
        $count++;
        if($count % 3 == 1)
            echo '<div class="grid-container-review" style="margin-left: 10px; margin-right: 10px">';

        echo '<div class="grid-item-review" style="height: 150px;">
                <div class="review">
                    <div class="review-data">
                        <div class="username"><i class="fas fa-film"></i>  ' . $row["title"] . '</div>
                        <div class="date">' . $row["datef"] . '</div>
                    </div>
                    <div>';
        for($i = 0; $i < $row["rate"]; $i++)
             echo '    <span><i class="fas fa-star"></i></span>';
        echo '      </div>
                    <div class="review-text">' . $row["review"] . '</div>
                </div>
            </div>';

        if($count % 3 == 0)
            echo '</div>';
    }
    if($count % 3 != 0)
        echo '</div>';
    echo '</div>';
} else echo '<br><p style="font-size: 15px; color: whitesmoke; margin-top: -60px">   You haven\'t left any reviews yet.</p>';

$conn->close();

?>

