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
    if(count($rows)>0) {
        echo "username or e-mail already used ";
        header("Location:../front/login.php");
    }
    else {
        $query = $db->prepare("INSERT INTO player (id, name, password, mail) VALUES (NULL, ?, ?, ?) ;");
        if ($query->execute([$name, $hash_password, $mail])) {
            $playerId = $db->lastInsertId();
            $query = $db->prepare("SELECT id FROM universe;");
            $query->execute();
            $rows = $query->fetchAll();
            foreach($rows as $row) {
                $query = $db->prepare("INSERT INTO wallet (id, player_id, universe_id) VALUES (NULL, ?, ?) ;");
                $query->execute([$playerId, $row['id']]);
            }
            header("Location:../front/login.php");
        } 
        else {
            $error = $query->errorInfo();
            echo "Erreur : " . $error[2];
        }
    }
}