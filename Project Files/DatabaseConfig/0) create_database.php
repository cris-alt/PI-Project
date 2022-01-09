<?php
$conn = mysqli_connect( "localhost", "root", "")
    or die("Fail to connect to MySQL");
print "Connected to MySQL <br />";
$createdb = mysqli_query($conn,"CREATE DATABASE reviewsite");
if ($createdb)
    echo "The database reviewsite has been created <br />";
else
    echo "<br />". mysqli_errno($conn). " : ". mysqli_error($conn);
mysqli_close($conn);
?>