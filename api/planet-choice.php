<?php

session_start();

if(isset($_GET["planet-choice"]))
{
    $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

    $query = $db->prepare("SELECT * FROM planet WHERE id = :planet_id AND player_id = :player_id");
    $query->bindParam(':planet_id', $_GET["planet-choice"]);
    $query->bindParam(':player_id', $_SESSION["player_id"]);
    $query->execute();
    $planet = $query->fetchAll();

    if(count($planet) != 0)
    {
        $_SESSION["planet-choice"] = $_GET["planet-choice"];
        echo json_encode(array("success" => true));
    }
    else
    {
        echo json_encode(array("success" => false));
    }
}