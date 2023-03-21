<?php
    $host     = "localhost";
    $username = "beroeps2AgenderUser";
    $password = "oCuS4aZH5ziVh67v&8y82K#bfH9*jo*y2*j3*@sRwEtRgYWA4!%ho#3LrBuHzYv#Uo^83KZ!t8JiKt96uAtgiR!w2!F@Cxa@5S7DocEYhGo#5x6c7ECs8z989DBqDV%H";
    $database = "beroeps2Agender";

    $dbConn   = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if(!$dbConn){
        die("ERROR: Could not connect to database. ". mysqli_connect_error());
    }