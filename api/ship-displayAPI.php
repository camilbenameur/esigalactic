<?php 


$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

$query = $db->prepare("SELECT * FROM ship_archetype");
$query->execute();
$ships = $query->fetchAll();

if(!$ships) {
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

echo json_encode($ships)

?>