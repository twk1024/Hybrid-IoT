<?php
include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

$device_id = $_GET['device_id'];
$limit = $_GET['limit'];

$sql = query("SELECT * FROM $device_id ORDER BY Date DESC LIMIT $limit");

if($limit == 1){
    while($result = $sql->fetch_array())
    {
        if($result["AirScore"] >= 96) $status = "매우 좋음";
        else if($result["AirScore"] >= 90 && $result["AirScore"] < 96) $status = "좋음";
        else if($result["AirScore"] >= 80 && $result["AirScore"] < 90) $status = "보통";
        else if($result["AirScore"] >= 70 && $result["AirScore"] < 80) $status = "나쁨";
        else if($result["AirScore"] >= 0 && $result["AirScore"] < 70) $status = "매우 나쁨";

        $json = ['device_id' => $result["DEVICE_ID"], 
        'date' => $result["Date"], 
        'airscore' => $result["AirScore"],
        'airscore_status' => $status,
        'co2' => $result["CO2"], 
        'temperature' => $result["Temperature"], 
        'humidity' => $result["Humidity"]];
        
        header('Content-type: application/json'); 
        echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}else{
    $data = [];
    while($result = $sql->fetch_array())
    {
        if($result["AirScore"] >= 96) $status = "매우 좋음";
        else if($result["AirScore"] >= 90 && $result["AirScore"] < 96) $status = "좋음";
        else if($result["AirScore"] >= 80 && $result["AirScore"] < 90) $status = "보통";
        else if($result["AirScore"] >= 70 && $result["AirScore"] < 80) $status = "나쁨";
        else if($result["AirScore"] >= 0 && $result["AirScore"] < 70) $status = "매우 나쁨";

        $json = ['device_id' => $result["DEVICE_ID"], 
        'date' => $result["Date"],
        'airscore' => $result["AirScore"],
        'airscore_status' => $status,
        'co2' => $result["CO2"], 
        'temperature' => $result["Temperature"], 
        'humidity' => $result["Humidity"]];

        array_push($data, $json);
    }
    header('Content-type: application/json'); 
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);

?>