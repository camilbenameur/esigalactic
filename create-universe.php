
<?php 


$PDO = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

function galaxyCreation($db = $PDO) {
    $query = "INSERT INTO galaxy (id, universe_id) VALUES (NULL, :universe_id)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':universe_id', $_SESSION["universe"]);
}

function solarSystemCreation($db = $PDO) {
    $query = "INSERT INTO solar_system (id, galaxy_id) VALUES (NULL, :galaxy_id)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':galaxy_id', $_SESSION["universe"]);
}


if(isset($_POST['galaxy-choice']) && isset($_POST['solar-system-choice'])) 
{
    $query = $db->prepare("SELECT id FROM universe WHERE id = ?;");
    $query->execute([$_SESSION["universe"]]);
    $rows = $query->fetchAll();
    if(count($rows)>0){
        galaxyCreation();
        solarSystemCreation();
    }
    else{
        $query = "INSERT INTO universe (id, name) VALUES (NULL, :name)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $_SESSION["universe"]);
    }
}