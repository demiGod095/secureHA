<?php
    require_once 'conn.php';
    
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $usname = $_POST['username']; // Set email variable
        $pass = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE username='".$usname."' AND password='".md5($pass);
        echo $sql."<br>";
        $search = $conn->query($sql);

        //print_r($search);
        $match  = mysqli_num_rows($search);
        if($match == 1)
        {
            echo "logged";
        }
        else
        {
            echo "FAIL";
        }

    }
?>