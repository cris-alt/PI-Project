<?php
// conectare la serverul MySQL 
$conn = new mysqli('localhost', 'root', '', 'reviewsite');
// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
// interogare sql pentru CREATE TABLE
$sql = "CREATE TABLE type (
 catname VARCHAR(25) NOT NULL,
 title VARCHAR(50) NOT NULL,
 PRIMARY KEY (catname, title),
 FOREIGN KEY (catname) REFERENCES category(catname),
 FOREIGN KEY (title) REFERENCES movie(title)
 ) "; 

// Executa interogarea $sql query pe server pentru a crea tabelul
if ($conn->query($sql) === TRUE) {
  echo 'Table "type" was successfuly created.<br>';
}
else {
 echo 'Error: '. $conn->error;
}

$conn->close();
?>