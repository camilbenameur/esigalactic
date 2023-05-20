<?php 

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("UPDATE wallet SET deuterium = :deuterium, metal = :metal, energy = :energy WHERE player_id = :player_id;");
$query->execute([
    "deuterium" => $_SESSION["deuterium"],
    "metal" => $_SESSION["metal"],
    "energy" => $_SESSION["energy"],
    "player_id" => $_SESSION["player_id"],
]);

session_destroy();
header("Location:../front/login.php");

?>