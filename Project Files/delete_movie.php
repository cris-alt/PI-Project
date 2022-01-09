<?php

$old = trim($_GET["title"]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewsite";

echo $old;
if($old == "ABORT_DELETION")
    header("location: admin_movie_list.php");
else{

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// sql to delete a record
    $sql = "DELETE FROM movie WHERE title = '$old'";
    $sql2 = "DELETE FROM cast WHERE title = '$old'";
    $sql3 = "DELETE FROM type WHERE title = '$old'";
    $sql4 = "DELETE FROM review WHERE title = '$old'";
    $sql5 = "DELETE FROM watchlist WHERE title = '$old'";

    if (($conn->query($sql2) === TRUE) && ($conn->query($sql3) === TRUE) && ($conn->query($sql4) === TRUE) && ($conn->query($sql5) === TRUE) && ($conn->query($sql) === TRUE)) {
        header("location: admin_movie_list.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

}



?>


