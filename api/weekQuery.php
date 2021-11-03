<?php
include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

$device_id = $_GET['device_id'];

$sql = query("SELECT DATE_FORMAT(Date,'%Y-%m-%d') m, MAX(Date), DEVICE_ID, AVG(AirScore), AVG(CO2), AVG(Temperature), AVG(Humidity) FROM $device_id GROUP BY m DESC LIMIT 7");

$data = [];
while($result = $sql->fetch_array())
{
    if($result["AVG(AirScore)"] >= 96) $status = "매우 좋음";
    else if($result["AVG(AirScore)"] >= 90 && $result["AVG(AirScore)"] < 96) $status = "좋음";
    else if($result["AVG(AirScore)"] >= 80 && $result["AVG(AirScore)"] < 90) $status = "보통";
    else if($result["AVG(AirScore)"] >= 70 && $result["AVG(AirScore)"] < 80) $status = "나쁨";
    else if($result["AVG(AirScore)"] >= 0 && $result["AVG(AirScore)"] < 70) $status = "매우 나쁨";

    $json = [ 'device_id' => $result["DEVICE_ID"],
    'date' => $result["MAX(Date)"],
    'date_format' => $result["m"], 
    'airscore' => $result["AVG(AirScore)"],
    'airscore_status' => $status,
    'co2' => $result["AVG(CO2)"], 
    'temperature' => $result["AVG(Temperature)"], 
    'humidity' => $result["AVG(Humidity)"]];

    array_push($data, $json);
}

header('Content-type: application/json'); 
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

mysqli_close($conn);

?>