<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="icon" href="../images/ESIGALACTIC.ico">
    <title>Esigalactic</title>
</head>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="../video/Spaceship Turbines. live wallpaper.mp4"/>
    </video>
    <div class="gradient"></div>
    <img id="logo" draggable="false" src="../images/ESIGALACTIC.png" alt="Logo">
    <img id="logo" src="../images/ESIGALACTIC.png" alt="Logo">
    <div class="login">
        <p>Login</p>
        <p>Username</p>
            <form action="../api/process-login.php" method="post">
                    <input type="text" name="name" placeholder="Username">
                    <p>E-mail</p>
                    <input type="email" name="mail" placeholder="E-mail">
                    <p>Password</p>                   
                    <input type="password" name="password" placeholder="Password">                              
                    <p>Universe</p>
                    <select id="choice" name="universe-choice">
                        <?php 
                            $db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");
                            $query = $db->prepare("SELECT id, name FROM universe;");
                            $query->execute();
                            $rows = $query->fetchAll();
                            foreach($rows as $row)
                            {
                                echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="OK">    
            </form>       
    </div>
    <div class="create">
        <p>Create account</p>
        <p>Username</p>
        <form action="../api/add-user.php" method="post">   
            <input type="text" name="name" placeholder="Username">
            <p>E-mail</p>
            <input type="email" name="mail" placeholder="E-mail">
            <p>Password</p>
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="sign up">
        </form>
    </div>
    <div class="banner">
        <ul>
            <li>E</li>
            <li>S</li>
            <li>I</li>
            <li>G</li>
            <li>A</li>
            <li>L</li>
            <li>A</li>
            <li>C</li>
            <li>T</li>
            <li>I</li>
            <li>C</li>
        </ul>
    </div>
</body>
</html>