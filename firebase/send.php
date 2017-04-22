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

$title = 'LOL';
$message = 'HELLO';
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
    $regId = 'dmZjatRsD6Q:APA91bH0eoQeORWIs9GSueTDkQwmO_sPXUcEswxXucDduXEBTnFwY9F6inMzOWRVeFGERwXgeGbeZoFKhi5LCh52FEtGRtmMOBKahMlVaByvygeCHVauUpjtAo1PFu7iFDBrDB48JfEh';
    $response = $firebase->send($regId, $json);
    echo $response;
/*else
{
    $json = $push->getPush();
    $response = $firebase->sendToTopic('global', $json);
    
    echo "sent global";
}*/
?>