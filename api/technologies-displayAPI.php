<?php

/**
 * Represents the technology archetype.
 */
class TechnologyArchetype
{
    private $db;

    /**
     * Initializes the technology archetype with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetches all technology archetypes from the database.
     *
     * @return array The technology archetypes.
     */
    public function fetchTechnologyArchetypes()
    {
        $query = $this->db->prepare("SELECT * FROM technology_archetype");
        $query->execute();
        return $query->fetchAll();
    }
}

/**
 * Represents the technology.
 */
class Technology
{
    private $db;

    /**
     * Initializes the technology with a database connection.
     *
     * @param PDO $db The database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetches the technologies for a specific planet.
     *
     * @param int $planetId The planet ID.
     * @return array The technologies.
     */
    public function fetchTechnologies($planetId)
    {
        $query = $this->db->prepare("SELECT * FROM technology WHERE planet_id = :planet_id");
        $query->bindParam(':planet_id', $planetId);
        $query->execute();
        return $query->fetchAll();
    }
}

session_start();
$planetId = $_SESSION["planet-choice"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");

$technologyArchetype = new TechnologyArchetype($db);
$technology = new Technology($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($planetId)) {
        $archetypes = $technologyArchetype->fetchTechnologyArchetypes();
        $technologies = $technology->fetchTechnologies($planetId);

        $data = array(
            "technology_archetype" => $archetypes,
            "technology" => $technologies
        );
        $jsonData = json_encode($data);

        echo $jsonData;
    } else {
        echo "Planet ID parameter is missing.";
    }
} else {
    echo "Invalid request method.";
}
