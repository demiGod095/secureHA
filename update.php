<?php
    require_once 'conn.php';
    require_once 'dist.php';

    $thr = 0.2;
    $id=1;

    $sql = 'SELECT homeLat, homeLon FROM users Where ID = '.$id;
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $hlat = $row['homeLat'];
    $hlon = $row['homeLon'];

    if(isset($_POST['lat']) && isset($_POST['lon']) && isset($_POST['upd']))
    {
        
        $dlat = $_POST['lat'];
        $dlon = $_POST['lon'];
        $upd = $_POST['upd'];
        if($upd == 'true')
        {
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
                        echo "ON (Auto)";
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
                    echo "OFF (Auto)";
                }
                else
                {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        else
        {
            $sql = 'SELECT status FROM users Where ID = '.$id;
            $res = $conn->query($sql);
            $row = $res->fetch_assoc();
            $status = $row['status'];
            if ( $status == 0)
            {
                echo "OFF (Manual)";
            }
            else
            {
                echo "ON (Manual)";
            }
        }
    }
?>