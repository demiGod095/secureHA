<?php
// Enabling error reporting
error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase.php';
require_once __DIR__ . '/push.php';

$firebase = new Firebase();
$push = new Push();

// optional payload
$payload = array();
$payload['test']='test';
$payload['location']='XYZ';

$title = 'JouncePay';
$message = 'You\'re at a Petrol Pump.';
$push->setTitle($title);
$push->setMessage($message);
$push->setImage('http://www.thepeacefulhaven.com/wp-content/uploads/2015/04/road-sign-361513_640.jpg');
$push->setIsBackground(TRUE);
//$push->setPayload($payload);

$json = '';
$response = '';

if(isset($_GET['dmac']) && isset($_GET['pmac']))
{
	require '../db/conn.php';
    $esp = $_GET['dmac'];
    $sql = 'SELECT fkey FROM dummy WHERE dmac = '.'\''.$esp.'\'';
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows == 1)
    {
    	$row = $result->fetch_assoc();
        $regId = $row['fkey'];
        //echo $regId;
    }
	else
	{
    	echo "Invalid Results";
        die();
	}

    $pump = $_GET['pmac'];
    $sql = 'SELECT location FROM pumps WHERE pmac = '.'\''.$pump.'\'';
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
        $pLoc = $row['location'];
        //echo $regId;
    }
    else
    {
        echo "Invalid Location";
        die();
    }

    $conn->close();

    $payload['location']=$pLoc;
    $push->setPayload($payload);
    $json = $push->getPush();
    //$regId = isset($_GET['regId']) ? $_GET['regId'] : '';
    $response = $firebase->send($regId, $json);
    echo $pLoc;
}
else
{
    $json = $push->getPush();
    $response = $firebase->sendToTopic('global', $json);
    
    echo "sent global";
}
?>