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
        <title>Agender | Login</title>
        <link rel="icon" type="image/x-icon" href="../media/images/icon.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/loginStyle.css">
    </head>
    <body>
        <!-- Navbar -->
        <nav>
            <ul>
                <li><a href='../'>Home</a></li>

                <?php
                    if(isset($_SESSION['loggedIn'])){
                        $username = $_SESSION['username'];

                        echo "
                            <li class='floatRight'><a class='dropdown-arrow'>$username</a>
                                <ul class='sub-menus'>
                                    <li><a href='../php/logout.php'>Logout</a></li>
                                </ul>
                            </li>
                        ";
                    }
                    else{
                        echo "
                            <li class='floatRight'>
                                <a>Login</a>
                            </li>
                            <li class='floatRight'>
                                <a href='../signup'>Signup</a>
                            </li>
                        ";
                    }
                ?>

            </ul>
        </nav>

        <!-- Login form -->
        <main>
            <div class="Form1">
                <div class="loginLabel">Agender</div>
                <div class="wrapper-form">
                    <form class="formLogin" action="" method="post">
                        <div class="formInner">
                            <input class='inputVeld'  placeholder="Naam" type="text" name="username" autofocus required>
                            <input class='inputVeld' placeholder="Wachtwoord" type="password" name="password" required>
                            <input class='submitKnop' type="submit" value="Log in">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>

<?php
    if(isset($_POST["username"]) && isset($_POST["password"])){
        // Taking all values from the form data(input)
        $formUsername   = $_REQUEST['username'];
        $formPassword   = $_REQUEST['password'];

        require "../php/dbConn.php";

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