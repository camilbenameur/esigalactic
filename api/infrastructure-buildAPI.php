<?php

session_start();

$archetypeId = $_GET["archetype-choice"];
$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];
$playerId = $_SESSION["player_id"];

$infrastructureLevel = $_GET["infrastructure-level"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
$query->execute([$playerId, $universeId]);
$wallet = $query->fetchAll();

$metal = $wallet[0]["metal"];
$deuterium = $wallet[0]["deuterium"];
$energy = $wallet[0]["energy"];

$query = $db->prepare("SELECT * FROM infrastructure_archetype WHERE id = ?;");
$query->execute([$archetypeId]);
$archetype = $query->fetchAll();

$metal_cost = $archetype[0]["metal_cost"];
$deuterium_cost = $archetype[0]["deuterium_cost"];
$energy_cost = $archetype[0]["energy_cost"];

if ($infrastructureLevel == 0) {
    if ($metal >= $metal_cost && $deuterium >= $deuterium_cost && $energy >= $energy_cost) {
        $metal = $metal - $metal_cost;
        $deuterium = $deuterium - $deuterium_cost;
        $energy = $energy - $energy_cost;

        $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$metal, $deuterium, $energy, $playerId, $universeId]);

        $query = $db->prepare("INSERT INTO infrastructure (planet_id, archetype_id, level) VALUES (?, ?, ?);");
        $query->execute([$planetId, $archetypeId, 1]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    $metal_cost *= pow(1.6, $infrastructureLevel);
    $deuterium_cost *= pow(1.6, $infrastructureLevel);
    $energy_cost *= pow(1.6, $infrastructureLevel);

    if ($metal >= $metal_cost && $deuterium >= $deuterium_cost && $energy >= $energy_cost) {
        $metal = $metal - $metal_cost;
        $deuterium = $deuterium - $deuterium_cost;
        $energy = $energy - $energy_cost;
        $infrastructureLevel++;

        $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$metal, $deuterium, $energy, $playerId, $universeId]);
        
        $query = $db->prepare("UPDATE infrastructure SET level = ? WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$infrastructureLevel, $planetId, $archetypeId]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
