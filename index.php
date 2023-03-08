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
        <title>Agender</title>
        <link rel="icon" type="image/x-icon" href="media/images/icon.ico">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/indexStyle.css">
    </head>
    <body>
        <!-- Navbar -->
        <div id="navbar">
            <a class="active" href="">Agender</a>
            <div class="nav2">
                <?php
                    if(isset($_SESSION['loggedIn'])){
                        $username = $_SESSION['username'];
                        echo "
                            <p>Username: $username</p>
                            <a href='logout.php'>Logout</a>
                        ";
                    }
                    else{
                        echo "
                            <a href='signup/'>Signup</a>
                            <a href='login/'>Login</a>
                        ";
                    }
                ?>
            </div>
        </div>
    </body>
</html>

<?php
    $_SESSION['previousPage'] = $_SERVER['REQUEST_URI'];