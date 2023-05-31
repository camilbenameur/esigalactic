<?php

if (isset($_POST['page'])) {
    $page = $_POST['page'];

    switch ($page) {
        case 'galaxy':
            header("Location: ../front/galaxy.php");
            exit();
        case 'infrastructure':
            header("Location: ../front/infrastructure.php");
            exit();
        case 'Space yard':
            header("Location: ../front/space-yard.php");
            exit();
        case 'Research lab':
            header("Location: ../front/research-lab.php");
            exit();
        case 'fleet':
            header("Location: ../front/fleet.php");
            exit();
        case 'admin':
            header("Location: ../front/admin.php");
            exit();
        default:
            // Redirection par défaut si aucune correspondance n'est trouvée
            header("Location: ../front/portal.php");
            exit();
    }
}
