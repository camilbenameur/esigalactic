<?php 

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "research lab",
    "50",
    "500",
    "1000",
    "0",
    "0",
    "0",
    "1",
]);

$query = $db->prepare("INSERT INTO infrastructure_facility (id) VALUES (NULL);");
$query->execute();

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "shipyard",
    "50",
    "500",
    "500",
    "0",
    "0",
    "0",
    "2",
]);

$query = $db->prepare("INSERT INTO infrastructure_facility (id) VALUES (NULL);");
$query->execute();

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "nanite factory",
    "600",
    "5000",
    "10000",
    "0",
    "0",
    "0",
    "3",
]);

$query = $db->prepare("INSERT INTO infrastructure_facility (id) VALUES (NULL);");
$query->execute();


$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "metal mine",
    "10",
    "10",
    "100",
    "0",
    "1",
    "0",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_resources (id, resource_name, resource_type, production_rate) VALUES (NULL, ?, ?, ?);");
$query->execute([
    "metal",
    "2",
    "3",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "deuterium synthesizer",
    "25",
    "50",
    "200",
    "0",
    "2",
    "0",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_resources (id, resource_name, resource_type, production_rate) VALUES (NULL, ?, ?, ?);");
$query->execute([
    "deuterium",
    "3",
    "1",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "solar plant",
    "10",
    "0",
    "150",
    "20",
    "3",
    "0",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_resources (id, resource_name, resource_type, production_rate) VALUES (NULL, ?, ?, ?);");
$query->execute([
    "energy",
    "1",
    "20",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "fusion plant",
    "120",
    "2000",
    "5000",
    "2000",
    "4",
    "0",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_resources (id, resource_name, resource_type, production_rate) VALUES (NULL, ?, ?, ?);");
$query->execute([
    "energy",
    "1",
    "50",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype 
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id) 
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "laser artillery",
    "10",
    "0",
    "1500",
    "300",
    "0",
    "1",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_defence (id, defence_value, offence_value) VALUES (NULL, ?, ?) ;");
$query->execute([
    "25",
    "100",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "ion cannon",
    "40",
    "0",
    "5000",
    "1000",
    "0",
    "2",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_defence (id, defence_value, offence_value) VALUES (NULL, ?, ?) ;");
$query->execute([
    "200",
    "250",
]);

$query = $db->prepare("INSERT INTO infrastructure_archetype
(id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
$query->execute([
    "shield",
    "60",
    "1000",
    "10000",
    "5000",
    "0",
    "3",
    "0",
]);

$query = $db->prepare("INSERT INTO infrastructure_defence (id, defence_value, offence_value) VALUES (NULL, ?, ?) ;");
$query->execute([
    "2000",
    "0",
]);


?>