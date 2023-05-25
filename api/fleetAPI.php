<?php

/**
 * Class GalacticDatabase
 * Provides methods to retrieve planet information from the galactic database.
 */
class GalacticDatabase
{
    private $db;

    /**
     * GalacticDatabase constructor.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");
    }

    /**
     * Retrieves planet information based on the selected galaxy and solar system.
     *
     * @param int $galaxyChoice     The chosen galaxy.
     * @param int $solarSystemChoice The chosen solar system within the galaxy.
     * @return array                An array of planet information.
     */
    public function getPlanetInformation($galaxyChoice, $solarSystemChoice, $planetChoice)
    {
        $galaxyId = $galaxyChoice;
        $solarSystemId = ($galaxyChoice - 1) * 10 + $solarSystemChoice;
        $planetID = $planetChoice;

        $query = $this->db->prepare("SELECT planet.*
            FROM planet
            JOIN solar_system ON planet.solar_system_id = solar_system.id
            JOIN galaxy ON solar_system.galaxy_id = galaxy.id
            WHERE galaxy.id = :galaxy_id AND solar_system.id = :solar_system_id AND planet.id = :planet_id;");
        $query->execute([
            "galaxy_id" => $galaxyId,
            "solar_system_id" => $solarSystemId,
            "planet_id" => $planetID,
        ]);

        return $query->fetchAll();
    }
}

session_start();

$galacticDatabase = new GalacticDatabase();
$planetInformation = $galacticDatabase->getPlanetInformation($_GET["galaxy-choice"], $_GET["solar-system-choice"], $_GET["planet-choice"]);

echo json_encode($planetInformation);
?>