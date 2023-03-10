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
        <title>Agender | Add event</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
</html>

<?php
    if(isset($_SESSION["loggedIn"])){
        echo "
            <form method='post'>
                <div>
                    <label>Begin date</label>
                    <input type='date' name='beginDate' required>
                </div>
                <div>
                    <label>End date</label>
                    <input type='date' name='endDate'>
                </div>
                <div>
                    <label>Title</label>
                    <input type='text' name='title' required>
                </div>
                <div>
                    <label>Description</label>
                    <input type='text' name='description'>
                </div>
                <input type='submit'>
            </form>
        ";
    }
    else{
        echo "
            <h1>ERROR, U moet ingelogd zijn om een event toe te voegen.</h1>
        ";

        // Redirect automatically to the previous page after 3 seconds
        $previousPage = $_SESSION['previousPage'];
        header("Refresh: 3; url = $previousPage");
    }

    if(isset($_POST["title"]) && isset($_POST["beginDate"])){
        $userId      = $_SESSION["id"];
        $title       = $_POST["title"];
        $description = $_POST["description"];
        $beginDate   = $_POST["beginDate"];
        $endDate     = $_POST["endDate"];

        require "dbConn.php";
        $query = $dbConn->prepare("INSERT INTO events (userId, title, description, beginDate, endDate) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('issss', $userId, $title, $description, $beginDate, $endDate);

        $previousPage = $_SESSION['previousPage'];

        if($query->execute()){
            // Redirect automatically to the previous page
            header("Location: $previousPage");
        }
        else{
            echo "<h1>Error inserting into database.</h1>";

            // Redirect automatically to the previous page after 3 seconds
            header("Refresh: 3; url = $previousPage");
        }
    }