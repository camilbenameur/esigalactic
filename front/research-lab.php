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
    <link rel="stylesheet" href="../style/research-lab.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>Research lab</title>
</head>
<body>
    <img id="bg" draggable="false" src="../images/research-lab/lab-background.jpg" alt="background">
    <div class="gradient"></div>

    <div class="technology researched" id="energy">
        <p>Energy</p>
        <p id="energy-tech-level"></p>
    </div>

    
    <div class="technology blocked" id="laser">
        <p>Laser</p>
        <p id="laser-tech-level"></p>
    </div>

    <div class="technology blocked" id="ion">
        <p>Ion</p>
        <p id="ion-tech-level"></p>
    </div>

    <div class="technology blocked" id="shield">
        <p>Shield</p>
        <p id="shield-tech-level"></p>
    </div>

    <div class="technology blocked" id="weaponry">
        <p>Weaponry</p>
        <p id="weaponry-tech-level"></p>
    </div>

    <div class="technology blocked" id="display">
        <p>Click on a tech</p>
        <p>Metal cost : ?</p>
        <p>Deuterium cost : ?</p>
        <p>Research time : ?</p>
        <input type="button" name="energy" value="upgrade">
    </div>

    <img id="arrow-1" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-2" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-3" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-4" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">

    <div class="balance" id="balance">   
        <span>
            <p><h3>Balance</h3></p>
            <p id="metal-display"></p>
            <p id="deuterium-display"></p>
            <p id="energy-display"></p>
        </span>
    </div>

    <script src="../js/technology.js"></script>  
</body>
</html>