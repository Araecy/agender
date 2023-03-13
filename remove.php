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
        <title>Agender | Removing item...</title>
        <link rel="icon" type="image/x-icon" href="media/images/icon.ico">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/removeStyle.css">
    </head>
    <body>
    </body>
</html>


<?php
    require "dbConn.php";

    $itemId     = $_REQUEST['itemId'];
    $uploaderId = $_REQUEST['uploaderId'];
    $filename   = $_REQUEST['filename'];

    $query      = "DELETE FROM bodyPillows WHERE id = '$itemId'";

    // Delete item from database
    mysqli_query($dbConn, $query);
    // Delete image from server
    unlink("uploadedImages/$uploaderId/$filename");

    // Redirect automatically to the previous page
    header("Location: ./". $_SESSION['previousPage']);
?>