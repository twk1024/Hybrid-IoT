<?php
include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

$device_id = $_GET['device_id'];

$sql = query("SELECT DATE_FORMAT(Date,'%Y-%m-%d') m, MAX(Date), DEVICE_ID, AVG(AirScore), AVG(CO2), AVG(Temperature), AVG(Humidity) FROM $device_id GROUP BY m DESC LIMIT 7");

$i = 6; // 6=today, 5=yesterday ...
$data = [];
while($result = $sql->fetch_array())
{
    $json = [ 'device_id_' . $i => $result["DEVICE_ID"],
    'date_' . $i => $result["MAX(Date)"],
    'date_format_' . $i => $result["m"], 
    'airscore_' . $i => $result["AVG(AirScore)"],
    'co2_' . $i => $result["AVG(CO2)"], 
    'temperature_' . $i => $result["AVG(Temperature)"], 
    'humidity_' . $i => $result["AVG(Humidity)"]];

    $i--;
    array_push($data, $json);
}

header('Content-type: application/json'); 
echo json_encode($data, JSON_PRETTY_PRINT);

mysqli_close($conn);

?>