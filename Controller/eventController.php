<?php

require_once('../Gateway/tripGateway.php');

$db = new Database();
$link = $db->connect();


$name = $_POST["name"];
$datetime = $_POST["datetime"];
$location = $_POST["location"];
$trip_id = $_POST["tid"];

$tripGateway = new TripGateway();
$tripGateway->insert_event($link, $name, $datetime, $location, $trip_id);
header('Location: ../en/trip.php?tid='.$trip_id.'&status=1001');
