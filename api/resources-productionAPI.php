<?php

session_start();

$db = new PDO("mysql:host=localhost;dbname=esigalactic","root", "");

$planetId = $_SESSION["planet-choice"];
$universeId = $_SESSION["universe-choice"];
$playerId = $_SESSION["player_id"];

$query = $db->prepare("SELECT i.*, p.name AS planet_name, pl.name AS player_name
FROM infrastructure i
INNER JOIN planet p ON i.planet_id = p.id
INNER JOIN player pl ON p.player_id = pl.id
INNER JOIN solar_system ss ON p.solar_system_id = ss.id
INNER JOIN galaxy g ON ss.galaxy_id = g.id
WHERE i.archetype_id = ?
  AND p.player_id = ?
  AND g.universe_id = ?");


$query->execute([4, $playerId, $universeId]);
$metalMines = $query->fetchAll();

$query->execute([5, $playerId, $universeId]);
$deuteriumMines = $query->fetchAll();

$query->execute([6, $playerId, $universeId]);
$solarPlants = $query->fetchAll();

$query->execute([7, $playerId, $universeId]);
$fusionPlants = $query->fetchAll();


$query = $db->prepare("SELECT * FROM infrastructure_archetype WHERE id = ?;");
$query->execute([4]);
$metalMineArchetype = $query->fetchAll();

$query->execute([5]);
$deuteriumMineArchetype = $query->fetchAll();

$query->execute([6]);
$solarPlantArchetype = $query->fetchAll();

$query->execute([7]);
$fusionPlantArchetype = $query->fetchAll();

$metalMineArchetype = $metalMineArchetype[0];
$deuteriumMineArchetype = $deuteriumMineArchetype[0];
$solarPlantArchetype = $solarPlantArchetype[0];
$fusionPlantArchetype = $fusionPlantArchetype[0];

$metalMineResourceId = $metalMineArchetype['resource_id'];
$deuteriumMineResourceId = $deuteriumMineArchetype['resource_id'];
$solarPlantResourceId = $solarPlantArchetype['resource_id'];
$fusionPlantResourceId = $fusionPlantArchetype['resource_id'];

$query = $db->prepare("SELECT * FROM infrastructure_resources WHERE id = ?;");
$query->execute([$metalMineResourceId]);
$metalMineResource = $query->fetchAll();

$query->execute([$deuteriumMineResourceId]);
$deuteriumMineResource = $query->fetchAll();

$query->execute([$solarPlantResourceId]);
$solarPlantResource = $query->fetchAll();

$query->execute([$fusionPlantResourceId]);
$fusionPlantResource = $query->fetchAll();

$metalMineProductionRate = $metalMineResource[0]['production_rate'];
$deuteriumMineProductionRate = $deuteriumMineResource[0]['production_rate'];
$solarPlantProductionRate = $solarPlantResource[0]['production_rate'];
$fusionPlantProductionRate = $fusionPlantResource[0]['production_rate'];


$totalMetalProduction = 0;
foreach ($metalMines as $metalMine) {
    $level = $metalMine['level'];
    $productionRateWithLevelIncrease = $metalMineProductionRate * pow(1.5, $level);
    $totalMetalProduction += $productionRateWithLevelIncrease;
}


$totalDeuteriumProduction = 0;
foreach ($deuteriumMines as $deuteriumMine) {
    $level = $deuteriumMine['level'];
    $productionRateWithLevelIncrease = $deuteriumMineProductionRate * pow(1.3, $level);
    $totalDeuteriumProduction += $productionRateWithLevelIncrease;
}


$totalSolarProduction = 0;
foreach ($solarPlants as $solarPlant) {
    $level = $solarPlant['level'];
    $productionRateWithLevelIncrease = $solarPlantProductionRate * pow(1.4, $level);
    $totalSolarProduction += $productionRateWithLevelIncrease;
}

$totalFusionProduction = 0;
foreach ($fusionPlants as $fusionPlant) {
    $level = $fusionPlant['level'];
    $productionRateWithLevelIncrease = $fusionPlantProductionRate * pow(2, $level);
    $totalFusionProduction += $productionRateWithLevelIncrease;
}

$totalEnergyProduction = $totalSolarProduction + $totalFusionProduction;


$totalDeuteriumProduction = round($totalDeuteriumProduction);
$totalMetalProduction = round($totalMetalProduction);
$totalEnergyProduction = round($totalEnergyProduction);

$metalEventName = "update_metal_wallet_" . $playerId . "_" . $universeId;
$query = $db->prepare("SHOW EVENTS LIKE '$metalEventName'");
$query->execute();
$eventExists = $query->rowCount() > 0;

$query = $db->prepare("
    " . ($eventExists ? "ALTER" : "CREATE") . " EVENT $metalEventName
    ON SCHEDULE EVERY 1 MINUTE
    DO
    UPDATE wallet
    SET wallet.metal = wallet.metal + ?
    WHERE wallet.player_id = ? AND wallet.universe_id = ?
");
$query->execute([$totalMetalProduction, $playerId, $universeId]);


$deuteriumEventName = "update_deuterium_wallet_" . $playerId . "_" . $universeId;
$query = $db->prepare("SHOW EVENTS LIKE '$deuteriumEventName'");
$query->execute();
$eventExists = $query->rowCount() > 0;
$query = $db->prepare("
    " . ($eventExists ? "ALTER" : "CREATE") . " EVENT $deuteriumEventName
    ON SCHEDULE EVERY 1 MINUTE
    DO
    UPDATE wallet
    SET wallet.deuterium = wallet.deuterium + ?
    WHERE wallet.player_id = ? AND wallet.universe_id = ?
");
$query->execute([$totalDeuteriumProduction, $playerId, $universeId]);


$energyEventName = "update_energy_wallet_" . $playerId . "_" . $universeId;
$query = $db->prepare("SHOW EVENTS LIKE '$energyEventName'");
$query->execute();
$eventExists = $query->rowCount() > 0;

$query = $db->prepare("
    " . ($eventExists ? "ALTER" : "CREATE") . " EVENT $energyEventName
    ON SCHEDULE EVERY 1 MINUTE
    DO
    UPDATE wallet
    SET wallet.energy = wallet.energy + ?
    WHERE wallet.player_id = ? AND wallet.universe_id = ?
");
$query->execute([$totalEnergyProduction, $playerId, $universeId]);

echo json_encode([
    'metalProduction' => $totalMetalProduction,
    'deuteriumProduction' => $totalDeuteriumProduction,
    'energyProduction' => $totalEnergyProduction
]);