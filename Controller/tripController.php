<?php

require_once('../Gateway/tripGateway.php');

$db = new Database();
$link = $db->connect();
$tripGateway = new TripGateway();

$action = $_POST["action"];

if ($action == "create") {
    $name = $_POST["trip_name"];
    $dep = $_POST["dep_country"];
    $arv = $_POST["arv_country"];
    $start = $_POST["trip_start_date"];
    $end = $_POST["trip_end_date"];

    $dep_cnt = explode('-',$dep)[1];
    $dep_city = explode('-',$dep)[0];

    $arv_cnt = explode('-',$arv)[1];
    $arv_city = explode('-',$arv)[0];

   
    $tripGateway->insert_trip($link, $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end);
    header('Location: ../en/index.php?status=1000');
} else if ($action == "edit") {
    $name = $_POST["trip_name"];
    $dep = $_POST["dep_country"];
    $arv = $_POST["arv_country"];
    $start = $_POST["trip_start_date"];
    $end = $_POST["trip_end_date"];
    $trip_id = $_POST["tid"];

    $dep_cnt = explode('-',$dep)[1];
    $dep_city = explode('-',$dep)[0];

    $arv_cnt = explode('-',$arv)[1];
    $arv_city = explode('-',$arv)[0];

    
    $tripGateway->edit_trip($link, $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end, $trip_id);
    header('Location: ../en/index.php?status=1001');
} else {
    
    $trip_id = $_POST["tid"];
    $tripGateway->delete_trip($link, $trip_id);
    header('Location: ../en/index.php?status=1002');
}
