<?php

session_start();
if(!isset($_SESSION["player_id"])){
    header("Location:../front/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/infrastructure.css"/>
    <link rel="stylesheet" href="../style/menu-button.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>Infrastructure</title>
</head>
<body>
    <div id="upgradeModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Upgrade in <span id="countdownTimer"></span> seconds</h1>
        </div>
    </div>
    
    <img id="bg" draggable="false" src="../images/infrastructure-background.jpg" alt="background">
    <div class="gradient"></div>
    <div class="infrastructure">
        <h3>Infrastructure</h3>
        <form  method="get" action="../api/infrastructure-displayAPI.php">
            <?php 
                $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                $query = $db->prepare("SELECT id, name FROM infrastructure_archetype;");
                $query->execute();
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    echo "<input type='radio' id='".$row["name"]."' name='archetype-choice' value='".$row["id"]."'>";
                    echo "<label for='".$row["name"]."'>".$row["name"]."</label>";
                }   
                echo "<script>document.getElementById('".$rows[0]["name"]."').checked = true;</script>";
            ?>
        </form>
    </div>
    <div class="infrastructure-display" id="infrastructure-display">
        <div class="facility-display" id="facility-display"></div>
    </div>
    <div class="display-picture">
        <img id='infrastructure-pic' width=400px height=250px draggable="false" alt="building">
    </div>

    <div class="balance" id="balance">   
        <span>
            <p><h3>Balance</h3></p>
            <p id="metal-display"></p>
            <p id="deuterium-display"></p>
            <p id="energy-display"></p>
        </span>
    </div>

    <div class="portal-button">
        <form id="portal-form" method="POST">
            <input type="image" name="button" src="../images/portal/portal.png" alt="submit">
        </form>
    </div>
    <div class="logout-button">
        <form id="logout-form" method="POST">
            <input type="image" name="logout-button" src="../images/logout.png" alt="submit">
        </form>
    </div>

    <script src="../js/portal-redirection.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/infrastructure.js"></script>
</body>
</html>