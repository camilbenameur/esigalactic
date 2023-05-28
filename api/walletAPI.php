<?php

session_start();

$playerId = $_SESSION["player_id"];
$universeId = $_SESSION["universe-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
$query->execute([$playerId, $universeId]);
$rows = $query->fetchAll();

echo json_encode($rows);