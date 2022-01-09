<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";

$title = trim($_GET["title"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT r.rate, r.review, r.username, DATE_FORMAT(r.date, '%d.%m.%Y') as datef, date, title, l.level as level FROM review r left join level l on r.username = l.username WHERE title = '$title' ORDER BY level DESC";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="grid-item-two" style="width: 60%">
            <div class="review">
                <div class="review-data">
                    <div class="username"><i class="far fa-user-circle"></i> ' . $row["username"] . '</div>
                    <div style="font-weight: bold; text-align: center; text float: left bottom; margin-top: 2px; color: rgba(149, 1, 1, .6); background-color: rgba(149, 1, 1, .2); height: 16px; width:18px; border-radius: 2px; border: rgba(149, 1, 1, .6) 2px solid; padding: -1px; font-size: 10px">' . $row["level"] . '</div>
                    <div class="date">' . $row["datef"] . '</div>
                </div>
                <div>';
        for($i = 0; $i < $row["rate"]; $i++)
             echo '<span><i class="fas fa-star"></i></span>';
        echo ' </div>
                <div class="review-text">' . $row["review"] . '</div>
            </div>
        </div>';
    }
} else echo '<div class="grid-item-two" style="width: 60%">
            <div class="review">
                <div class="review-text">No reviews yet.</div>
            </div>
        </div>';

$conn->close();

?>

