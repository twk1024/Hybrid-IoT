<?php

	function getLastDate($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['date'] != null) {
			$result = $json['date'];
		}else{
			$result = "Unknown";
		}
		
		return $result;
	}

	function getAirScore($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['airscore'] != null) {
			$result = $json['airscore'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getCo2($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['co2'] != null) {
			$result = $json['co2'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getTemperature($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['temperature'] != null) {
			$result = $json['temperature'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getHumidity($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['humidity'] != null) {
			$result = $json['humidity'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

?>