<?php

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

$archetypeName = "research lab";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 50, 500, 1000, 0, 0, 0, 1);
    insertInfrastructureFacility($db);
}

$archetypeName = "shipyard";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 50, 500, 500, 0, 0, 0, 2);
    insertInfrastructureFacility($db);
}

$archetypeName = "nanite factory";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 600, 5000, 10000, 0, 0, 0, 3);
    insertInfrastructureFacility($db);
}

$archetypeName = "metal mine";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 10, 10, 100, 0, 1, 0, 0);
    insertInfrastructureResources($db, "metal", "2", "3");
}

$archetypeName = "deuterium synthesizer";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 25, 50, 200, 0, 2, 0, 0);
    insertInfrastructureResources($db, "deuterium", "3", "1");
}

$archetypeName = "solar plant";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 10, 0, 150, 20, 3, 0, 0);
    insertInfrastructureResources($db, "energy", "1", "20");
}

$archetypeName = "fusion plant";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 120, 2000, 5000, 2000, 4, 0, 0);
    insertInfrastructureResources($db, "energy", "1", "50");
}

$archetypeName = "laser artillery";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 10, 0, 1500, 300, 0, 1, 0);
    insertInfrastructureDefence($db, 25, 100);
}

$archetypeName = "ion cannon";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 40, 0, 5000, 1000, 0, 2, 0);
    insertInfrastructureDefence($db, 200, 250);
}

$archetypeName = "shield";
if (!checkIfExists($db, 'infrastructure_archetype', 'name', $archetypeName)) {
    insertInfrastructureArchetype($db, $archetypeName, 60, 1000, 10000, 5000, 0, 3, 0);
    insertInfrastructureDefence($db, 2000, 0);
}


/**
 * Helper function to check if a value already exists in the specified table and column.
 *
 * @param PDO $db The PDO database connection
 * @param string $table The table name
 * @param string $column The column name to check
 * @param string $value The value to search for
 * @return bool True if the value exists, false otherwise
 */
function checkIfExists($db, $table, $column, $value) {
    $query = $db->prepare("SELECT COUNT(*) FROM $table WHERE $column = ?");
    $query->execute([$value]);
    $count = $query->fetchColumn();
    return $count > 0;
}

/**
 * Helper function to insert a new row into the infrastructure_archetype table.
 *
 * @param PDO $db The PDO database connection
 * @param string $name The name of the archetype
 * @param int $buildingTime The building time
 * @param int $energyCost The energy cost
 * @param int $metalCost The metal cost
 * @param int $deuteriumCost The deuterium cost
 * @param int $resourceId The resource ID
 * @param int $defenceId The defence ID
 * @param int $facilityId The facility ID
 */
function insertInfrastructureArchetype($db, $name, $buildingTime, $energyCost, $metalCost, $deuteriumCost, $resourceId, $defenceId, $facilityId) {
    $query = $db->prepare("INSERT INTO infrastructure_archetype
        (id, name, building_time, energy_cost, metal_cost, deuterium_cost, resource_id, defence_id, facility_id)
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
    $query->execute([$name, $buildingTime, $energyCost, $metalCost, $deuteriumCost, $resourceId, $defenceId, $facilityId]);
}

/**
 * Helper function to insert a new row into the infrastructure_facility table.
 *
 * @param PDO $db The PDO database connection
 */
function insertInfrastructureFacility($db) {
    $query = $db->prepare("INSERT INTO infrastructure_facility (id) VALUES (NULL);");
    $query->execute();
}

/**
 * Helper function to insert a new row into the infrastructure_resources table.
 *
 * @param PDO $db The PDO database connection
 * @param string $resourceName The resource name
 * @param int $resourceType The resource type
 * @param int $productionRate The production rate
 */
function insertInfrastructureResources($db, $resourceName, $resourceType, $productionRate) {
    $query = $db->prepare("INSERT INTO infrastructure_resources (id, resource_name, resource_type, production_rate)
        VALUES (NULL, ?, ?, ?);");
    $query->execute([$resourceName, $resourceType, $productionRate]);
}

/**
 * Helper function to insert a new row into the infrastructure_defence table.
 *
 * @param PDO $db The PDO database connection
 * @param int $defenceValue The defence value
 * @param int $offenceValue The offence value
 */
function insertInfrastructureDefence($db, $defenceValue, $offenceValue) {
    $query = $db->prepare("INSERT INTO infrastructure_defence (id, defence_value, offence_value) VALUES (NULL, ?, ?);");
    $query->execute([$defenceValue, $offenceValue]);
}

?>
