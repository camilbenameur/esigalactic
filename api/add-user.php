<?php

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail']))
{
    echo "received data\n";
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hash_password = hash("sha512", $password);
    $mail = $_POST['mail'];
    $query = $db->prepare("SELECT id FROM player WHERE name = ? OR mail = ?;");
    $query->execute([$name, $mail]);
    $rows = $query->fetchAll();
    if(count($rows)>0){
        echo "username or e-mail already used ";
        header("Location:login.html");
     }
     else{
          $query = $db->prepare("INSERT INTO player (id, name, password, mail) VALUES (NULL, ?, ?, ?) ;");
          if ($query->execute([$name, $hash_password, $mail])) {
               echo "Les données ont été ajoutées avec succès.";
               header("Location:login.html");
           } else {
               $error = $query->errorInfo();
               echo "Erreur : " . $error[2];
           }
     }
}