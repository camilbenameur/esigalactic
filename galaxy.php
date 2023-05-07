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
    <link rel="stylesheet" href="galaxy-style.css">
    <link rel="icon" href="images/ESIGALACTIC.ico">
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <title>Galaxy</title>
</head>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="video/galaxy-screen.mp4"/>
    </video>
    <div class="gradient"></div>

    <div class="choice">
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
        <select id="choice" name="ss-choice">
            <option value=""></option>
            <option value="option 1">solar system 1</option>
            <option value="option 2">solar system 2</option>
            <option value="option 3">solar system 3</option>
            <option value="option 4">solar system 4</option>
            <option value="option 5">solar system 5</option>
            <option value="option 6">solar system 6</option>
            <option value="option 7">solar system 7</option>
            <option value="option 8">solar system 8</option>
            <option value="option 9">solar system 9</option>
            <option value="option 10">solar system 10</option>
        </select>
    </div>

    <div class="planet-display">
        
    </div>

</body>
</html>