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
        <p>Level : 1</p>
        <input type="submit" name="energy" value="upgrade">
    </div>

    
    <div class="technology blocked" id="laser">
        <p>laser</p>
        <p>Level : 1</p>
        <input type="submit" name="energy" value="upgrade">
    </div>

    <div class="technology blocked" id="ions">
        <p>Ions</p>
        <p>Level : 1</p>
        <input type="submit" name="energy" value="upgrade">
    </div>

    <div class="technology blocked" id="shield">
        <p>Shield</p>
        <p>Level : 1</p>
        <input type="submit" name="energy" value="upgrade">
    </div>

    <div class="technology blocked" id="armament">
        <p>Armament</p>
        <p>Level : 1</p>
        <input type="submit" name="energy" value="upgrade">
    </div>

    <img id="arrow-1" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-2" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-3" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">
    <img id="arrow-4" draggable="false" width=272px height=272px src="../images/research-lab/arrow.png" alt="arrow">


    
</body>
</html>