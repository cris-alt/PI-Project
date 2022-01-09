<?php
$conn = mysqli_connect( "localhost", "root", "")
    or die("Error to connect to MySQL");
print "Connected to MySQL <br />";
$deletedb = mysqli_query($conn,"DROP DATABASE reviewsite");
if ($deletedb)
    echo "Database reviewsite was deleted<br />";
else
    echo "<br />". mysqli_errno($conn). " : ". mysqli_error($conn);
mysqli_close($conn);
?>