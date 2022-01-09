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

$sql = "SELECT catname FROM type GROUP BY catname";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo '<option value="' .$row["catname"]. '">' .$row["catname"]. '</option>';
    }
} else {
    echo "0 results";
}

$conn->close();

?>

