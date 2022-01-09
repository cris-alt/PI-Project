<?php
// conectare la serverul MySQL 
$conn = new mysqli('localhost', 'root', '', 'reviewsite');
// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
// interogare sql pentru CREATE TABLE
$sql = "CREATE TABLE category (
 catname VARCHAR(25) NOT NULL PRIMARY KEY
 ) "; 

// Executa interogarea $sql query pe server pentru a crea tabelul
if ($conn->query($sql) === TRUE) {
  echo 'Table "category" was successfuly created.<br>';
}
else {
 echo 'Error: '. $conn->error;
}

$category = ["Action", "Adventure", "Animation", "Biography", "Comedy", "Crime", "Documentary",
"Drama", "Fantasy", "History", "Horror", "Musical", "Mystery", "Romance", "Sci-Fi", "Thriller",
"War", "Western"];

for($c = 0; $c < 18; $c++){
	$sql = "INSERT INTO category (catname)
	VALUES ('$category[$c]')";


	if (mysqli_query($conn, $sql)) {
		echo 'Category <b>' . $category[$c] . '</b> was added;<br>';
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

$conn->close();
?>