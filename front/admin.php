<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="icon" href="images/ESIGALACTIC.ico">
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
</head>
<body>
    <form class="choice" method="post" action="../api/create-universe.php" >
        <input type="text" name="universeName" placeholder="Universe name">
        <input type="submit" value="New universe">
</body>