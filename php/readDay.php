<?php
    if(isset($_POST["date"])){
        $date = $_POST["date"];
        require "dbConn.php";

        $query  = $dbConn->prepare("SELECT * FROM events WHERE beginDate = ?");
        $query->bind_param('s', $date);
        $query->execute();
        $result = $query->get_result();
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);

        while($row = mysqli_fetch_assoc($result)){
            echo "
                <div>
                    <p>Title: ". $row['title']. "</p>
                    <p>Description: ". $row['description']. "</p>
                    <p>Begin date: ". $row['beginDate']. "</p>
                    <p>End date: ". $row['endDate']. "</p>
                </div>
                <br>
            ";
        }
    }