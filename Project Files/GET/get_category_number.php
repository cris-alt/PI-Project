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

$sql = "SELECT catname, count(catname) as number, (count(catname)*100)/(select count(*) from type) as percentage FROM type GROUP BY catname ORDER BY number DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

//        echo ' <div class="grid-item">
//            <div class="number"><p style="padding: 0; margin:0">' . $row["number"] . '</p></div>
//            <div class="numberLabel"><p>' . $row["catname"] . '</p></div>
//        </div>';

        echo '<div class="grid-container-numbers">
        <div class="number first-limit">' . $row["number"] . '</div>
        <div class="percentages">
            <div class="percentage-bar" style="grid-template-columns: ' . $row["percentage"] . '% ' . (100 - $row["percentage"]) . '% ">
                <div class="all-time"></div>
                <div class="new" style="color: #950101; padding-left: 5px">' . bcdiv($row["percentage"], 1, 1) . ' %</div>
            </div>
            <div class="tags">
                <div class="number-label-left"><p style="float: left; padding-top: 3px;">' . $row["catname"] . '</p></div>
            </div>
        </div>
    </div>';
    }
} else {
    echo "0 results";
}

$conn->close();

?>

