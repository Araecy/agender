<!-- Start a php session (this must be before <!DOCTYPE html>!!!) -->
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
        <title>Agender | Signup</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/signupStyle.css">
    </head>
    <body>
        <!-- Navbar -->
        <nav>
            <ul>
                <li><a>Home</a></li>

                <?php
                    if(isset($_SESSION['loggedIn'])){
                        $username = $_SESSION['username'];

                        echo "
                            <li class='floatRight'><a class='dropdown-arrow'>$username</a>
                                <ul class='sub-menus'>
                                    <li><a href='logout.php'>Logout</a></li>
                                </ul>
                            </li>
                        ";
                    }
                    else{
                        echo "
                            <li class='floatRight'>
                                <a href='login.php'>Login</a>
                            </li>
                            <li class='floatRight'>
                                <a>Signup</a>
                            </li>
                        ";
                    }
                ?>

            </ul>
        </nav>

        <!-- Signup form -->
        <main>
            <div class="Form1">
                <form method="post">
                    <label>Signup</label>
                    <div>
                        <div>
                            <p>Username:</p>
                            <p>Password:</p>
                            <p>Password repeated:</p>
                        </div>
                        <div>
                            <input type="text" name="username" autofocus required>
                            <input type="password" name="password" required>
                            <input type="password" name="passwordRepeated" required>
                        </div>
                    </div>
                    <input type="submit" name="submit">
                </form>
            </div>
        </main>
    </body>
</html>

<?php
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["passwordRepeated"])){
        $previousPage = $_SESSION['previousPage'];

        // Taking all values from the form data(input)
        $formUsername         = $_REQUEST['username'];
        $formPassword         = $_REQUEST['password'];
        $formPasswordRepeated = $_REQUEST['passwordRepeated'];

        if($formPassword == $formPasswordRepeated){
            require_once("dbConn.php");

            // Check if username already exists
            $query  = $dbConn->prepare("SELECT * FROM users WHERE username = ?");
            $query->bind_param('s', $formUsername);
            $query->execute();
            $result = $query->get_result();

            // If username doesn't exist already proceed with account creation
            if(mysqli_num_rows($result) == 0){
                $formPasswordHashed = password_hash($formPassword, PASSWORD_DEFAULT);

                // Insert data in users table in beroeps2Verzamelaar database
                $query2 = $dbConn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $query2->bind_param('ss', $formUsername, $formPasswordHashed);
                $query2->execute();

                echo
                    "<div id='content'>",
                        "<h1>Account successfully created!</h1>",
                        "<a href='$previousPage'>Continue</a>",
                    "</div>"
                ;
                // Redirect automatically to the previous page after 2 seconds
                header("Refresh: 2; url = $previousPage");
            }
            // If username already exists show error
            else{
                echo
                    "<div id='content'>",
                        "<h1>That username has already been taken!</h1>",
                        "<a href='$previousPage'>Continue</a>",
                    "</div>"
                ;
                // Redirect automatically to the previous page after 2 seconds
                header("Refresh: 2; url = $previousPage");
            }
        }
        // If passwords don't match show error
        else{
            echo
                "<div id='content'>",
                    "<h1>passwords don't match!</h1>",
                    "<a href='$previousPage'>Continue</a>",
                "</div>"
            ;
            // Redirect automatically to the previous page after 2 seconds
            header("Refresh: 2; url = $previousPage");
        }
        // DEBUG:  or die(mysqli_error($dbConn))
    }
?>