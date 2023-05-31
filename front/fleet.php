<?php

    session_start();
    if(!isset($_SESSION["player_id"])){
        header("Location:../front/login.php");
    }
    if (isset($_GET["planet-choice"])) {
        $_SESSION["planet_id"] = $_GET["planet-choice"];
    }else{
        $_SESSIONS["planet_id"] = 1;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/fleet.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>fleet</title>
</head>
<body>
    <img id="bg" draggable="false" src="../images/fleet/fleet-background.jpg" alt="background">
    <div class="gradient"></div>
    <div class="display-fleet">

        <div class="ship" id="fighter">
            <img id='fighter-pic' width=260px height=150px draggable="false" alt="fighter ship" src="../images/fleet/fighter.jpg">
            <p id="fighterNbr"></p>
            <input type="number" id="fighter-inpt" name="fighter-nbr" placeholder="Select number">
        </div>

        <div class="ship" id="cruiser">
            <img id='cruiser-pic' width=260px height=150px draggable="false" alt="cruiser ship" src="../images/fleet/cruiser.jpg">
            <p id="cruiserNbr"></p>
            <input type="number" id="cruiser-inpt" name="cruiser-nbr" placeholder="Select number">
        </div>

        <div class="ship" id="transporter">
            <img id='transporter-pic' width=260px height=150px draggable="false" alt="transporter ship" src="../images/fleet/transporter.jpg">
            <p id="transporterNbr"></p>
            <input type="number" id="transporter-inpt" name="transporter-nbr" placeholder="Select number">
        </div>

        <div class="ship" id="colonization-ship">
            <img id='colonization-pic' width=260px height=150px draggable="false" alt="colonization ship" src="../images/fleet/colonization-ship.jpg">
            <p id="colonizationNbr"></p>
            <input type="number" id="colonization-inpt" name="colonization-nbr" placeholder="Select number">
        </div>
    </div>

    <form id="choice-form" class="choice" method="get">
        <p>Galaxy</p>
        <select id="galaxy-choice" name="galaxy-choice" class="location-choice">
            <?php
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT id, name FROM galaxy WHERE ? = universe_id;");
                $query->execute([$_SESSION["universe-choice"]]);
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

        <p>planet</p>
        <select id="planet-choice" name="planet-choice" class="location-choice">
            
        </select>
    </form>

    <div class="attack">
        <form id="choice-form" action="" method="post">
            <input id="attack" type="submit" value="attack">
        </form>
        <form id="choice-form" action="" method="post">
            <input id="colonize" type="submit" value="colonize">
        </form>
    </div>

    <div class="display-stats">
        <h3>Your statistics</h3>
        <p id="attack-stats"></p>
        <p id="def-stats"></p>
        <p id="fret-stats"></p>
    </div>

      
    <div class="display-planet" id="planet-info">

                
    </div>

    <script src="../js/fleet.js"></script> 
</body>
</html>