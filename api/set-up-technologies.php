<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$db = new PDO('mysql:host=localhost;dbname=esigalactic;charset=utf8', 'root', '');


function checkIfExists($db, $table, $column, $value) {
    $query = "SELECT * FROM $table WHERE $column = :value";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function insertTechnologyArchetype($db, $name, $researchTime, $deuteriumCost, $metalCost) {
    $query = "INSERT INTO technology_archetype (id, name, research_time, deuterium_cost, metal_cost) VALUES (NULL, :name, :researchTime, :deuteriumCost, :metalCost)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':researchTime', $researchTime);
    $stmt->bindValue(':deuteriumCost', $deuteriumCost);
    $stmt->bindValue(':metalCost', $metalCost);
    $stmt->execute();
}


$query = $db->query("SELECT COUNT(*) FROM technology_archetype");
$rowCount = $query->fetchColumn();

if ($rowCount == 0) {
    insertTechnologyArchetype($db, "Energy", 4, 100, 0);
    insertTechnologyArchetype($db, "Laser", 2, 300, 0);
    insertTechnologyArchetype($db, "Ion", 8, 500, 0);
    insertTechnologyArchetype($db, "Shield", 5, 1000, 0);
    insertTechnologyArchetype($db, "Weaponry", 6, 500, 200);
    echo "Technologies set up successfully!";
}

