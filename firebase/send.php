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
//$payload['location']='XYZ';

$title = 'AC TURNED ON';
$message = "Tap 'on' or 'off' to change status";
$push->setTitle($title);
$push->setMessage($message);
$push->setImage('http://www.thepeacefulhaven.com/wp-content/uploads/2015/04/road-sign-361513_640.jpg');
$push->setIsBackground(TRUE);
//$push->setPayload($payload);

$json = '';
$response = '';

    $push->setPayload($payload);
    $json = $push->getPush();
    //$regId = isset($_GET['regId']) ? $_GET['regId'] : '';
    //$regId = 'flBGS8GMIdw:APA91bHvsVIfILX6uVeZ-GX4zYojdVEO7_ld9zxu1yTqdqd9WuG9RoNBRkeWZ67FEXQ8vvkZnawNiIYTalsWnP3o7fE0PCbFfJC3FRtqP1OWJrDXFSvFjBnXGtN1n6AsLs_b2yYmCQ4V';
    $response = $firebase->send($regId, $json);
    echo $response."<br><br>";
    print_r($json);
    echo "<br><br>";
    print_r($push);
    //echo "<br><br>";
    //print_r($firebase);
/*else
{
    $json = $push->getPush();
    $response = $firebase->sendToTopic('global', $json);
    
    echo "sent global";
}*/
?>