<?php
$_SESSION["galaxy-choice"] = $_GET["galaxy-choice"];
$_SESSION["solar-system-choice"] = $_GET["solar-system-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare(" SELECT p.*
FROM planet p
JOIN solar_system ss ON p.solar_system_id = ss.id
WHERE ss.id = ? AND ss.galaxy_id = ?;

");
$query->execute([$_SESSION["solar-system-choice"] ,$_SESSION["galaxy-choice"]]);
$rows = $query->fetchAll();
echo json_encode($rows);

?>