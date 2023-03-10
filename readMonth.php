<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agender | Read month</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form method="post">
            <input type="month" name="date">
            <input type="submit">
        </form>
    </body>
</html>

<?php
    // if(isset($_POST["date"])){
    //     $date = $_POST["date"];
    //     require "dbConn.php";

    //     $query  = $dbConn->prepare("SELECT * FROM events WHERE beginDate = ?");
    //     $query->bind_param('s', $date);
    //     $query->execute();
    //     $result = $query->get_result();
    //     $row = mysqli_fetch_array($result, MYSQLI_BOTH);

    //     while($row = mysqli_fetch_assoc($result)){
    //         echo "
    //             <div>
    //                 <p>Title: ". $row['title']. "</p>
    //                 <p>Description: ". $row['description']. "</p>
    //                 <p>Begin date: ". $row['beginDate']. "</p>
    //                 <p>End date: ". $row['endDate']. "</p>
    //             </div>
    //             <br>
    //         ";
    //     }
    // }

    if(isset($_POST["date"])){
        echo $_POST["date"];
    }