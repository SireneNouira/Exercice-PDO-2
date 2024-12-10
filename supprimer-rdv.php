<?php
require_once './utils/db-name.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupRdv = $pdo->prepare('SELECT * FROM appointments WHERE id= ?');
    $recupRdv->execute(array($getid));

    if ($recupRdv->rowCount() > 0) {
        $deleteRdv= $pdo->prepare('DELETE FROM appointments WHERE id = ?');
        $deleteRdv->execute(array($getid));
        header("Location: liste-patients.php");
            exit();
    } else {
        echo "aucun rdv trouvé";
    }
} else {
    echo "aucun identifiant trouvé";
}
