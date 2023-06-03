<?php

class Database
{
    private $db;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getPlayer($name, $password, $mail)
    {
        $hash_password = hash("sha512", $password);
        $query = $this->db->prepare("SELECT id FROM player WHERE name = ? AND password = ? AND mail = ?;");
        $query->execute([$name, $hash_password, $mail]);
        return $query->fetchAll();
    }

    public function getWallet($playerId, $universeId)
    {
        $query = $this->db->prepare("SELECT * FROM wallet WHERE player_id = ? AND universe_id = ?;");
        $query->execute([$playerId, $universeId]);
        return $query->fetchAll();
    }

    public function isWallet($playerId, $universeId)
    {
        return (count($this->getWallet($playerId, $universeId)) > 0);
    }

    public function insertWalletIfNot($playerId, $universeId)
    {
        if(!$this->isWallet($playerId, $universeId)) {
            $query = $this->db->prepare("INSERT INTO wallet (player_id, universe_id, metal, deuterium, energy) VALUES (?, ?, 1000, 1000, 1000);");
            $query->execute([$playerId, $universeId]);
        }
    }
}

class SessionManager
{
    public function start()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

class Authentication
{
    private $db;
    private $sessionManager;

    public function __construct()
    {
        $this->db = new Database("localhost", "esigalactic", "root", "");
        $this->sessionManager = new SessionManager();
    }

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

} else {
    echo "Requête incorrecte";
}

