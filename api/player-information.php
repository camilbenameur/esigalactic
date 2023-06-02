<?php

session_start();

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

if(isset($_GET["player-id"]))
{
    $playerId = $_GET["player-id"];
    $query = $db->prepare("SELECT * FROM player WHERE id = ?;");
    $query->execute([$playerId]);
    $player = $query->fetchAll();

    echo json_encode($player[0]);
}

