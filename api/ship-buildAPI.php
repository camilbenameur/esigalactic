<?php

/**
 * Represents a ship builder.
 */
class ShipBuilder
{
    private $db;

    /**
     * Initializes the ship builder with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Builds a ship based on the archetype ID.
     *
     * @param int $planetId The planet ID.
     * @param int $archetypeId The archetype ID of the ship.
     * @param int $metalCost The metal cost of the ship.
     * @param int $deuteriumCost The deuterium cost of the ship.
     * @param int $playerId The player ID.
     * @param int $universeId The universe ID.
     */
    public function buildShip($planetId, $archetypeId, $metalCost, $deuteriumCost, $playerId, $universeId)
    {
        $wallet = $this->fetchWallet($playerId, $universeId);
        $metal = $wallet[0]["metal"];
        $deuterium = $wallet[0]["deuterium"];

        $shipyard = $this->fetchShipyard($planetId, 2);

        $ship = $this->fetchShip($planetId, $archetypeId);

        if ($shipyard) {
            if (!$ship && $metal >= $metalCost && $deuterium >= $deuteriumCost) {
                $metal -= $metalCost;
                $deuterium -= $deuteriumCost;
                $this->insertShip($planetId, $archetypeId, 1);
                echo "Ship built!";
            } else if ($ship && $metal >= $metalCost && $deuterium >= $deuteriumCost) {
                $metal -= $metalCost;
                $deuterium -= $deuteriumCost;
                $this->updateShipAmount($ship[0]["amount"] + 1, $planetId, $archetypeId);
                echo "Ship built!";
            }
            $this->updateWallet($metal, $deuterium, $playerId, $universeId);
        }
    }

    /**
     * Fetches the wallet for the player in the specified universe.
     *
     * @param int $playerId The player ID.
     * @param int $universeId The universe ID.
     * @return array The wallet information.
     */
    private function fetchWallet($playerId, $universeId)
    {
        $query = $this->db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$playerId, $universeId]);
        return $query->fetchAll();
    }

    /**
     * Fetches the shipyard for the specified planet and archetype.
     *
     * @param int $planetId The planet ID.
     * @param int $archetypeId The archetype ID.
     * @return array The shipyard information.
     */
    private function fetchShipyard($planetId, $archetypeId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$planetId, $archetypeId]);
        return $query->fetchAll();
    }

    /**
     * Fetches the ship with the specified planet and archetype.
     *
     * @param int $planetId The planet ID.
     * @param int $archetypeId The archetype ID.
     * @return array The ship information.
     */
    private function fetchShip($planetId, $archetypeId)
    {
        $query = $this->db->prepare("SELECT * FROM ship WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$planetId, $archetypeId]);
        return $query->fetchAll();
    }

    /**
     * Inserts a new ship into the database.
     *
     * @param int $planetId The planet ID.
     * @param int $archetypeId The archetype ID.
     * @param int $amount The amount of ships.
     */
    private function insertShip($planetId, $archetypeId, $amount)
    {
        $query = $this->db->prepare("INSERT INTO ship (planet_id, archetype_id, amount) VALUES (?, ?, ?);");
        $query->execute([$planetId, $archetypeId, $amount]);
    }

    /**
     * Updates the amount of ships for the specified planet and archetype.
     *
     * @param int $amount The new amount of ships.
     * @param int $planetId The planet ID.
     * @param int $archetypeId The archetype ID.
     */
    private function updateShipAmount($amount, $planetId, $archetypeId)
    {
        $query = $this->db->prepare("UPDATE ship SET amount = ? WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$amount, $planetId, $archetypeId]);
    }

    /**
     * Updates the wallet of the player in the specified universe.
     *
     * @param int $metal The new metal value.
     * @param int $deuterium The new deuterium value.
     * @param int $playerId The player ID.
     * @param int $universeId The universe ID.
     */
    private function updateWallet($metal, $deuterium, $playerId, $universeId)
    {
        $query = $this->db->prepare("UPDATE wallet SET metal = ?, deuterium = ? WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$metal, $deuterium, $playerId, $universeId]);
    }
}


session_start();

$archetypeId = $_GET["archetype-choice"];

$playerId = $_SESSION["player_id"];
$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

$shipBuilder = new ShipBuilder($db);
$shipBuilder->buildShip($planetId, $archetypeId, 2, 4, $playerId, $universeId);
