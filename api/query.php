<?php
include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

$device_id = $_GET['device_id'];

$sql = query("SELECT * FROM $device_id ORDER BY Date DESC LIMIT 1");

while($result = $sql->fetch_array())
{
    $json = ['device_id' => $result["DEVICE_ID"], 
    'date' => $result["Date"], 
    'airscore' => $result["AirScore"],
    'co2' => $result["CO2"], 
    'temperature' => $result["Temperature"], 
    'humidity' => $result["Humidity"]];
    
    header('Content-type: application/json'); 
    echo json_encode($json, JSON_PRETTY_PRINT);
}
mysqli_close($conn);

?>