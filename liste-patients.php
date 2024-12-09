<?php

require_once './utils/db-name.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des patients</h1>

    <ol>
        <?php
        foreach ($patients as $patient) {?>
            <li><a href="./profil-patient.php?id= <?= $patient["id"]; ?>"> <?= $patient['lastname'];?></a></li>
            <?php
        } 
        ?>
    </ol>

    <a href="./ajout-patient.php">Ajouter des patients</a>
</body>
</html>