<?php
	// DISTANCE FORMULA ON EARTH
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
	//echo distance(12.8445795, 80.1536131, 12.8404058, 80.1528406) . " Kilometers<br>";
?>