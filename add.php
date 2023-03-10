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
    <body>
        <form method="post">
            <div>
                <label>Begin date</label>
                <input type="date" name="beginDate" required>
            </div>
            <div>
                <label>End date</label>
                <input type="date" name="endDate">
            </div>
            <div>
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div>
                <label>Description</label>
                <input type="text" name="description">
            </div>
            <input type="submit">
        </form>
    </body>
</html>

<?php
    if(isset($_POST["title"])){
        echo "<h1>Received post!</h1>";

        $userId      = $_SESSION["id"];
        $title       = $_POST["title"];
        $description = $_POST["description"];
        $beginDate   = $_POST["beginDate"];
        $endDate     = $_POST["endDate"];

        require "dbConn.php";
        $query = $dbConn->prepare("INSERT INTO events (userId, title, description, beginDate, endDate) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('issss', $userId, $title, $description, $beginDate, $endDate);

        if($query->execute()){
            echo "<h1>Succesfully inserted into database! :)</h1>";
        }
        else{
            echo "<h1>Error inserting into database! :(</h1>";
        }
    }