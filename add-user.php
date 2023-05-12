<?php
$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['mail']))
{
    echo "received data\n";
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], "2y");
    $mail = $_POST['mail'];
    $query = $db->prepare("SELECT id FROM player WHERE name = ? OR mail = ?;");
    $query->execute([$name, $mail]);
    $rows = $query->fetchAll();
    if(count($rows)>0){
        echo "username or e-mail already used ";
   }
   else{
        $query = "INSERT INTO player (id, name, password, mail) VALUES (NULL, :name, :password, :mail)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mail', $mail);
   }
}