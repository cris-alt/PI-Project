<?php
// conectare la serverul MySQL 
$conn = new mysqli('localhost', 'root', '', 'reviewsite');
// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
// interogare sql pentru CREATE TABLE
$sql = "CREATE TABLE review (
 rate INT(1) NOT NULL,
 review VARCHAR(500) NOT NULL,
 date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 username VARCHAR(50) NOT NULL,
 title VARCHAR(50) NOT NULL,
 PRIMARY KEY (username, title),
 FOREIGN KEY (username) REFERENCES user(username),
 FOREIGN KEY (title) REFERENCES movie(title)
 ) "; 

// Executa interogarea $sql query pe server pentru a crea tabelul
if ($conn->query($sql) === TRUE) {
  echo 'Table "review" was successfuly created.';
}
else {
 echo 'Error: '. $conn->error;
}
$conn->close();
?>