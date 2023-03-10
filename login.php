<!-- Start a php session (this must be before <!DOCTYPE html>!!!): -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../media/images/icon.ico">
        <title>Agender | Logging in...</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/loginStyle.css">
    </head>
    <body>
        <!-- Navbar -->
        <header>
            <div id="navbar">
                <a class="active" href="../">Leren Tellen</a>
                <div class="nav2">
                    <a href="signup.php">Sign-up</a>
                    <a href="./">Home</a>
                </div>
            </div>
        </header>

        <!-- Login form -->
        <main>
            <div class="Form1">
                <form action="login.php" method="post">
                    <label>Login</label>
                    <div>
                        <div>
                            <p>Username:</p>
                            <p>Password:</p>
                        </div>
                        <div>
                            <input type="text" name="username" autofocus required>
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <input type="submit" name="submit">
                </form>
            </div>
        </main>
    </body>
</html>

<?php
    if(isset($_POST["username"])){
        // Taking all values from the form data(input)
        $formUsername   = $_REQUEST['username'];
        $formPassword   = $_REQUEST['password'];

        require "../dbConn.php";

        $query  = $dbConn->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param('s', $formUsername);
        $query->execute();
        $result = $query->get_result();
    
        // Fetch all data from entered username from users table from beroeps2Verzamelaar database
        $row        = mysqli_fetch_array($result, MYSQLI_BOTH);
    
        $dbPassword = $row['password'];
        $isAdmin    = $row['isAdmin'];
        $id         = $row['id'];
    
        $previousPage = $_SESSION['previousPage'];
    
        // Check if given username with given password exists and if password matches password in database
        if(password_verify($formPassword, $dbPassword)){
            // Add session variables
            $_SESSION["loggedIn"] = 1;
            $_SESSION["username"] = $formUsername;
            $_SESSION["isAdmin"]  = $isAdmin;
            $_SESSION["id"]       = $id;
    
            // Redirect automatically to the previous page
            header("Location: $previousPage");
        }
        else{
            // If given username with given password doesn't exist or passwords don't match show error
            echo
            "<div id='content'>",
                "<h1>Account with that username and password does not exist!</h1>",
                "<a href='$previousPage'>Continue</a>",
            "</div>"
            ;
            // Redirect automatically to the previous page after 2 seconds
            header("Refresh: 2; url = $previousPage");
        }
        // DEBUG:  or die(mysqli_error($dbConn))
    }
?>