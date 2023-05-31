<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/space-yard.css"/>
    <link rel="stylesheet" href="../style/menu-button.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>space yard</title>
</head>
<body>
    <img id="bg" draggable="false" src="../images/space-yard/space-yard-background.jpg" alt="background">
    <div class="gradient"></div>
    <div class="display-fleet">

        <div class="ship" id="fighter">
            <img id='fighter-pic' width=260px height=150px draggable="false" alt="fighter ship" src="../images/fleet/fighter.jpg">
            <p>fighters</p>
            <p>Metal cost : 3000</p>
            <p>Deuterium cost : 500</p>
            <p id="fighter-quantity">Quantity : 0</p>
            <input type="submit" name="page" value="Build : 20 s">
        </div>

        <div class="ship" id="cruiser">
            <img id='cruiser-pic' width=260px height=150px draggable="false" alt="cruiser ship" src="../images/fleet/cruiser.jpg">
            <p>cruisers</p>
            <p>Metal cost : 20 000</p>
            <p>Deuterium cost : 5 000</p>
            <p id="cruiser-quantity">Quantity : 0</p>
            <input type="submit" name="page" value="Build : 120 s">
        </div>

        <div class="ship" id="transporter">
            <img id='transporter-pic' width=260px height=150px draggable="false" alt="transporter ship" src="../images/fleet/transporter.jpg">
            <p>transporters</p>
            <p>Metal cost : 6 000</p>
            <p>Deuterium cost : 1 500</p>
            <p id="transporter-quantity">Quantity : 0</p>
            <input type="submit" name="page" value="Build : 55 s">
        </div>

        <div class="ship" id="colonization-ship">
            <img id='colonization-pic' width=260px height=150px draggable="false" alt="colonization ship" src="../images/fleet/colonization-ship.jpg">
            <p>colonization ships</p>
            <p>Metal cost : 10 000</p>
            <p>Deuterium cost : 10 000</p>
            <p id="coloniser-quantity">Quantity : 0</p>
            <input type="submit" name="page" value="Build : 120 s">
        </div>
    </div>

    <div class="balance" id="balance">   
        <span>
            <p><h3>Balance</h3></p>
            <p id="metal-display"></p>
            <p id="deuterium-display"></p>
            <p id="energy-display"></p>
        </span>
    </div>

    <div class="banner">
        <ul>
            <li>S</li>
            <li>P</li>
            <li>A</li>
            <li>C</li>
            <li>E</li>
            <li>-</li>
            <li>Y</li>
            <li>A</li>
            <li>R</li>
            <li>D</li>
        </ul>
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
    <script src="../js/space-yard.js"></script>
</body>
</html>