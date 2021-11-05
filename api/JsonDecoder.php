<?php

	function getLastDate($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
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
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
		$json = json_decode($api, true);

		if ($json['airscore'] != null) {
			$result = $json['airscore'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getAirScoreStatus($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
		$json = json_decode($api, true);

		if ($json['airscore_status'] != null) {
			$result = $json['airscore_status'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getCo2($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
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
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
		$json = json_decode($api, true);

		if ($json['temperature'] != null) {
			$result = $json['temperature'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function isOnline($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/onlineChecker.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json['online'] != null) {
			$result = $json['online'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getHumidity($device_id)
	{
		$api =  file_get_contents('http://hybrid.diamc.kr/api/query.php?device_id=' . $device_id . "&limit=1");
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

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['date_format'] != null) {
			$result = $json[$day]['date_format'];
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

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['airscore'] != null) {
			$result = $json[$day]['airscore'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

	function getWeekAirScoreStatus($device_id, $day)
	{
		if($day < 0 || $day > 6)
		{
			$error = "Day value should be between 6 and 0";
			return $error;
		}

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['airscore_status'] != null) {
			$result = $json[$day]['airscore_status'];
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

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['co2'] != null) {
			$result = $json[$day]['co2'];
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

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['temperature'] != null) {
			$result = $json[$day]['temperature'];
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

		$api =  file_get_contents('http://hybrid.diamc.kr/api/weekQuery.php?device_id=' . $device_id);
		$json = json_decode($api, true);

		if ($json[$day]['humidity'] != null) {
			$result = $json[$day]['humidity'];
		}else{
			$result = "Unknown";
		}

		return $result;
	}

?>