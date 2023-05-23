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

    public function getWallet($playerId)
    {
        $query = $this->db->prepare("SELECT * FROM wallet WHERE player_id = ?;");
        $query->execute([$playerId]);
        return $query->fetchAll();
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

    public function __construct($db, $sessionManager)
    {
        $this->db = $db;
        $this->sessionManager = $sessionManager;
    }

    public function authenticate($name, $password, $mail)
    {
        $rows = $this->db->getPlayer($name, $password, $mail);

        if (count($rows) > 0) {
            $this->sessionManager->start();
            $this->sessionManager->set("connected", true);
            $this->sessionManager->set("player_id", $rows[0]["id"]);
            $this->sessionManager->set("universe", $_POST['universe-choice']);
            $this->sessionManager->set("galaxy-choice", 1);
            $this->sessionManager->set("solar-system-choice", 1);
            $this->sessionManager->set("planet-choice", 1);
            echo "Identifiants corrects";
            $walletRows = $this->db->getWallet($_SESSION["player_id"]);
            $this->sessionManager->set("deuterium", $walletRows[0]["deuterium"]);
            $this->sessionManager->set("metal", $walletRows[0]["metal"]);
            $this->sessionManager->set("energy", $walletRows[0]["energy"]);
            header("Location:../front/galaxy.php");
        } else {
            echo "Identifiants incorrects";
            header("Location:../front/login.php");
        }
    }
}

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];

    $db = new Database("localhost", "esigalactic", "root", "");
    $sessionManager = new SessionManager();
    $authentication = new Authentication($db, $sessionManager);
    $authentication->authenticate($name, $password, $mail);
} else {
    echo "Requête incorrecte";
}