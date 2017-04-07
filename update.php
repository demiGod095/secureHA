<?php
    require_once 'conn.php';
    require_once 'dist.php';
    $hlat = 12.841666; //fetch from database
    $hlon = 80.154147; //fetch from database
    $thr = 0.2;

    if(isset($_POST['lat']) && isset($_POST['lon']))
    {
        $dlat = $_POST['lat'];
        $dlon = $_POST['lon'];
        $dis = distance($hlat, $hlon, $dlat, $dlon);
        if ($dis < $thr)
        {
            $sql = 'UPDATE users SET status = 1, dist = \''.$dis.'\' WHERE id = 1';
        }
        else
        {
            $sql = 'UPDATE users SET status = 0, dist = \''.$dis.'\' WHERE id = 1';
        }
        if ($conn->query($sql) === TRUE)
        {
            echo "Record updated successfully";
        }
        else
        {
            echo "Error updating record: " . $conn->error;
        }
        //echo "\n"." Dist =".$dis;
        //echo "\n"."sql = ".$sql;
    }
?>