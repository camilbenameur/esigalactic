<?php

class Infrastructure
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");
    }

    public function getInfrastructureData($archetypeId)
    {
        $infrastructure = $this->fetchInfrastructure($archetypeId);
        $infrastructureArchetype = $this->fetchInfrastructureArchetype($archetypeId);
        $facilityArchetype = null;
        $resourceArchetype = null;
        $defenceArchetype = null;

        if (!empty($infrastructureArchetype)) {
            $infrastructureArchetype = $infrastructureArchetype[0];

            if (isset($infrastructureArchetype["defence_id"])) {
                $defenceArchetype = $this->fetchDefenceArchetype($infrastructureArchetype["defence_id"]);
            } elseif (isset($infrastructureArchetype["facility_id"])) {
                $facilityArchetype = $this->fetchFacilityArchetype($infrastructureArchetype["facility_id"]);
            } elseif (isset($infrastructureArchetype["resource_id"])) {
                $resourceArchetype = $this->fetchResourceArchetype($infrastructureArchetype["resource_id"]);
            }
        }

        return [
            "infrastructure" => $infrastructure,
            "infrastructureArchetype" => [
                "archetype" => $infrastructureArchetype,
                "facility" => $facilityArchetype,
                "resource" => $resourceArchetype,
                "defence" => $defenceArchetype,
            ],
        ];
    }

    private function fetchInfrastructure($archetypeId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure WHERE player_id = ? AND archetype_id = ?;");
        $query->execute([$_SESSION["player_id"], $archetypeId]);
        return $query->fetchAll();
    }

    private function fetchInfrastructureArchetype($archetypeId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure_archetype WHERE id = ?;");
        $query->execute([$archetypeId]);
        return $query->fetchAll();
    }

    private function fetchDefenceArchetype($defenceId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure_defence WHERE id = ?;");
        $query->execute([$defenceId]);
        return $query->fetchAll();
    }

    private function fetchFacilityArchetype($facilityId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure_facility WHERE id = ?;");
        $query->execute([$facilityId]);
        return $query->fetchAll();
    }

    private function fetchResourceArchetype($resourceId)
    {
        $query = $this->db->prepare("SELECT * FROM infrastructure_resource WHERE id = ?;");
        $query->execute([$resourceId]);
        return $query->fetchAll();
    }
}

session_start();

if (!isset($_SESSION["connected"]) || $_SESSION["connected"] !== true) {
    header("Location: login.php");
    exit;
}

$archetypeId = $_GET["archetype-choice"];

$infrastructure = new Infrastructure();
$data = $infrastructure->getInfrastructureData($archetypeId);

echo json_encode($data);
?>
