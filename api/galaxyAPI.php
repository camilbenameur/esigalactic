<?php

require_once 'process-login.php';

class GalacticDatabase
{
    private $db;
    private $sessionManager;

    /**
     * GalacticDatabase constructor.
     * Initializes the Database and SessionManager objects.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->sessionManager = new SessionManager();
    }

    /**
     * Retrieves planet information based on the selected galaxy and solar system.
     *
     * @param int $galaxyChoice        The selected galaxy choice.
     * @param int $solarSystemChoice   The selected solar system choice.
     * @return array                   The result of the query as an array.
     */
    public function getPlanetInformation($galaxyChoice, $solarSystemChoice)
    {
        $galaxyId = $galaxyChoice;
        $solarSystemId = ($galaxyChoice - 1) * 10 + $solarSystemChoice;

        $query = "SELECT planet.*
        FROM planet
        JOIN solar_system ON planet.solar_system_id = solar_system.id
        JOIN galaxy ON solar_system.galaxy_id = galaxy.id
        WHERE galaxy.id = :galaxy_id AND solar_system.id = :solar_system_id;";

        $params = [
            "galaxy_id" => $galaxyId,
            "solar_system_id" => $solarSystemId,
        ];

        return $this->db->executeQuery($query, $params);
    }
}

$galacticDatabase = new GalacticDatabase();

if (isset($_GET['galaxy-choice']) && isset($_GET['solar-system-choice'])) {
    $planetInformation = $galacticDatabase->getPlanetInformation($_GET['galaxy-choice'], $_GET['solar-system-choice']);
} else {
    $planetInformation = [];
}

echo json_encode($planetInformation);
