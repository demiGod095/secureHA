<?php
require_once 'conn.php';
$hlat = 12.844158;
$hlon = 80.152443;
$thr = 0.2;

function distance($lat1, $lon1, $lat2, $lon2)
{

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $kilo = $miles * 1.609344;

  return $kilo;
}

    if(isset($_POST['lat']) && isset($_POST['lon']))
    {
        $dlat = $_POST['lat'];
        $dlon = $_POST['lon'];
        $dis = distance($hlat, $hlon, $dlat, $dlon);
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
            echo "Record updated successfully";
        }
        else
        {
            echo "Error updating record: " . $conn->error;
        } 
        echo "\n"." Dist =".$dis;
        echo "\n"."sql = ".$sql;


    }
    else
    {
        echo 'NO DATA';
    }
?>