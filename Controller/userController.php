<?php

require_once('../Gateway/userGateway.php');

$db = new Database();
$link = $db->connect();

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$address = $_POST["address"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$pass_r = $_POST["password_repeat"];


if ($password != $pass_r) {
    header('Location: ../en/signup.php?error=3000');
}

$password = sha1($password); // encrypt password
$userGateway = new UserGateway();
$userGateway->insert_user($link,$fname,$lname,$email,$address,$country,$phone,$password);
header('Location: ../en/login.php?status=1000');

?>