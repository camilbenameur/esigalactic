<?php

class GalacticCreator
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");
    }

    public function createPlanet($solarSystemId, $planetName, $position)
    {
        $size = ($position <= 5) ? (80 + ($position * 10)) : (130 - (($position - 5) * 10));

        $query = $this->db->prepare("SELECT id FROM planet WHERE solar_system_id = ? AND position = ?;");
        $query->execute([$solarSystemId, $position]);
        $rows = $query->fetchAll();

        if (count($rows) > 0) {
            $this->createPlanet($solarSystemId, $planetName, $position);
        } else {
            $query = $this->db->prepare("INSERT INTO planet (id, name, position, size, solar_system_id) VALUES (NULL, ?, ?, ?, ?);");
            if ($query->execute([$planetName, $position, $size, $solarSystemId])) {
                echo "Planet created successfully.";
            } else {
                $error = $query->errorInfo();
                echo "Error: " . $error[2];
            }
        }
    }

    public function createSolarSystem($galaxyId, $solarSystemName)
    {
        $query = $this->db->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
        $query->execute([$galaxyId]);
        $rows = $query->fetchAll();

        if (count($rows) < 10) {
            $query = $this->db->prepare("INSERT INTO solar_system (id, galaxy_id, name) VALUES (NULL, ?, ?);");
            $query->execute([$galaxyId, $solarSystemName]);
        } else {
            echo "Solar system limit reached";
        }
    }

    public function createGalaxy($universeId, $galaxyName)
    {
        $query = $this->db->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
        $query->execute([$universeId]);
        $rows = $query->fetchAll();

        if (count($rows) < 5) {
            $query = $this->db->prepare("INSERT INTO galaxy (id, universe_id, name) VALUES (NULL, ?, ?);");
            if ($query->execute([$universeId, $galaxyName])) {
                echo "Galaxy created successfully.";
            } else {
                $error = $query->errorInfo();
                echo "Error: " . $error[2];
            }
        } else {
            echo "Galaxy limit reached";
        }
    }

    public function createUniverse($universeName)
    {
        $query = $this->db->prepare("SELECT id FROM universe WHERE name = ?;");
        $query->execute([$universeName]);
        $rows = $query->fetchAll();

        if (count($rows) > 0) {
            echo "Universe already exists";
        } else {
            $query = $this->db->prepare("INSERT INTO universe (id, name) VALUES (NULL, ?);");
            if ($query->execute([$universeName])) {
                echo "Universe created successfully.";
            } else {
                $error = $query->errorInfo();
                echo "Error: " . $error[2];
            }
        }
    }

    public function createGalaxiesAndSolarSystems()
    {
        if (isset($_POST['universeName'])) {
            $universeName = $_POST['universeName'];
            $this->createUniverse($universeName);
        }

        $query = $this->db->prepare("SELECT id FROM universe WHERE name = ?;");
        $query->execute([$universeName]);
        $rows = $query->fetchAll();
        $universeId = $rows[0]['id'];

        for ($i = 1; $i <= 5; $i++) {
            $this->createGalaxy($universeId, "Galaxy " . $i);
        }

        $query = $this->db->prepare("SELECT id FROM galaxy WHERE universe_id = ?;");
        $query->execute([$universeId]);
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $galaxyId = $row['id'];
            for ($i = 1; $i <= 10; $i++) {
                $this->createSolarSystem($galaxyId, "Solar System " . $i);
            }

            $query = $this->db->prepare("SELECT id FROM solar_system WHERE galaxy_id = ?;");
            $query->execute([$galaxyId]);
            $rows = $query->fetchAll();

            foreach ($rows as $row) {
                $solarSystemId = $row['id'];

                $query = $this->db->prepare("SELECT id, position FROM planet WHERE solar_system_id = ?;");
                $query->execute([$solarSystemId]);
                $rows = $query->fetchAll();

                $liste = range(1, 10);
                $taille = rand(4, 10);
                shuffle($liste);
                $liste = array_slice($liste, 0, $taille);
                sort($liste);
                $loopCount = 0;

                foreach ($liste as $position) {
                    $loopCount = $loopCount + 1;
                    $this->createPlanet($solarSystemId, "Planet " . $loopCount, $position);
                }
            }
        }
    }
}

$galacticCreator = new GalacticCreator();
$galacticCreator->createGalaxiesAndSolarSystems();

?>
