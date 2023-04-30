<?php

session_start();

$db = new PDO("mysql:host=localhost;dbname=users","root", "root");
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail']))
{

 $name = $_POST['name'];
 $password = $_POST['password'];
 $mail = $_POST['mail'];
 $query = $db->prepare("SELECT id FROM users WHERE name = ? AND password = ? AND mail = ?;");
 $query->execute([$name, $password, $mail]);
 $rows = $query->fetchAll();
 if(count($rows)>0){
    echo "Identifiants corrects";
    $_SESSION["connected"] = true;
    echo "connected";
}
 else{
    echo "Identifiants incorrects";
    echo "wrong password or username";
}
}
else
{
 echo "Requête incorrecte";
}
