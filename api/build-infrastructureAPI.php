<?php

session_start();

$archetype_id = $_GET["archetype-choice"];
$planet_id = $_SESSION["planet_id"];

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
