<?php

session_start();
if(!isset($_SESSION["connected"]) || $_SESSION["connected"] !== true)
{
    header("Location:login.html");
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
    <form class="choice" method="post" action="../api/show-solar-system.php" >
        <p>Galaxy</p>
        <select id="choice" name="galaxy-choice">
            <?php
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT name FROM galaxy WHERE ? = universe_id;");
                $query->execute([$_SESSION["universe"]]);
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
            ?>
        </select>
        <p>Solar system</p>
        <select id="choice" name="solar-system-choice">
            <?php 
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT name FROM solar_system WHERE ? = galaxy_id;");
                $query->execute([$_SESSION["universe"]]);
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Ok">
    </form>
    <div class="planet-display">
    </div>
</body>
</html>