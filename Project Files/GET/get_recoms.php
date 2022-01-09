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

$sql = "SELECT DISTINCT(m.title), m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t 
WHERE t.title = m.title 
GROUP BY m.title, t.catname
HAVING t.catname IN (SELECT t.catname FROM review r JOIN type t ON r.title = t.title WHERE r.username = '$uname') and 
m.title NOT IN (SELECT title FROM review WHERE username = '$uname')
LIMIT 15";
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
        echo '<div class="grid-item" style="margin: 0">
            <div class="movie_card">
                <div class="movie_specs" style="padding: 0; ">
                    <img src="' .$row["poster"]. '"]" style="width: 234px; max-height: 346px; border-radius: 8px">
                </div>
                <div class="movie_specs" style="white-space: nowrap;
text-overflow: ellipsis;
overflow: hidden">
                    <p style="font-weight: bold; font-size: 20px; margin:0; padding:0">' .$row["title"]. '</p>
                    <p style="opacity: 0.6; font-size: 15px; margin:0; padding:0">' .$row["year"]. '</p>
                </div>
                <div class="movie_specs" style="background-color: rgba(0, 0, 0, 0.4)">
                    <div class="buttons" style="float: bottom">
                        <div class="button_item" >
                            <p><i class="fas fa-star"></i>  ' .$row["rate"]. '</p>
                        </div>
                        <div class="button_item"  >                       
                            <form action="movie_page.php" method="get" >
                            <button class="myButtonIcon" name="title" value="' .$row["title"]. '" >
                                <i class="far fa-eye" style="float: right; padding-top: 4px"></i>
                            </button>
                            </form>
                        </div>
                    </div>
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

