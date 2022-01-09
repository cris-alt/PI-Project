<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && htmlspecialchars($_SESSION["userlevel"]) == "admin"){
    header("location: admin_dashboard.php");
    exit;
}

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && htmlspecialchars($_SESSION["userlevel"]) == "user"){
    header("location: user_dashboard.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
//        $sql = "SELECT username, password, userlevel FROM user WHERE username = ?";
        $sql = "SELECT username, password, userlevel, (select count(username) from watchlist group by username having username = ?) as watchlist, (select count(username) from review group by username having username = ?) as reviews FROM user where username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username1, $param_username2, $param_username3);
            
            // Set parameters
            $param_username1 = $param_username2 = $param_username3 = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $user_level, $watchlist, $reviews);
                    if(mysqli_stmt_fetch($stmt)){if(password_verify($password, $hashed_password) == true){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["userlevel"] = $user_level;

                            if($watchlist > 1)
                                $_SESSION["level"] = 2;
                            else
                                $_SESSION["level"] = 1;

                            if($reviews > 5)
                                $_SESSION["level"] = 3;
                            if($reviews > 10)
                                $_SESSION["level"] = 4;
                            if($reviews > 25)
                                $_SESSION["level"] = 5;
                            if($reviews > 50)
                                $_SESSION["level"] = 6;
                            if($reviews > 100)
                                $_SESSION["level"] = 7;


                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "reviewsite";

                        $uname = $_SESSION["username"];
                        $new_level = $_SESSION["level"];

// Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql_ver = "SELECT username, level FROM level WHERE username = '$uname'";

                        $result = $conn->query($sql_ver);
                        if ($result->num_rows > 0){
                            $sql_upd = "UPDATE level SET level = '$new_level' WHERE username = '$uname'";
                        } else {
                            $sql_upd = "INSERT INTO level(username, level) VALUES ('$uname', '$new_level')";
                        }

                        $result2 = $conn->query($sql_upd);

                        $conn->close();
                            
                            // Redirect user to welcome page
							if($user_level == "admin")
								header("location: admin_dashboard.php");
							if($user_level == "user")
								header("location: user_dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="CSS/start.css">
    <link rel="stylesheet" href="CSS/cssAssets.css">
</head>
<body class="beginBody">

	<div class="header">
		<a href="register.php" style="float: right"><button class="myButton myButtonPrimary" type="submit">Sign Up</button></a>>
	</div>

    <div class="myLogin">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <br><br><p class="title">Login</p>
			<?php 
				if(!empty($login_err)){
					echo '<div class="alert alert-danger" role="alert">' . $login_err . '</div>';
				}        
			?>
			<div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <table style="width: 100%; align-content: center">
				<tr>
					<td style="float: left"><button class="myButton myButtonSecondary" type="reset">Cancel</button></td>
					<td style="float: right"><button class="myButton myButtonPrimary" type="submit">Login</button></td>
				</tr>
			</table>
			<br>
            <p class="loginOption">Don't have an account? <a href="register.php">Sign up</a> now.</p>
        </form>
    </div>
</body>
</html>