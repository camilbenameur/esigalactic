<?php

/**
 * Represents a database connection.
 */
class Database
{
    private $db;

    /**
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=esigalactic;charset=utf8', 'root', '');
    }

    /**
     * Checks if a value exists in a specific column of a table.
     *
     * @param string $table The table name.
     * @param string $column The column name.
     * @param mixed $value The value to check.
     * @return bool True if the value exists, false otherwise.
     */
    public function checkIfExists($table, $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column = :value";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    /**
     * Inserts a new technology archetype into the database.
     *
     * @param string $name The name of the technology archetype.
     * @param int $researchTime The research time of the technology archetype.
     * @param int $deuteriumCost The deuterium cost of the technology archetype.
     * @param int $metalCost The metal cost of the technology archetype.
     */
    public function insertTechnologyArchetype($name, $researchTime, $deuteriumCost, $metalCost)
    {
        $query = "INSERT INTO technology_archetype (id, name, research_time, deuterium_cost, metal_cost) VALUES (NULL, :name, :researchTime, :deuteriumCost, :metalCost)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':researchTime', $researchTime);
        $stmt->bindValue(':deuteriumCost', $deuteriumCost);
        $stmt->bindValue(':metalCost', $metalCost);
        $stmt->execute();
    }

    /**
     * Retrieves the row count of the technology_archetype table.
     *
     * @return int The row count.
     */
    public function getTechnologyArchetypeRowCount()
    {
        $query = $this->db->query("SELECT COUNT(*) FROM technology_archetype");
        return $query->fetchColumn();
    }
}

$db = new Database();

$rowCount = $db->getTechnologyArchetypeRowCount();

if (!$rowCount) {
    $db->insertTechnologyArchetype("Energy", 4, 100, 0);
    $db->insertTechnologyArchetype("Laser", 2, 300, 0);
    $db->insertTechnologyArchetype("Ion", 8, 500, 0);
    $db->insertTechnologyArchetype("Shield", 5, 1000, 0);
    $db->insertTechnologyArchetype("Weaponry", 6, 500, 200);
    echo "Technologies set up successfully!";
}
