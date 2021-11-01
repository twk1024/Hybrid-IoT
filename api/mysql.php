<?php

	header('Content-Type: text/html; charset=utf-8');

    $host = "host";
    $user = "user";
    $password = "password";
    $database = "database";

    $conn = mysqli_connect($host, $user, $password, $database);
	$conn->set_charset("utf8");

	function query($query)
	{
		global $conn;
		return $conn->query($query);
	}
?>