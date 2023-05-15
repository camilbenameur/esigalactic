<?php
$_SESSION["galaxy-choice"] = $_GET["galaxy-choice"];
$_SESSION["solar-system-choice"] = $_GET["solar-system-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM planet WHERE ? = solar_system_id;");
$query->execute([$_SESSION["solar-system-choice"]]);
$rows = $query->fetchAll();

echo json_encode($rows);

?>