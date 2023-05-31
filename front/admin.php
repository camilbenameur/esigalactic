<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin page</title>
<link rel="stylesheet" href="../style/admin.css">
<link rel="icon" href="../images/ESIGALACTIC.ico">
<link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
</head>
<body>

    <img id="meme1" class="meme" draggable="false" width=500px height=250px src="../images/admin/meme1.png" alt="background">
    <p class="texte">oui j'ai perdu du temps à faire ça</p>

    <div class="choice">
        <form method="post" action="../api/create-universe.php" >
            <input type="text" name="universeName" placeholder="Universe name">
            <input type="submit" value="New universe">
        </form>
        <form method="post" action="../api/set-up-infrastructures.php" >
            <input type="submit" value="set-up-infrastructures">
        </form>
        <form method="post" action="../api/set-up-technologies.php">
            <input type="submit" value="set-up-technologies">
        </form>
        <form method="post" action="../api/ship-displayAPI.php">
            <input type="submit" value="set-up-ships">
    </div>

    <script src="../js/admin.js"></script>

</body>