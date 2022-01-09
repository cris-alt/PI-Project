<?php
// conectare la serverul MySQL 
$conn = new mysqli('localhost', 'root', '', 'reviewsite');
// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
// interogare sql pentru CREATE TABLE
$sql = "CREATE TABLE movie (
 title VARCHAR(50) NOT NULL PRIMARY KEY,
 runtime INT(3) NOT NULL,
 description VARCHAR(500) NOT NULL,
 year INT(11) NOT NULL,
 rate FLOAT NOT NULL DEFAULT 0,
 trailer VARCHAR(100) NOT NULL,
 poster VARCHAR(100) NOT NULL,
 date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
 ) "; 

// Executa interogarea $sql query pe server pentru a crea tabelul
if ($conn->query($sql) === TRUE) {
  echo 'Table "movie" was successfuly created';
}
else {
 echo 'Error: '. $conn->error;
}
$conn->close();
?>