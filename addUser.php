<?php
		require_once 'conn.php';
			//$password = rand(1000,5000);
		echo "HI";
			$sql= 'INSERT INTO users(username, password, homeLat, homeLon, status, dist) 
					VALUES (\'shreyas\',
							 \''.md5(shreyas).'\',
							 12.840832,
							 80.153790,
							 0,
							 0.5)';
			if($conn->query($sql) === TRUE)
			{
				echo 'PASS';
			}
			else
			{
				echo 'DB FAIL';
			}
?>