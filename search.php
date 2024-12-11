<?php
require_once './utils/db-name.php';

if (isset($_GET['query'])) {
    $searchQuery = htmlspecialchars($_GET['query']);

  
    $sql = "SELECT * FROM `patients` WHERE `firstname` LIKE :search OR `lastname` LIKE :search";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':search' => '%' . $searchQuery . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo "Erreur lors de la requête : " . $error->getMessage();
        exit();
    }
} else {
    $results = [];
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
</head>

<body>
    <h1>Résultats de la recherche</h1>
    <?php if (empty($results)) { ?>
        <p>Aucun patient trouvé pour la recherche : <strong><?= htmlspecialchars($searchQuery); ?></strong></p>
    <?php } else { ?>
        <ul>
            <?php foreach ($results as $patient) { ?>
                <li>
                    <a href="./profil-patient.php?id=<?= $patient['id']; ?>">
                        <?= htmlspecialchars($patient['firstname'] . ' ' . $patient['lastname']); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

    <a href="liste-patients.php">Retour à la liste complète des patients</a>
</body>

</html>
