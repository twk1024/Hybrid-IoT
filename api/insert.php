<?php

    include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

    $device_id = $_GET['device_id'];
    $airscore = $_GET['airscore'];
    $co2 = $_GET['co2'];
    $temperature = $_GET['temperature'];
    $humidity = $_GET['humidity'];

    $date = date("Y-m-d H:i:s");
    
    $table = query("CREATE TABLE IF NOT EXISTS $device_id(Date DATETIME, DEVICE_ID VARCHAR(6), AirScore INT, CO2 INT, Temperature INT, Humidity INT)");

    $sql = query("INSERT INTO $device_id(Date, DEVICE_ID, AirScore, CO2, Temperature, Humidity) VALUES('$date', '$device_id', '$airscore', '$co2', '$temperature', '$humidity')");
    
    mysqli_close($conn);
?>