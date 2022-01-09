<?php
// conectare la serverul MySQL 
$conn = new mysqli('localhost', 'root', '', 'reviewsite');
// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
// interogare sql pentru CREATE TABLE
$sql = "CREATE TABLE user (
 username VARCHAR(50) PRIMARY KEY,
 email VARCHAR(50) NOT NULL,
 password VARCHAR(50) NOT NULL,
 userlevel enum('admin','user') NOT NULL DEFAULT 'user',
 date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
 ) "; 

// Executa interogarea $sql query pe server pentru a crea tabelul
if ($conn->query($sql) === TRUE) {
  echo 'Table "user" was successfuly created';
}
else {
 echo 'Error: '. $conn->error;
}
$conn->close();
?>