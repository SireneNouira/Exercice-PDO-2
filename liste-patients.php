<?php

require_once './utils/db-name.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}



$sql = "SELECT * FROM `appointments`";

try {
    $stmt = $pdo->query($sql);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

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
    <div style="display: flex; align-items:center; gap:30px">
        <h1>Liste des patients</h1>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Rechercher..." required>
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <ol>
        <?php
        foreach ($patients as $patient) { ?>
            <li><a href="./profil-patient.php?id= <?= $patient["id"]; ?>"> <?= $patient['firstname']; ?></a>
                <br>
                <?php
                foreach ($appointments as $appointment) {
                    if ($appointment['idPatients'] === $patient['id']) {
                ?>
                        <a href="./rendezvous.php?id= <?= $patient["id"]; ?>">
                            <p>Rendez vous le <?= $appointment['dateHour']; ?></p>
            </li>
<?php
                    }
                }
            }

?>
    </ol>


    <a href="./ajout-patient.php">Ajouter des patients</a>
    <br>
    <br>
    <a href="ajout-rendezvous.php">Créé un rendez-vous</a>
    <br>
    <br>
    <a href="supprimerPatient.php">Supprimer un patient</a>
</body>

</html>