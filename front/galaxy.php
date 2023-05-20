<?php

session_start();
if(!isset($_SESSION["connected"]) || $_SESSION["connected"] !== true)
{
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/galaxy-style.css">
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <title>Galaxy</title>
</head>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="../video/galaxy-screen.mp4"/>
    </video>
    <div class="gradient"></div>
    <form id="choice-form" class="choice" >
        <p>Galaxy</p>
        <select id="galaxy-choice" name="galaxy-choice" class="location-choice">
            
            <?php
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT id, name FROM galaxy WHERE ? = universe_id;");
                $query->execute([$_SESSION["universe"]]);
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
            ?>
            
            
        </select>
        <p>Solar system</p>
        <select id="solar-system-choice" name="solar-system-choice" class="location-choice">    
            
                
            <?php 
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT id, name FROM solar_system WHERE ? = galaxy_id;");
                $query->execute([$_SESSION["galaxy-choice"]]);
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
            ?>
            
        </select>
    </form>
    <div class="disconnect-button">
        <form id="choice-form" action="../api/disconnect.php" method="post">
            <input id="disconnect" type="submit" value="Disconnect">
        </form>
    </div>
    <div id="planet-display" class="planet-display">   
        <script src="../js/galaxy.js"></script>    
    </div>


</body>
</html>