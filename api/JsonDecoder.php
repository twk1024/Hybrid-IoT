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

	function getWeekDate($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$offset = 6 - $day;
		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$offset]['date_format_' . $day] != null) {
			$result = $json[$offset]['date_format_' . $day];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getWeekAirScore($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$offset = 6 - $day;
		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$offset]['airscore_' . $day] != null) {
			$result = $json[$offset]['airscore_' . $day];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getWeekCo2($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$offset = 6 - $day;
		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$offset]['co2_' . $day] != null) {
			$result = $json[$offset]['co2_' . $day];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getWeekTemperature($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$offset = 6 - $day;
		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$offset]['temperature_' . $day] != null) {
			$result = $json[$offset]['temperature_' . $day];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getWeekHumidity($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$offset = 6 - $day;
		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$offset]['humidity_' . $day] != null) {
			$result = $json[$offset]['humidity_' . $day];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

?>