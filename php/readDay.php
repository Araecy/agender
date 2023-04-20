<?php
    $array = array();
    $rows = array();

    if(isset($_POST["date"])){
        require_once "dbConn.php";

        $date  = $_POST["date"];
        $day   = substr($date, 0, strpos($date, " "));
        $month = substr($date, strpos($date, " ")+1, strpos($date, " "));
        $year  = substr($date, strpos($date, $month) + 2);
        $date  = "$year-". ($month + 1) . "-$day";

        $query = $dbConn->prepare("SELECT * FROM events WHERE beginDate = ?");
        $query->bind_param('s', $date);
        if($query->execute()){
            if($result = $query->get_result()){
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $rows[] = $row;
                    }
                    $array[] = $rows;
                }
            }
            else{
                $array = 0;
            }
        }
        else{
            $array = 0;
        }
    }

    // Encode the array as a JSON array and return it
    $jsonArray = json_encode($array);
    echo $jsonArray;