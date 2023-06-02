<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

class PlanetStatAPI {
    private $db;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getPlanetChoiceId()
    {
        $query = $this->db->prepare("SELECT id FROM planet WHERE id = ?;");
        $query->execute([$_SESSION["planet-choice"]]);
        $planetChoiceId = $query->fetchAll();

        return $planetChoiceId;
    }

    public function getPlanetAttackPoints($planetChoice)
    {
        $planetID = $planetChoice;

        $query = $this->db->prepare("SELECT
            planet.id AS planet_id,
            planet.name AS planet_name,
            SUM(ship.amount * ship_archetype.offence_value) AS ship_offensive_value,
            SUM(infrastructure.level * infrastructure_defence.offence_value) AS infrastructure_offensive_value,
            SUM(ship.amount * ship_archetype.offence_value) + SUM(infrastructure.level * infrastructure_defence.offence_value) AS total_offensive_value
        FROM
            planet
            LEFT JOIN ship ON ship.planet_id = planet.id
            LEFT JOIN ship_archetype ON ship.archetype_id = ship_archetype.id
            LEFT JOIN infrastructure ON infrastructure.planet_id = planet.id
            LEFT JOIN infrastructure_archetype ON infrastructure.archetype_id = infrastructure_archetype.id
            LEFT JOIN infrastructure_defence ON infrastructure_archetype.defence_id = infrastructure_defence.id
        WHERE
            planet.id = ?
        GROUP BY
            planet.id;");
        $query->execute([$planetID]);

        return $query->fetchAll();
    }

    public function getPlanetDefencePoints($planetChoice) 
    {
        $query = $this->db->prepare("SELECT
        planet.id AS planet_id,
        planet.name AS planet_name,
        SUM(ship.amount * ship_archetype.defence_value) AS ship_defensive_value,
        SUM(infrastructure_defence.defence_value) AS infrastructure_defensive_value,
        SUM(ship.amount * ship_archetype.defence_value) + SUM(infrastructure.level * infrastructure_defence.defence_value) AS total_defensive_value
        FROM
            planet
            LEFT JOIN ship ON ship.planet_id = planet.id
            LEFT JOIN ship_archetype ON ship.archetype_id = ship_archetype.id
            LEFT JOIN infrastructure ON infrastructure.planet_id = planet.id
            LEFT JOIN infrastructure_archetype ON infrastructure.archetype_id = infrastructure_archetype.id
            LEFT JOIN infrastructure_defence ON infrastructure_archetype.defence_id = infrastructure_defence.id
        WHERE
            planet.id = ?
        GROUP BY
            planet.id;
        ");
        $query->execute([$planetChoice]);

        return $query->fetchAll();
    }

}

$myAPI = new PlanetStatAPI("localhost", "esigalactic", "root", "");

$planetChoice = $myAPI->getPlanetChoiceId();
$planetChoiceId = $planetChoice[0]["id"];
$planetAttackPoints = $myAPI->getPlanetAttackPoints($planetChoiceId);
$planetDefencePoints = $myAPI->getPlanetDefencePoints($planetChoiceId);

$data = array(
    "planetChoice" => $planetChoice,
    "planetAttackPoints" => $planetAttackPoints,
    "planetDefencePoints" => $planetDefencePoints
);

echo json_encode($data);