<?php
    require_once 'conn.php';
    
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        echo "logged";
        exit(0);
        
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
            echo "Dist = " .$dis;
        }
        else
        {
            echo "Error updating record: " . $conn->error;
        }
        //echo "\n"." Dist =".$dis;
        //echo "\n"."sql = ".$sql;
    }
?>