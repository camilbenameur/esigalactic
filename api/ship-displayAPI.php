<?php

/**
 * Represents a ship archetype.
 */
class ShipArchetype
{
    private $db;

    /**
     * Initializes ship archetype with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Inserts a new ship archetype into the database.
     *
     * @param string $name The name of the ship archetype.
     * @param int $buildingTime The building time of the ship archetype.
     * @param int $metalBuildingCost The metal building cost of the ship archetype.
     * @param int $deuteriumBuildingCost The deuterium building cost of the ship archetype.
     * @param int $defenceValue The defence value of the ship archetype.
     * @param int $offenceValue The offence value of the ship archetype.
     * @param int $fretValue The fret value of the ship archetype.
     */
    public function insertShipArchetype($name, $buildingTime, $metalBuildingCost, $deuteriumBuildingCost, $defenceValue, $offenceValue, $fretValue)
    {
        $query = $this->db->prepare("INSERT INTO ship_archetype (name, building_time, metal_building_cost, deuterium_building_cost, defence_value, offence_value, fret_value) VALUES (?, ?, ?, ?, ?, ?, ?);");
        $query->execute([$name, $buildingTime, $metalBuildingCost, $deuteriumBuildingCost, $defenceValue, $offenceValue, $fretValue]);
    }

    /**
     * Fetches all ship archetypes from the database.
     *
     * @return array The ship archetypes.
     */
    public function fetchShipArchetypes()
    {
        $query = $this->db->prepare("SELECT * FROM ship_archetype");
        $query->execute();
        return $query->fetchAll();
    }
}

/**
 * Represents a ship.
 */
class Ship
{
    private $db;

    /**
     * Initializes ship with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetches the ships belonging to a player in a specific universe.
     *
     * @param int $playerId The player ID.
     * @param int $universeId The universe ID.
     * @return array The ships.
     */
    public function fetchPlayerShips($playerId, $universeId)
    {
        $query = $this->db->prepare("SELECT s.id, s.planet_id, s.archetype_id, s.amount, p.player_id
            FROM ship AS s
            JOIN planet AS p ON s.planet_id = p.id
            JOIN solar_system AS ss ON p.solar_system_id = ss.id
            JOIN galaxy AS g ON ss.galaxy_id = g.id
            WHERE p.player_id = ? AND g.universe_id = ?;");
        $query->execute([$playerId, $universeId]);
        return $query->fetchAll();
    }
}

session_start();

$playerId = $_SESSION["player_id"];
$universeId = $_SESSION["universe-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

$shipArchetype = new ShipArchetype($db);
$ship = new Ship($db);

$shipArchetypes = $shipArchetype->fetchShipArchetypes();
if (empty($shipArchetypes)) {
    $shipArchetype->insertShipArchetype("fighter", 20, 3000, 500, 50, 75, 0);
    $shipArchetype->insertShipArchetype("cruiser", 120, 20000, 5000, 150, 400, 0);
    $shipArchetype->insertShipArchetype("carrier", 55, 6000, 1500, 50, 0, 100000);
    $shipArchetype->insertShipArchetype("colonization ship", 120, 10000, 10000, 50, 0, 0);
}

$ships = $ship->fetchPlayerShips($playerId, $universeId);

$data = [
    "ships" => $ships,
    "shipArchetypes" => $shipArchetypes
];

echo json_encode($data);

?>
