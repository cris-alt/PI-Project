<?php
$conn = new mysqli("localhost", "root", "", "reviewsite");
if($conn->connect_error) {
    exit('Could not connect');
}

$title = trim($_GET["title"]);

$sql = "SELECT m.title, m.year, m.runtime, m.poster, m.trailer, m.description, c.name
FROM movie m join cast c ON m.title = c.title
WHERE c.role = 'director' AND m.title = ?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $year, $runtime, $poster, $trailer, $description, $director);
$stmt->fetch();
$stmt->close();

$sqlCast = "SELECT name
FROM cast
WHERE role = 'actor' AND title = '$title'";

$result = $conn->query($sqlCast);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["name"];
        echo "<br>";
    }
}

$sqlType = "SELECT catname
FROM type
WHERE title = '$title'";

$result = $conn->query($sqlType);

if ($result->num_rows > 0) {
    // output data of each row
    while ($rowT = $result->fetch_assoc()) {
        echo $rowT["catname"];
        echo "<br>";
    }
}

echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<td>" . $title . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Year</th>";
echo "<td>" . $year . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Runtime</th>";
echo "<td>" . $runtime . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Poster</th>";
echo "<td>" . $poster . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Trailer</th>";
echo "<td>" . $trailer . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Description</th>";
echo "<td>" . $description . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Director</th>";
echo "<td>" . $director . "</td>";
echo "</tr>";
echo "</table>";


?>