<?php
$_SESSION["galaxy-choice"] = $_GET["galaxy-choice"];
$_SESSION["solar-system-choice"]  = ($_GET["galaxy-choice"] - 1) * 10 + $_GET["solar-system-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT planet.*
FROM planet
JOIN solar_system ON planet.solar_system_id = solar_system.id
JOIN galaxy ON solar_system.galaxy_id = galaxy.id
WHERE galaxy.id = :galaxy_id AND solar_system.id = :solar_system_id;");
$query->execute([
    "galaxy_id" => $_SESSION["galaxy-choice"],
    "solar_system_id" => ($_GET["galaxy-choice"] - 1) * 10 + $_GET["solar-system-choice"],
]);
$rows = $query->fetchAll();
echo json_encode($rows);

?>