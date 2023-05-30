<?php

session_start();

$archetypeId = $_GET["archetype-choice"];
$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];
$playerId = $_SESSION["player_id"];

$infrastructureLevel = $_GET["infrastructure-level"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
$query = $db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
$query->execute([$playerId, $universeId]);
$wallet = $query->fetchAll();

$metal = $wallet[0]["metal"];
$deuterium = $wallet[0]["deuterium"];
$energy = $wallet[0]["energy"];

$query = $db->prepare("SELECT * FROM infrastructure_archetype WHERE id = ?;");
$query->execute([$archetypeId]);
$archetype = $query->fetchAll();

$infrastructureName = $archetype[0]["name"];

$metal_cost = $archetype[0]["metal_cost"];
$deuterium_cost = $archetype[0]["deuterium_cost"];
$energy_cost = $archetype[0]["energy_cost"];

$query = $db->prepare("SELECT * FROM technology WHERE planet_id = ?;");
$query->execute([$planetId]);
$technologies = $query->fetchAll();

$energyTechnology = null;
$laserTechnology = null;
$ionTechnology = null;
$shieldTechnology = null;
$weaponryTechnology = null;

foreach($technologies as $technology){
    if($technology["archetype_id"] ==1){
        $energyTechnology = $technology;
    }else if($technology["archetype_id"] ==2){
        $laserTechnology = $technology;
    }else if($technology["archetype_id"] ==3){
        $ionTechnology = $technology;
    }else if($technology["archetype_id"] ==4){
        $shieldTechnology = $technology;
    }else if($technology["archetype_id"] ==5){
        $weaponryTechnology = $technology;
    }
}

if($infrastructureName == "Research lab" || $infrastructureName == "Shipyard" || $infrastructureName == "Nanite factory" || $infrastructureName == "Metal mine" || $infrastructureName == "Deuterium synthesizer" || $infrastructureName == "Solar plant" || $infrastructureName == "Fusion plant" || $infrastructureName == "Laser artillery" && $laserTechnology != null || $infrastructureName == "Ion cannon" && $ionTechnology != null || $infrastructureName == "Shield" && $shieldTechnology != null){
    if($infrastructureLevel == 0) {
            if ($metal >= $metal_cost && $deuterium >= $deuterium_cost && $energy >= $energy_cost) {
                $metal = $metal - $metal_cost;
                $deuterium = $deuterium - $deuterium_cost;
                $energy = $energy - $energy_cost;

                $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ? AND universe_id = ?;");
                $query->execute([$metal, $deuterium, $energy, $playerId, $universeId]);

                $query = $db->prepare("INSERT INTO infrastructure (planet_id, archetype_id, level) VALUES (?, ?, ?);");
                $query->execute([$planetId, $archetypeId, 1]);

                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        } else {
            $metal_cost *= pow(1.6, $infrastructureLevel);
            $deuterium_cost *= pow(1.6, $infrastructureLevel);
            $energy_cost *= pow(1.6, $infrastructureLevel);

            if ($metal >= $metal_cost && $deuterium >= $deuterium_cost && $energy >= $energy_cost) {
                $metal = $metal - $metal_cost;
                $deuterium = $deuterium - $deuterium_cost;
                $energy = $energy - $energy_cost;
                $infrastructureLevel++;

                $query = $db->prepare("UPDATE wallet SET metal = ?, deuterium = ?, energy = ? WHERE player_id = ? AND universe_id = ?;");
                $query->execute([$metal, $deuterium, $energy, $playerId, $universeId]);
                
                $query = $db->prepare("UPDATE infrastructure SET level = ? WHERE planet_id = ? AND archetype_id = ?;");
                $query->execute([$infrastructureLevel, $planetId, $archetypeId]);

                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
} else {
    echo json_encode(["success" => false]);
}