<?php

require_once('../Gateway/tripGateway.php');

$db = new Database();
$link = $db->connect();

$action = $_POST["action"];

if ($action == "create") {
    $name = $_POST["trip_name"];
    $dep = $_POST["dep_country"];
    $arv = $_POST["arv_country"];
    $start = $_POST["trip_start_date"];
    $end = $_POST["trip_end_date"];


    $tripGateway = new TripGateway();
    $tripGateway->insert_trip($link, $name, $dep, $arv, $start, $end);
    header('Location: ../en/index.php?status=1000');
} else if ($action == "edit") {
} else {
}
