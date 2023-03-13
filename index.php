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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/indexStyle.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>

    <body>
        <!-- Navbar -->
        <nav>
            <ul>
                <li><a href="">Home</a></li>

                <?php
                    if(isset($_SESSION['loggedIn'])){
                        $username = $_SESSION['username'];
                        echo "
                            <li class='dropdown floatRight'>
                                <a class='dropbtn'>$username</a>
                                <div class='dropdown-content'>
                                    <a href='logout.php'>Logout</a>
                                </div>
                            </li>
                        ";
                    }
                    else{
                        echo "
                            <li class='floatRight'>
                                <a href='login.php'>Login</a>
                            </li>
                            <li class='floatRight'>
                                <a href='signup.php'>Signup</a>
                            </li>
                        ";
                    }
                ?>

            </ul>
        </nav>

        <div id="contentDiv">
            <div class="wrapper">
                <header>
                    <p class="current-date">September 2022</p>
                    <div class="icons">
                        <span id="prev" class="material-symbols-rounded">
                            chevron_left
                        </span>
                        <span id="next" class="material-symbols-rounded">
                            chevron_right
                        </span>
                    </div>
                </header>
                <div class="calendar">
                    <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
    
                    </ul>
                    <ul class="days">
                    </ul>
                </div>
            </div>
    
            <div class="wrapper-2" id="formW">
                <div id="containerForm">
                    <form action="">
                        <!-- <label for="onderwerp">Onderwerp</label> -->
                        <h3 id="datumtekst" class="toevoegTekstDatum">23 Maart 2023</h3>
                        <h3 class="toevoegTekst">Voeg een nieuw item toe</h3>
                        <input type="hidden" name="datum" id="datumVal" value="">
                        <div class="wrap-innerform">
                            <div class="innerForm">
                                <input name="tijd" type="time">
                                <input name="onderwerp" type="text" placeholder="Onderwerp">
                                <!-- <label for="toelichting">Toelichting</label> -->
                                <textarea style="resize: none;" placeholder="Toelichting" id="toelichting" name="toelichting" rows="5" cols="40"></textarea>
                                <input id="verstuur" type="submit" value="Verstuur">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/javas.js"></script>
    </body>
</html>

<?php
    $_SESSION['previousPage'] = $_SERVER['REQUEST_URI'];