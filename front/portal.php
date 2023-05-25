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
    <link rel="stylesheet" href="../style/portal.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>Portal</title>
</head>
<body>
    <img id="bg" draggable="false" src="../images/portal/portal-background.jpg" alt="background">
    <div class="gradient"></div>

    <div class="banner">
        <ul>
            <li>P</li>
            <li>O</li>
            <li>R</li>
            <li>T</li>
            <li>A</li>
            <li>L</li>
        </ul>
    </div>
    
    <div class="container">
        <form action="../api/portal-process.php" method="POST">
            <input type="submit" name="page" value="galaxy">
            <input type="submit" name="page" value="infrastructure">
            <input type="submit" name="page" value="Space yard">
            <input type="submit" name="page" value="Research lab">
            <input type="submit" name="page" value="fleet">
            <input type="submit" name="page" value="admin">
        </form>
    </div>
</body>
</html>