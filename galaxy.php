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
    <link rel="stylesheet" href="./style/galaxy-style.css">
    <link rel="icon" href="images/ESIGALACTIC.ico">
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <title>Galaxy</title>
</head>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="video/galaxy-screen.mp4"/>
    </video>
    <div class="gradient"></div>
    <form class="choice" method="post" action="create-universe.php" >
        <p>Galaxy</p>
        <select id="choice" name="galaxy-choice">
            <option value=""></option>
            <option value="option1">Galaxy 1</option>
            <option value="option2">Galaxy 2</option>
            <option value="option3">Galaxy 3</option>
            <option value="option4">Galaxy 4</option>
            <option value="option5">Galaxy 5</option>
        </select>
        <p>solar system</p>
        <select id="choice" name="solar-system-choice">
            <option value=""></option>
            <option value="option 1">Solar system 1</option>
            <option value="option 2">Solar system 2</option>
            <option value="option 3">Solar system 3</option>
            <option value="option 4">Solar system 4</option>
            <option value="option 5">Solar system 5</option>
            <option value="option 6">Solar system 6</option>
            <option value="option 7">Solar system 7</option>
            <option value="option 8">Solar system 8</option>
            <option value="option 9">Solar system 9</option>
            <option value="option 10">Solar system 10</option>
        </select>
        <input type="submit" value="Ok">
    </form>
    <div class="planet-display">
    </div>
</body>
</html>