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

$sql = "SELECT m.title, m.year, m.poster, c.name 
FROM movie m JOIN cast c on m.title = c.title 
WHERE c.role = 'director' 
ORDER BY m.date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo '      
<div class="grid-item" id="test">
        <div class="movie_card" id="' .$row["title"]. '" >
            <div class="movie_specs" style="padding: 0">
                <img src="' .$row["poster"]. '" style="width: 100px; max-height: 148px; float: left; border-radius: 8px">
            </div>
            <div class="movie_specs">
                <p style="font-weight: bold; font-size: 25px; margin:0; padding:0">' .$row["title"]. '</p>
                <p style="opacity: 0.6; font-size: 20px; margin:0; padding:0">' .$row["year"]. '</p>
                <p style="opacity: 0.6; font-size: 15px; margin:0; padding:0">directed by ' .$row["name"]. '</p>
            </div>
            <div class="movie_specs" style="background-color: rgba(0, 0, 0, 0.4)">
                <div class="buttons">
                    <div class="button_item"  >                       
                        <form action="movie_page_admin.php" method="get" >
                            <button class="myButtonIcon" name="title" value="' .$row["title"]. '" >
                                <i class="far fa-eye" style="float: right; padding-top: 4px"></i>
                            </button>
                        </form>
                    </div>
                    
                    
                    <div class="button_item">
                        <form action="confirm_delete_movie.php" method="get" >
                            <button id="delete" class="myButtonIcon" name="title" value="' .$row["title"]. '">
                                <i class="far fa-trash-alt" style="float: right; padding-top: 4px"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="button_item">
                       
                        <form action="movie_edit.php" method="get" >
                            <button class="myButtonIcon" name="initial_title" value="' .$row["title"]. '" disabled style="color: #070707" >
                                <i class="far fa-edit" style="float: right; padding-top: 4px"></i>
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

