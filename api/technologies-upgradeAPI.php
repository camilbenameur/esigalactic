<?php

/**
 * Represents the technology operations.
 */
class TechnologyManager
{
    private $db;

    /**
     * Initializes the technology manager with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Upgrades the specified technology on the planet.
     *
     * @param string $technologyName The name of the technology.
     * @param int $technologyLevel The current level of the technology.
     * @param int $planetId The planet ID.
     * @param int $universeId The universe ID.
     * @param int $playerId The player ID.
     * @return string The result of the upgrade operation.
     */
    public function upgradeTechnology($technologyName, $technologyLevel, $planetId, $universeId, $playerId)
    {
        $query = $this->db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$playerId, $universeId]);
        $wallet = $query->fetchAll();

        $metal = $wallet[0]["metal"];
        $deuterium = $wallet[0]["deuterium"];

        $query = $this->db->prepare("SELECT * FROM technology_archetype WHERE name = ?;");
        $query->execute([$technologyName]);
        $archetype = $query->fetchAll();

        $metal_cost = $archetype[0]["metal_cost"];
        $deuterium_cost = $archetype[0]["deuterium_cost"];

        $metal_cost *= pow(1.5, $technologyLevel);
        $deuterium_cost *= pow(1.5, $technologyLevel);

        $query = $this->db->prepare("SELECT id FROM infrastructure WHERE planet_id = ? AND archetype_id = ?;");
        $query->execute([$planetId, 1]);
        $researchLab = $query->fetchAll();

        $query = $this->db->prepare("SELECT * FROM technology WHERE planet_id = ?;");
        $query->execute([$planetId]);
        $technologies = $query->fetchAll();

        $energyTechnology = null;
        $laserTechnology = null;
        $ionTechnology = null;
        $shieldTechnology = null;
        $weaponryTechnology = null;

        foreach ($technologies as $technology) {
            if ($technology["archetype_id"] == 1) {
                $energyTechnology = $technology;
            } else if ($technology["archetype_id"] == 2) {
                $laserTechnology = $technology;
            } else if ($technology["archetype_id"] == 3) {
                $ionTechnology = $technology;
            } else if ($technology["archetype_id"] == 4) {
                $shieldTechnology = $technology;
            } else if ($technology["archetype_id"] == 5) {
                $weaponryTechnology = $technology;
            }
        }

        if ($researchLab != null && $metal >= $metal_cost && $deuterium >= $deuterium_cost) {
            if (
                $technologyName == "energy" ||
                $technologyName == "weaponry" ||
                ($technologyName == "shield" && ($energyTechnology["level"] >= 8 || $ionTechnology["level"] >= 2)) ||
                ($technologyName == "ion" && $laserTechnology["level"] >= 5) ||
                ($technologyName == "laser" && $energyTechnology["level"] >= 5)
            ) {
                $metal -= $metal_cost;
                $deuterium -= $deuterium_cost;
                $query = $this->db->prepare("UPDATE wallet SET metal = ?, deuterium = ? WHERE player_id = ? AND universe_id = ?;");
                $query->execute([$metal, $deuterium, $playerId, $universeId]);

                $query = $this->db->prepare("SELECT * FROM technology WHERE planet_id = ? AND archetype_id = ?;");
                $query->execute([$planetId, $archetype[0]["id"]]);
                $technology = $query->fetchAll();

                if ($technology == null) {
                    $query = $this->db->prepare("INSERT INTO technology (planet_id, archetype_id, level) VALUES (?, ?, ?);");
                    $query->execute([$planetId, $archetype[0]["id"], 1]);
                } else {
                    $query = $this->db->prepare("UPDATE technology SET level = ? WHERE planet_id = ? AND archetype_id = ?;");
                    $query->execute([$technologyLevel + 1, $planetId, $archetype[0]["id"]]);
                }
                return "success";
            }
        }
        return "error";
    }
}

session_start();
$technologyName = $_GET["technology"];
$technologyLevel = $_GET["level"];
$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];
$playerId = $_SESSION["player_id"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

$technologyManager = new TechnologyManager($db);
$result = $technologyManager->upgradeTechnology($technologyName, $technologyLevel, $planetId, $universeId, $playerId);

echo json_encode($result);
