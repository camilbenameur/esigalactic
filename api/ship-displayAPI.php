<?php 

session_start();

$playerId = $_SESSION["player_id"];


$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

$query = $db->prepare("SELECT * FROM ship_archetype");
$query->execute();
$shipArchetypes = $query->fetchAll();

if(!$shipArchetypes) {
    insertShipArchetype("fighter ", 20, 3000, 500, 50, 75, 0);
    insertShipArchetype("cruiser", 120, 20000, 5000, 150, 400, 0);
    insertShipArchetype("carrier", 55, 6000, 1500, 50, 0, 100000);
    insertShipArchetype("colonization ship", 120, 10000, 10000, 50, 0, 0);
}


function insertShipArchetype ($name, $building_time, $metal_building_cost, $deuterium_building_cost, $defence_value, $offence_value, $fret_value) {
    global $db;
    $query = $db->prepare("INSERT INTO ship_archetype (name, building_time, metal_building_cost, deuterium_building_cost, defence_value, offence_value, fret_value) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $query->execute([$name, $building_time, $metal_building_cost, $deuterium_building_cost, $defence_value, $offence_value, $fret_value]);
}

$query = $db->prepare("SELECT s.id, s.planet_id, s.archetype_id, s.amount, p.player_id
FROM ship AS s
JOIN planet AS p ON s.planet_id = p.id
JOIN solar_system AS ss ON p.solar_system_id = ss.id
JOIN galaxy AS g ON ss.galaxy_id = g.id
WHERE p.player_id = ? AND g.universe_id = ?;");

$query->execute([$playerId, $_SESSION["universe-choice"]]);
$ships = $query->fetchAll();

$data = [
    "ships" => $ships,
    "shipArchetypes" => $shipArchetypes
];

echo json_encode($data);

?>