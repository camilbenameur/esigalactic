<?php

session_start();

$playerId = $_SESSION["player_id"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ?;");
$query->execute([$playerId]);
$rows = $query->fetchAll();

echo json_encode($rows);