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
    <div class="choice">

        <form method="post" action="../api/create-universe.php" >
            <input type="text" name="universeName" placeholder="Universe name">
            <input type="submit" value="New universe">
        </form>


        <form method="post" action="../api/set-up-infrastructures.php" >
            <input type="submit" value="set-up-infrastructures">
        </form>

    </div>
</body>