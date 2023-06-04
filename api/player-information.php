<?php

/**
 * Represents a database connection.
 */
class DatabaseConnection
{
    private $db;

    /**
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");
    }

    /**
     * Executes a prepared query with the given parameters.
     *
     * @param string $query The query to execute.
     * @param array $params The parameters for the query.
     * @return array|false The result of the query, or false on failure.
     */
    public function executeQuery($query, $params)
    {
        $stmt = $this->db->prepare($query);
        if ($stmt->execute($params)) {
            return $stmt->fetchAll();
        }
        return false;
    }
}

/**
 * Represents a player and provides methods to retrieve player information.
 */
class Player
{
    private $db;
    private $playerId;

    /**
     * Initializes the player object with the given player ID.
     *
     * @param int $playerId The ID of the player.
     */
    public function __construct($playerId)
    {
        $this->db = new DatabaseConnection();
        $this->playerId = $playerId;
    }

    /**
     * Retrieves the player information from the database.
     *
     * @return array|false The player information, or false if the player is not found.
     */
    public function getPlayerInfo()
    {
        $query = "SELECT * FROM player WHERE id = ?;";
        return $this->db->executeQuery($query, [$this->playerId]);
    }
}

// Start the session
session_start();

if (isset($_GET["player-id"])) {
    $playerId = $_GET["player-id"];
    $player = new Player($playerId);
    $playerInfo = $player->getPlayerInfo();

    echo json_encode($playerInfo[0]);
}
