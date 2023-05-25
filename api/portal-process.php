<?php


if (isset($_POST['page'])) {
    $page = $_POST['page'];

    switch ($page) {
        case 'galaxy':
            header("Location: ../front/galaxy.php");
            break;
        case 'infrastructure':
            header("Location: ../front/infrastructure.php");
            break;
        case 'Space yard':
            
            header("Location: ../front/space-yard.php");
            break;
        case 'Research lab':
            //page pas encore existante
            header("Location: ../front/portal.php");
            break;
        case 'fleet':
            header("Location: ../front/fleet.php");
            break;
        case 'admin':
            header("Location: ../front/admin.php");
            break;
        default:
            // Redirection par défaut si aucune correspondance n'est trouvée
            header("Location: ../front/portal.php");
            break;
    }
}

