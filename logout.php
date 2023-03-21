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
        <link rel="icon" type="image/x-icon" href="media/images/icon.ico">
        <title>Agender | Logging out...</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
</html>

<?php
    $previousPage = $_SESSION['previousPage'];
    if(isset($_SESSION['loggedIn'])){
        // Logout
        session_destroy();
        // Redirect automatically to the previous page
        header("Location: $previousPage");
        exit;
    }
    else{
        echo "
            <div id='contentDiv'>
                <div class='itemDiv'>
                    <h1>ERROR, u bent al uitgelogd.</h1>
                    <a href='$previousPage'>Terug</a>
                </div>
            </div>
        ";

        // Redirect automatically to the previous page after 3 seconds
        header("Refresh: 3; url = $previousPage");
    }