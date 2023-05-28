<?php

session_start();
$planetId = $_SESSION["planet-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($planetId)) {

        $archetypeQuery = $db->prepare("SELECT * FROM technology_archetype");
        $archetypeQuery->execute();
        $archetypes = $archetypeQuery->fetchAll();

        $technologyQuery = $db->prepare("SELECT * FROM technology WHERE planet_id = :planet_id");
        $technologyQuery->bindParam(':planet_id', $planetId);
        $technologyQuery->execute();
        $technologies = $technologyQuery->fetchAll();

        $data = array(
            "technology_archetype" => $archetypes,
            "technology" => $technologies
        );
        $jsonData = json_encode($data);

        echo $jsonData;
    } else {
        echo "Planet ID parameter is missing.";
    }
} else {
    echo "Invalid request method.";
}

?>
