<?php


echo '<style> 
        
        flickity-slider{
            padding-left: -5px;
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

$sql = "SELECT text, title FROM trivia
    ORDER BY RAND()
LIMIT 10";
$result = $conn->query($sql);
$count = 0;

if ($result->num_rows > 0) {
    // output data of each row
    echo '<div class="gallery js-flickity"
         data-flickity-options=\'{ "wrapAround": true }\'  >';
    while($row = $result->fetch_assoc()) {
        $count++;
        if($count % 5 == 1)
            echo '<div class="grid-container-cards" style="margin-left: 10px; margin-right: 10px; width: 1340px">';
        echo '<div class="grid-item" style="margin: 0; background-color: #950101; height: 430px">
            <div class="movie_card" style="">
                <div class="movie_specs" style="width: 234px; height: 346px; border-radius: 8px; padding: 10px; font-size: 18px; font-weight: bold">
                    <p>' . $row["text"] . '</p>
                </div>
                <div class="movie_specs">
                    <p style="opacity: 0.6; font-size: 15px; margin:0; padding:0"><i class="fas fa-film"></i>  ' . $row["title"] . '</p>
                </div>
            </div>
        </div>';
        if($count % 5 == 0)
            echo '</div>';
    }
    if($count % 5 != 0)
        echo '</div>';
    echo '</div>';
} else {
    echo '<br><p style="font-size: 15px; color: whitesmoke; margin-top: -60px">   We haven no recommendations for you yet! Let us know what you like by reviewing some movies.</p>';
}

$conn->close();

?>

