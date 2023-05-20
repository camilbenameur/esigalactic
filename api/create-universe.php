<?php

// Establish a database connection
$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

/**
 * Creates a planet with the specified parameters.
 *
 * @param int $solarSystemId The ID of the solar system where the planet belongs.
 * @param string $planetName The name of the planet.
 * @param int $position The position of the planet.
 * @param PDO|null $PDO The PDO object for database connection (optional).
 */
function createPlanet($solarSystemId, $planetName, $position, PDO $PDO = null)
{
    // Use the provided PDO object or the global database connection
    $PDO = $PDO ?? $GLOBALS['db'];

    $size = ($position <= 5) ? (80 + ($position * 10)) : (130 - (($position - 5) * 10));

    $query = $PDO->prepare("SELECT id FROM planet WHERE solar_system_id = ? AND position = ?;");
    $query->execute([$solarSystemId, $position]);
    $rows = $query->fetchAll();

    if (count($rows) > 0) {
        // If the planet already exists, recursively call createPlanet() again
        createPlanet($solarSystemId, $planetName, $PDO);
    } else {
        // Insert the new planet into the database
        $query = $PDO->prepare("INSERT INTO planet (id, name, position, size, solar_system_id) VALUES (NULL, ?, ?, ?, ?);");
        if ($query->execute([$planetName, $position, $size, $solarSystemId])) {
            echo "Planet created successfully.";
        } else {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    }
}

/**
 * Creates a solar system with the specified parameters.
 *
 * @param int $galaxyId The ID of the galaxy where the solar system belongs.
 * @param string $solarSystemName The name of the solar system.
 * @param PDO|null $PDO The PDO object for database connection (optional).
 */
function createSolarSystems($galaxyId, $solarSystemName, PDO $PDO = null)
{
    // Use the provided PDO object or the global database connection
    $PDO = $PDO ?? $GLOBALS['db'];

    // Check the number of existing solar systems in the given galaxy
    $query = $PDO->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
    $query->execute([$galaxyId]);
    $rows = $query->fetchAll();

    if (count($rows) < 10) {
        // Insert the new solar system into the database
        $query = $PDO->prepare("INSERT INTO solar_system (id, galaxy_id, name) VALUES (NULL, ?, ?);");
        $query->execute([$galaxyId, $solarSystemName]);
    } else {
        echo "Solar system limit reached";
    }
}

/**
 * Creates a galaxy with the specified parameters.
 *
 * @param int $universeId The ID of the universe where the galaxy belongs.
 * @param string $galaxyName The name of the galaxy.
 * @param PDO|null $PDO The PDO object for database connection (optional).
 */
function createGalaxies($universeId, $galaxyName, PDO $PDO = null)
{
    // Use the provided PDO object or the global database connection
    $PDO = $PDO ?? $GLOBALS['db'];

    // Check the number of existing galaxies in the given universe
    $query = $PDO->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
    $query->execute([$universeId]);
    $rows = $query->fetchAll();

    if (count($rows) < 5) {
        // Insert the new galaxy into the database
        $query = $PDO->prepare("INSERT INTO galaxy (id, universe_id, name) VALUES (NULL, ?, ?);");
        if ($query->execute([$universeId, $galaxyName])) {
            echo "Galaxy created successfully.";
        } else {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    } else {
        echo "Galaxy limit reached";
    }
}

/**
 * Creates an universe with the specified name.
 *
 * @param string $universeName The name of the universe.
 * @param PDO|null $PDO The PDO object for database connection (optional).
 */
function createUniverse($universeName, PDO $PDO = null)
{
    // Use the provided PDO object or the global database connection
    $PDO = $PDO ?? $GLOBALS['db'];

    // Check if the universe already exists
    $query = $PDO->prepare("SELECT id FROM universe WHERE name = ?;");
    $query->execute([$universeName]);
    $rows = $query->fetchAll();

    if (count($rows) > 0) {
        echo "Universe already exists";
    } else {
        // Insert the new universe into the database
        $query = $PDO->prepare("INSERT INTO universe (id, name) VALUES (NULL, ?);");
        if ($query->execute([$universeName])) {
            echo "Universe created successfully.";
        } else {
            $error = $query->errorInfo();
            echo "Error: " . $error[2];
        }
    }
}

// Check if the universeName is provided via POST request
if (isset($_POST['universeName'])) {
    $universeName = $_POST['universeName'];
    createUniverse($universeName);
}

// Get the ID of the created universe
$query = $db->prepare("SELECT id FROM universe WHERE name = ?;");
$query->execute([$universeName]);
$rows = $query->fetchAll();
$universeId = $rows[0]['id'];

// Create galaxies in the universe
for ($i = 1; $i <= 5; $i++) {
    createGalaxies($universeId, "Galaxy " . $i, $db);
}

// Get the galaxies in the universe
$query = $db->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
$query->execute([$universeId]);
$rows = $query->fetchAll();

// Create solar systems in each galaxy
foreach ($rows as $row) {
    $galaxyId = $row['id'];
    for ($i = 1; $i <= 10; $i++) {
        createSolarSystems($galaxyId, "Solar System " . $i, $db);
    }

    // Get the solar systems in the galaxy
    $query = $db->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
    $query->execute([$galaxyId]);
    $rows = $query->fetchAll();

    // Create planets in each solar system
    foreach ($rows as $row) {
        $solarSystemId = $row['id'];
        $planetCount = rand(4, 10);

        // Get the existing planets in the solar system
        $query = $db->prepare("SELECT id, position FROM planet WHERE solar_system_id = ?;");
        $query->execute([$solarSystemId]);
        $rows = $query->fetchAll();

        // Generate a random list of positions for the new planets
        $liste = range(1, 10);
        $taille = rand(1, 10);
        shuffle($liste);
        $liste = array_slice($liste, 0, $taille);
        sort($liste);
        $loopCount = 0;

        // Create planets with the generated positions
        foreach ($liste as $position) {
            $loopCount = $loopCount + 1;
            createPlanet($solarSystemId, "Planet " . $loopCount, $position, $db);
        }
    }
}

?>
