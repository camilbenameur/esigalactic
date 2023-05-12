<?php

session_start();

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail']))
{
 $name = $_POST['name'];
 $password = password_hash($_POST['password'], "2y");
 $mail = $_POST['mail'];
 $query = $db->prepare("SELECT id FROM player WHERE name = ? AND password = ? AND mail = ?;");
 $query->execute([$name, $password, $mail]);
 $rows = $query->fetchAll();
 if(count($rows)>0){
    echo "Identifiants corrects";
    $_SESSION["connected"] = true;
    $_SESSION["universe"] = $_POST['universe-choice'];
    header("Location:galaxy.php");
}
 else{
    echo "Identifiants incorrects";
    header("Location:login.html");
}
}
else
{
 echo "Requête incorrecte";
}