<?php
    require_once 'conn.php';
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        
        $sql = "SELECT status FROM users WHERE id = " .$id ;

        $search = $conn->query($sql);
        $row = $search->fetch_assoc();
        echo $row['status'];
    }
    else
    {
        echo "INVALID";
    }
    $conn->close();
?>