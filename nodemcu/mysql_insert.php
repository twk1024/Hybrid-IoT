<?php

    $host = "host";
    $user = "user";
    $password = "password";
    $database = "database";

    $conn = mysqli_connect($host, $user, $password, $database);

    $device_id = $_GET['device_id'];
    $airscore = $_GET['airscore'];
    $temperature = $_GET['temperature'];
    $humidity = $_GET['humidity'];

    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO data(Date, DEVICE_ID, AirScore, Temperature, Humidity) VALUES('$date', '$device_id', '$airscore', '$temperature', '$humidity')";
     
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>