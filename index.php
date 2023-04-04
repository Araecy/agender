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
            <li><a>Home</a></li>

            <?php
            if (isset($_SESSION['loggedIn'])) {
                $username = $_SESSION['username'];

                echo "
                            <li class='floatRight'><a class='dropdown-arrow'>$username</a>
                                <ul class='sub-menus'>
                                    <li><a href='logout.php'>Logout</a></li>
                                </ul>
                            </li>
                        ";
            } else {
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
                <form method="post">
                <div class="containX">
                <div class="allExit exit">X</div>
                </div>
                        <h3 id="datumtekst" class="toevoegTekstDatum">23 Maart 2023</h3>
                    
                    <h3 class="toevoegTekst">Voeg een nieuw item toe</h3>
                    <input type="hidden" name="beginDate" id="datumVal" value="" required>
                    <div class="wrap-innerform">
                        <div class="innerForm">
                            <label>Eind datum:</label>
                            <input type="date" name="endDate">
                            <label>Begin tijd:</label>
                            <input name="beginTime" type="time">
                            <label>Eind tijd:</label>
                            <input name="endTime" type="time">
                            <input name="title" type="text" placeholder="Onderwerp" required>
                            <textarea style="resize: none;" placeholder="Toelichting" id="toelichting" name="description" rows="5" cols="40"></textarea>
                            <input id="verstuur" type="submit" value="Verstuur">
                        </div>
                    </div>
                </form>
            </div>
            <div id="events" class="events">
            <div class="containX2">
                <div class="allExit exit2">X</div>
                </div>

                <h2 id="tedoen" class="teDoen">Te doen</h2>
                <div class="event">
                    <div class="wrapNames">
                        <div id="eventName" class="eventName">Kopen</div>
                        <div id="eventBeschrijf" class="eventBeschrijf">ik moet een appel kopen</div>
                    </div>
                    <div id="eventTijd" class="eventTijd">12:09</div>
                </div>
                <div id="toevoegen" class="toevoegen">
                    <div id="innerToevoeg" class="innerToevoeg">+</div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/javas.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/readDayScript.js"></script>
</body>

</html>

<?php
$_SESSION['previousPage'] = $_SERVER['REQUEST_URI'];

// If not logged in
if (!isset($_SESSION["loggedIn"])) {
    // Redirect automatically to the login page
    // header("Location: login.php"); // <--- UNCOMMENT THIS LINE BEFORE RELEASE!!!
}

if (isset($_POST["title"]) && isset($_POST["beginDate"])) {
    $userId      = $_SESSION["id"];
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $beginDate   = $_POST["beginDate"];
    $endDate     = $_POST["endDate"];
    $beginTime   = $_POST["beginTime"];
    $endTime     = $_POST["endTime"];

    require "dbConn.php";
    $query = $dbConn->prepare("INSERT INTO events (userId, title, description, beginDate, endDate, beginTime, endTime) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param('issssss', $userId, $title, $description, $beginDate, $endDate, $beginTime, $endTime);

    $previousPage = $_SESSION['previousPage'];

    if ($query->execute()) {
        // Redirect automatically to the previous page
        header("Location: $previousPage");
    } else {
        echo "<h1>Error inserting into database.</h1>";

        // Redirect automatically to the previous page after 3 seconds
        header("Refresh: 3; url = $previousPage");
    }
}
