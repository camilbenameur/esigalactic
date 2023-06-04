<?php 
session_start();

if(!isset($_SESSION["connected"]) || $_SESSION["connected"] !== true)
{
    header("Location:login.php");
}
else
{
    $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
    session_destroy();
    header("Location:../front/login.php");
}

?>