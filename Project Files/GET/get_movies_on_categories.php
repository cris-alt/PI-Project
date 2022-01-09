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

$category = $_GET['q'];
$sortMethod = $_GET['m'];

if($category == "empty"){
    if($sortMethod == "namea")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY m.title ASC";
    elseif($sortMethod == "named")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY m.title DESC";
    elseif($sortMethod == "new")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY m.year DESC";
    elseif($sortMethod == "old")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY m.year ASC";
    elseif($sortMethod == "popularity")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY COUNT(r.rate) DESC";
    elseif($sortMethod == "rate")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY rate DESC";
    else
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title
GROUP BY m.title
ORDER BY RAND()";
}
else{
    if($sortMethod == "namea")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY m.title ASC";
    elseif($sortMethod == "named")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY m.title DESC";
    elseif($sortMethod == "new")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY m.year DESC";
    elseif($sortMethod == "old")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY m.year ASC";
    elseif($sortMethod == "popularity")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY COUNT(r.rate) DESC";
    elseif($sortMethod == "rate")
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY rate DESC";
    else
        $sql = "SELECT m.title, m.year, m.poster, 
IFNULL(TRUNCATE(SUM(r.rate)/COUNT(r.rate), 1), 0) as rate, m.date 
FROM movie m left join review r on m.title = r.title, type t
WHERE t.title = m.title
GROUP BY m.title, t.catname
HAVING t.catname = '$category'
ORDER BY RAND()";

}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo '<div class="grid-item">
            <div class="movie_card" id="tenet" >
                <div class="movie_specs" style="padding: 0">
                    <img src="' .$row["poster"]. '"]" style="width: 234px; max-height: 346px; border-radius: 8px">
                </div>
                <div class="movie_specs" style="white-space: nowrap;
text-overflow: ellipsis;
overflow: hidden">
                    <p style="font-weight: bold; font-size: 20px; margin:0; padding:0">' .$row["title"]. '</p>
                    <p style="opacity: 0.6; font-size: 15px; margin:0; padding:0">' .$row["year"]. '</p>
                </div>
                <div class="movie_specs" style="background-color: rgba(0, 0, 0, 0.4)">
                    <div class="buttons" style="float: bottom">
                        <div class="button_item" >
                            <p><i class="fas fa-star"></i>  ' .$row["rate"]. '</p>
                        </div>
                        <div class="button_item"  >                       
                            <form action="movie_page.php" method="get" >
                            <button class="myButtonIcon" name="title" value="' .$row["title"]. '" >
                                <i class="far fa-eye" style="float: right; padding-top: 4px"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo "0 results";
}

$conn->close();

?>

