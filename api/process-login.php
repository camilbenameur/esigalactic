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
    echo "Identifiants corrects";
    $_SESSION["connected"] = true;
    $_SESSION["universe"] = $_POST['universe-choice'];
    $_SESSION["galaxy-choice"] = 1;
    $_SESSION["solar-system-choice"] = 1;
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