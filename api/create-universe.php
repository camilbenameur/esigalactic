<?php

$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

function createPlanet($solarSystemId, $planetName, PDO $PDO = null)
{
    if (!$PDO) {
        global $db;
        $PDO = $db;
    }

    $position = rand(1, 10);
    $size = rand(1, 10);

    $query = $PDO->prepare("SELECT id FROM planet WHERE solar_system_id = ? AND position = ?;");
    $query->execute([$solarSystemId, $position]);
    $rows = $query->fetchAll();

    if (count($rows) > 0) {
        createPlanet($solarSystemId, $planetName, $PDO);
    } else {
        $query = $PDO->prepare("INSERT INTO planet (id, name, position, size, solar_system_id) VALUES (NULL, ?, ?, ?, ?);");
        if ($query->execute([$planetName, $position, $size, $solarSystemId])) {
            echo "Planet created successfully.";
        } else {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    }
}

function createSolarSystems($galaxyId, $solarSystemName, PDO $PDO = null)
{
    if (!$PDO) {
        global $db;
        $PDO = $db;
    }

    $query = $PDO->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
    $query->execute([$galaxyId]);
    $rows = $query->fetchAll();

    if (count($rows) < 10) {
        $query = $PDO->prepare("INSERT INTO solar_system (id, galaxy_id, name) VALUES (NULL, ?, ?);");
        $query->execute([$galaxyId, $solarSystemName]);
    } else {
        echo "Solar system limit reached";
    }
}

function createGalaxies($universeId, PDO $PDO = null)
{
    if (!$PDO) {
        global $db;
        $PDO = $db;
    }

    $query = $PDO->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
    $query->execute([$universeId]);
    $rows = $query->fetchAll();

    if (count($rows) < 5) {
        $query = $PDO->prepare("INSERT INTO galaxy (id, universe_id) VALUES (NULL, ?);");
        if ($query->execute([$universeId])) {
            echo "Galaxy created successfully.";
        } else {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    } 
    else {
        echo "Galaxy limit reached";
    }
}

function createUniverse($universeName, PDO $PDO = null)
{
    if (!$PDO) {
        global $db;
        $PDO = $db;
    }

    $query = $PDO->prepare("SELECT id FROM universe WHERE name = ?;");
    $query->execute([$universeName]);
    $rows = $query->fetchAll();

    if (count($rows) > 0) {
        echo "Universe already exists";
    } 
    else 
    {
        $query = $PDO->prepare("INSERT INTO universe (id, name) VALUES (NULL, ?);");
        if ($query->execute([$universeName])) 
        {
            echo "Universe created successfully.";
        } 
        else 
        {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    }
}

if (isset($_POST['universeName'])) 
{
    $universeName = $_POST['universeName'];
    createUniverse($universeName);
}

$query = $db->prepare("SELECT id FROM universe WHERE name = ?;");
$query->execute([$universeName]);
$rows = $query->fetchAll();
$universeId = $rows[0]['id'];

for ($i = 1; $i <= 5; $i++) {
    createGalaxies($universeId, $db);
}

$query = $db->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
$query->execute([$universeId]);
$rows = $query->fetchAll();

foreach ($rows as $row) {
    $galaxyId = $row['id'];
    for ($i = 1; $i <= 10; $i++) {
        createSolarSystems($galaxyId, "Solar System " . $i, $db);
    }
}

$query = $db->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
$query->execute([$galaxyId]);
$rows = $query->fetchAll();

foreach ($rows as $row) {
    $solarSystemId = $row['id'];
    $planetCount = rand(4, 10);
    for ($i = 1; $i <= $planetCount; $i++) {
        createPlanet($solarSystemId, "Planet " . $i, $db);
    }
}

?>
```