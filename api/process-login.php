<?php

class Database
{
    private $db;

    /**
     * Database constructor.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=esigalactic", "root", "");
    }

    /**
     * Executes a query with optional parameters and returns the result as an array.
     *
     * @param string $query   The SQL query to execute.
     * @param array  $params  Optional parameters for the query.
     * @return array          The result of the query as an array.
     */
    public function executeQuery($query, $params = [])
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Retrieves a player from the database based on name, password, and mail.
     *
     * @param string $name      The name of the player.
     * @param string $password  The password of the player.
     * @param string $mail      The email of the player.
     * @return array            The result of the query as an array.
     */
    public function getPlayer($name, $password, $mail)
    {
        $hash_password = hash("sha512", $password);
        $query = $this->db->prepare("SELECT id FROM player WHERE name = ? AND password = ? AND mail = ?;");
        $query->execute([$name, $hash_password, $mail]);
        return $query->fetchAll();
    }

    /**
     * Retrieves the wallet information for a player in a specific universe.
     *
     * @param int $playerId     The ID of the player.
     * @param int $universeId   The ID of the universe.
     * @return array            The result of the query as an array.
     */
    public function getWallet($playerId, $universeId)
    {
        $query = $this->db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$playerId, $universeId]);
        return $query->fetchAll();
    }

    /**
     * Checks if a wallet exists for a player in a specific universe.
     *
     * @param int $playerId     The ID of the player.
     * @param int $universeId   The ID of the universe.
     * @return bool             True if the wallet exists, false otherwise.
     */
    public function isWallet($playerId, $universeId)
    {
        return (count($this->getWallet($playerId, $universeId)) > 0);
    }

    /**
     * Inserts a wallet for a player in a specific universe if it doesn't exist.
     *
     * @param int $playerId     The ID of the player.
     * @param int $universeId   The ID of the universe.
     */
    public function insertWalletIfNot($playerId, $universeId)
    {
        if (!$this->isWallet($playerId, $universeId)) {
            $query = $this->db->prepare("INSERT INTO wallet (player_id, universe_id, metal, deuterium, energy) VALUES (?, ?, 1000, 1000, 1000);");
            $query->execute([$playerId, $universeId]);
        }
    }
}

class SessionManager
{
    /**
     * Starts the session.
     */
    public function start()
    {
        session_start();
    }

    /**
     * Sets a value in the session.
     *
     * @param string $key    The key of the session variable.
     * @param mixed  $value  The value to set.
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

class Authentication
{
    private $db;
    private $sessionManager;

    /**
     * Authentication constructor.
     * Initializes the database and session manager.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->sessionManager = new SessionManager();
    }

    /**
     * Authenticates a player based on name, password, and mail.
     * If successful, sets session variables and redirects to the galaxy page.
     * If unsuccessful, redirects to the login page.
     *
     * @param string $name      The name of the player.
     * @param string $password  The password of the player.
     * @param string $mail      The email of the player.
     */
    public function authenticate($name, $password, $mail)
    {
        $playerRows = $this->db->getPlayer($name, $password, $mail);

        if (count($playerRows) > 0 && isset($_POST['universe-choice'])) {
            $this->sessionManager->start();
            $this->sessionManager->set("connected", true);
            $this->sessionManager->set("player_id", $playerRows[0]["id"]);
            $this->sessionManager->set("universe-choice", $_POST['universe-choice']);
            $this->sessionManager->set("galaxy-choice", 1);
            $this->sessionManager->set("solar-system-choice", 1);

            $this->db->insertWalletIfNot($playerRows[0]["id"], $_POST['universe-choice']);
            $walletRows = $this->db->getWallet($playerRows[0]["id"], $_POST['universe-choice']);
            $this->sessionManager->set("metal", $walletRows[0]["metal"]);
            $this->sessionManager->set("deuterium", $walletRows[0]["deuterium"]);
            $this->sessionManager->set("energy", $walletRows[0]["energy"]);

            header("Location:../front/galaxy.php");
        } else {
            header("Location:../front/login.php");
        }
    }
}

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];

    $authentication = new Authentication();
    $authentication->authenticate($name, $password, $mail);
}
