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
        <p id="line-1">
            <span class="position">1</span>
            <span>planet 1</span>
            <span>owner 1</span>
        </p>

        <p id="line-2">
            <span>2</span>
            <span>planet 2</span>
            <span>owner 2</span>
        </p>

        <p id="line-3">
            <span>3</span>
            <span>planet 3</span>
            <span>owner 3</span>
        </p>

        <p id="line-4">
            <span>4</span>
            <span>planet 4</span>
            <span>owner 4</span>
        </p>

        <p id="line-5">
            <span>5</span>
            <span>planet 5</span>
            <span>owner 5</span>
        </p>

        <p id="line-6">
            <span>6</span>
            <span>planet 6</span>
            <span>owner 6</span>
        </p>

        <p id="line-7">
            <span>7</span>
            <span>planet 7</span>
            <span>owner 7</span>
        </p>

        <p id="line-8">
            <span>8</span>
            <span>planet 8</span>
            <span>owner 8</span>
        </p>

        <p id="line-9">
            <span>9</span>
            <span>planet 9</span>
            <span>owner 9</span>
        </p>

        <p id="line-10">
            <span>10</span>
            <span>planet 10</span>
            <span>owner 10</span>
        </p>
    </div>
</body>
</html>