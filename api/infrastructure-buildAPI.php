<?php

session_start();

$archetype_id = $_GET["archetype-choice"];
$planet_id = $_SESSION["planet_id"];
$infrastructureLevel = $_GET["infrastructure-level"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ?;");
$query->execute([$_SESSION["player_id"]]);
$wallet = $query->fetchAll();

$metal = $wallet[0]["metal"];
$deuterium = $wallet[0]["deuterium"];
$energy = $wallet[0]["energy"];

$query = $db->prepare("SELECT * FROM infrastructure_archetype WHERE id = ?;");
$query->execute([$archetype_id]);
$archetype = $query->fetchAll();

$metal_cost = $archetype[0]["metal_cost"];
$deuterium_cost = $archetype[0]["deuterium_cost"];
$energy_cost = $archetype[0]["energy_cost"];

if ($infrastructureLevel == 0) {
    if ($metal >= $metal_cost && $deuterium >= $deuterium_cost && $energy >= $energy_cost) {
        $metal = $metal - $metal_cost;
        $deuterium = $deuterium - $deuterium_cost;
        $energy = $energy - $energy_cost;

        $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ?;");
        $query->execute([$metal, $deuterium, $energy, $_SESSION["player_id"]]);

        $query = $db->prepare("INSERT INTO infrastructure (planet_id, archetype_id, level) VALUES (?, ?, ?);");
        $query->execute([$planet_id, $archetype_id, 1]);

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

        $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ?;");
        $query->execute([$metal, $deuterium, $energy, $_SESSION["player_id"]]);

        $query = $db->prepare("UPDATE infrastructure SET level = ? WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$infrastructureLevel, $planet_id, $archetype_id]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
