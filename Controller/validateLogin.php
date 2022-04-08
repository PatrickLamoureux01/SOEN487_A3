<?php

require_once('../Gateway/userGateway.php');

$db = new Database();
$link = $db->connect();

$email = $_POST['email'];
$password = $_POST['password'];

$userGateway = new UserGateway();
$validBit = $userGateway->authenticate_user($link,$email,$password);

if ($validBit == 1) {
    header('Location: ../en/index.php');
} else {
    header('Location: ../en/login.php?status=2000');
}
?>