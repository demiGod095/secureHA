<?php
    require_once 'conn.php';
    require_once 'dist.php';
    $hlat = 12.841666; //fetch from database
    $hlon = 80.154147; //fetch from database
    $thr = 0.2;

    if(isset($_POST['lat']) && isset($_POST['lon']))
    {
        $id=1;
        $dlat = $_POST['lat'];
        $dlon = $_POST['lon'];
        $dis = distance($hlat, $hlon, $dlat, $dlon);
        if ($dis < $thr)
        {
            $sql = 'SELECT status FROM users Where ID = '.$id;
            $res = $conn->query($sql);
            $row = $res->fetch_assoc();
            $status = $row['status'];
            if ( $status == 0)
            {
                $sql = 'UPDATE users SET status = 1, dist = \''.$dis.'\' WHERE id = '.$id;
                if ($conn->query($sql) === TRUE)
                {
                    echo "ON";
                    $sql = "SELECT fkey FROM users WHERE id = ".$id;
                    $res = $conn->query($sql);
                    $row = $res->fetch_assoc();
                    $regId = $row['fkey'];
                    include 'firebase/send.php';
                }
                else
                {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        else
        {
            $sql = 'UPDATE users SET status = 0, dist = \''.$dis.'\' WHERE id = '.$id;
            if ($conn->query($sql) === TRUE)
            {
                echo "OFF";
            }
            else
            {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
?>