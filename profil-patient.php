<?php

require_once './utils/db-name.php';


if (isset($_GET['id'])) {
    $getid = $_GET['id'];
    $recupPatient = $pdo->prepare('SELECT * FROM patients WHERE id = ?');
    $recupPatient->execute(array($getid));

    if($recupPatient->rowCount() > 0){
        echo $recupPatient;
    }
} else {
    echo "Le patient n'a pas été trouvé";
}





?>


