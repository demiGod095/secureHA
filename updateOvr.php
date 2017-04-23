<?php
    require_once 'conn.php';

    if(isset($_POST['ovrStatus']))
    {
        $id=1;
        $newStatus = $_POST['ovrStatus'];
        
        $sql = 'UPDATE users SET status = '.$newStatus.' WHERE id = '.$id;
        if ($conn->query($sql) === TRUE)
        {
            echo "AC : ".$newStatus;
        }
        else
        {
            echo "Error updating : " . $conn->error;
        }
    }
?>