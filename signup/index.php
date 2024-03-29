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
        <title>Agender | Signup</title>
        <link rel="icon" type="image/x-icon" href="../media/images/icon.ico">
        <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/signupStyle.css">
    </head>
    <body>
        <!-- Navbar -->
        <nav>
            <ul>
                <li><a href="../">Home</a></li>

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
                                <a href='../login'>Login</a>
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
            <div class="Form1">
                <div class="loginLabel">Agender</div>
                <div class="wrapper-form">
                    <form class="formLogin" action="" method="post">
                        <div class="formInner">
                            <input class='inputVeld'  placeholder="Naam" type="text" name="username" autofocus required>
                            <input class='inputVeld' placeholder="Wachtwoord" type="password" name="password" required>
                            <input class='inputVeld'  placeholder="Herhaal wachtwoord" type="password" name="passwordRepeated" required>
                            <input class='submitKnop' type="submit" value="Sign up">
                        </div>
                    </form>
                </div>
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
            require_once("../php/dbConn.php");

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

                echo "
                    <div id='content'>
                        <h1>Account successfully created!</h1>
                        <a href='$previousPage'>Continue</a>
                    </div>
                ";

                // Redirect automatically to the previous page after 2 seconds
                header("Refresh: 2; url = $previousPage");
            }
            // If username already exists show error
            else{
                echo "
                    <div id='content'>
                        <h1>That username has already been taken!</h1>
                        <a href='$previousPage'>Continue</a>
                    </div>
                ";

                // Redirect automatically to the previous page after 2 seconds
                header("Refresh: 2; url = $previousPage");
            }
        }
        // If passwords don't match show error
        else{
            echo "
                <div id='content'>
                    <h1>passwords don't match!</h1>
                    <a href='$previousPage'>Continue</a>
                </div>
            ";

            // Redirect automatically to the previous page after 2 seconds
            header("Refresh: 2; url = $previousPage");
        }
        // DEBUG:  or die(mysqli_error($dbConn))
    }
?>