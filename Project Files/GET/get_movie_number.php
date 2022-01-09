<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT count(*) as number FROM movie";
$result = $conn->query($sql);
$sql2 = "SELECT count(*) as newnumber FROM movie WHERE date between date_sub(now(),INTERVAL 1 WEEK) and now()";
$result2 = $conn->query($sql2);

if ($result->num_rows > 0 && $result2->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    $percentage = ($row2["newnumber"] * 100) / $row["number"];
    if($percentage == 0)
        $percentage = 1;

    echo '
 <div class="grid-container-numbers">
        <div class="number first-limit">' . $row2["newnumber"] . '</div>
        <div class="percentages">
            <div class="percentage-bar" style="grid-template-columns: ' . $percentage . '% ' . 100 - $percentage . '%;">
                <div class="all-time"></div>
                <div class="new"></div>
            </div>
            <div class="tags">
                <div class="number-label-left"><p style="float: left; padding: 0">New movies this week</p></div>
                <div class="number-label-right"><p style="float: right; padding: 0">Movies on the site</p></div>
            </div>
        </div>
        <div class="number">' . $row["number"] . '</div>
    </div>';
}

$conn->close();

?>

