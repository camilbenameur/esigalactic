<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$archetypeId = $_GET["archetype-choice"];

$playerId = $_SESSION["player_id"];
$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];


$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
$query->execute([$playerId, $universeId]);
$wallet = $query->fetchAll();

$metal = $wallet[0]["metal"];
$deuterium = $wallet[0]["deuterium"];
$energy = $wallet[0]["energy"];

$query = $db->prepare("SELECT * FROM infrastructure WHERE planet_id = ? AND archetype_id = ?;");
$query->execute([$planetId, 2]);
$shipyard = $query->fetchAll();


$query = $db->prepare("SELECT * FROM ship_archetype WHERE id = ?;");
$query->execute([$archetypeId]);
$archetype = $query->fetchAll();

$metal_cost = $archetype[0]["metal_building_cost"];
$deuterium_cost = $archetype[0]["deuterium_building_cost"];

$query = $db->prepare("SELECT * FROM ship WHERE planet_id = ? AND archetype_id = ?;");
$query->execute([$planetId, $archetypeId]);
$ship = $query->fetchAll();

if($shipyard) {
    if(!$ship && $metal >= $metal_cost && $deuterium >= $deuterium_cost) {
        $metal = $metal - $metal_cost;
        $deuterium = $deuterium - $deuterium_cost;
        $query = $db->prepare("INSERT INTO ship (planet_id, archetype_id, amount) VALUES (?, ?, ?);");
        $query->execute([$planetId, $archetypeId, 1]);
        echo "Ship built !";
    } else if($ship && $metal >= $metal_cost && $deuterium >= $deuterium_cost) {
        $metal = $metal - $metal_cost;
        $deuterium = $deuterium - $deuterium_cost;
        $query = $db->prepare("UPDATE ship SET amount = ? WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$ship[0]["amount"] + 1, $planetId, $archetypeId]);
        echo "Ship built !";
    }  
    $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ? WHERE player_id = ? AND universe_id = ?;");
    $query->execute([$metal, $deuterium, $playerId, $universeId]);
}