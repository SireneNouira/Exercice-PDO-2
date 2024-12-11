<?php

require_once './utils/db-name.php';

// Paramètres de pagination
$patientsPerPage = 5; // Nombre de patients par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle, par défaut 1
$offset = ($page - 1) * $patientsPerPage; // Calcul de l'offset

// Récupérer le nombre total de patients
try {
    $totalPatientsStmt = $pdo->query("SELECT COUNT(*) AS total FROM `patients`");
    $totalPatients = $totalPatientsStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalPatients / $patientsPerPage); // Nombre total de pages
} catch (PDOException $error) {
    echo "Erreur lors de la récupération du nombre total de patients : " . $error->getMessage();
    exit;
}

// Récupérer les patients pour la page actuelle
$sql = "SELECT * FROM `patients` LIMIT :limit OFFSET :offset";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $patientsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
    exit;
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
    <title>Liste des Patients</title>
    <link rel="stylesheet" href="liststyles.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Liste des patients</h1>
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher..." required>
                <button type="submit">Rechercher</button>
            </form>
        </header>

        <section>
            <ol>
                <?php
                foreach ($patients as $patient) { ?>
                    <li>
                        <a href="./profil-patient.php?id=<?= $patient['id']; ?>"> <?= $patient['firstname']; ?></a>
                        <br>
                        <?php
                        foreach ($appointments as $appointment) {
                            if ($appointment['idPatients'] === $patient['id']) {
                        ?>
                                <a href="./rendezvous.php?id=<?= $patient['id']; ?>">
                                    <p>Rendez-vous le <?= $appointment['dateHour']; ?></p>
                                </a>
                    </li>
                <?php
                            }
                        }
                    }
                ?>
            </ol>
        </section>

        <nav class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>">Précédent</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>" <?= $i === $page ? 'style="font-weight: bold;"' : ''; ?>><?= $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1; ?>">Suivant</a>
            <?php endif; ?>
        </nav>

        <div class="links">
            <a href="./ajout-patient.php">Ajouter des patients</a>
            <a href="ajout-rendezvous.php">Créer un rendez-vous</a>
            <a href="supprimerPatient.php">Supprimer un patient</a>
        </div>
    </div>
</body>

</html>