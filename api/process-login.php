<?php

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail']))
{
 $name = $_POST['name'];
 $password = $_POST['password'];
 $hash_password = hash("sha512", $password);
 $mail = $_POST['mail'];
 $query = $db->prepare("SELECT id FROM player WHERE name = ? AND password = ? AND mail = ?;");
 $query->execute([$name, $hash_password, $mail]);
 $rows = $query->fetchAll();
 if(count($rows)>0){
    session_start();
    $_SESSION["connected"] = true;
    $_SESSION["player_id"] = $rows[0]["id"];
    $_SESSION["universe"] = $_POST['universe-choice'];
    $_SESSION["galaxy-choice"] = 1;
    $_SESSION["solar-system-choice"] = 1;
    $_SESSION["planet-choice"] = 1;
    echo "Identifiants corrects";
    $query = $db->prepare("SELECT * FROM wallet WHERE player_id = ?;");
    $query->execute([$_SESSION["player_id"]]);
    $rows = $query->fetchAll();
    $_SESSION["deuterium"] = $rows[0]["deuterium"];
    $_SESSION["metal"] = $rows[0]["metal"];
    $_SESSION["energy"] = $rows[0]["energy"];
    header("Location:../front/galaxy.php");
}
 else {
    echo "Identifiants incorrects";
    header("Location:../front/login.php");
}
}
else
{
 echo "Requête incorrecte";
}