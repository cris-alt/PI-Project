<?php
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

$sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title 
WHERE m.title IN (SELECT title FROM watchlist WHERE username = '$uname')
GROUP BY m.title";
$result = $conn->query($sql);
$count = 0;

if ($result->num_rows > 0) {
    // output data of each row
    echo '<div class="gallery js-flickity"
         data-flickity-options=\'{ "wrapAround": true }\'>
         <div class="flickity-slider" style="left: 0px; transform: translateX(0.22%); min-height: 490px">';
    while($row = $result->fetch_assoc()) {
        $count++;
        if($count % 5 == 1)
            echo '<div class="grid-container-cards" style="margin-left: 10px; margin-right: 10px">';
        echo '<div class="grid-item">
            <div class="movie_card" id="tenet" >
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
    echo '</div></div>';
} else {
    echo '<br><p style="font-size: 15px; color: whitesmoke; margin-top: -60px">   Your Watchlist is empty. Find some movies to watch!</p>';
}

$conn->close();

?>

