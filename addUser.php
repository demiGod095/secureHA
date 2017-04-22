<?php
		require_once __DIR__ . '/conn.php';
    	$sql='SELECT * FROM dummy WHERE email ='.$email;
		$res= $conn->query($sql);
		else
		{
			$hash = md5( rand(0,1000) );
			//$password = rand(1000,5000);

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
		}
?>