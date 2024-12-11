<?php
 require_once './utils/db-name.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyles.css">

    <title>Gestion Hospitalière</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenue à la Gestion Hospitalière</h1>
            <p>Ce système vous permet de gérer les patients, de créer des rendez-vous et de maintenir une base de données à jour.</p>
        </header>

        <nav>
            <ul>
                <li><a href="ajout-patient.php">Ajouter un patient</a></li>
                <li><a href="liste-patients.php">Liste des patients</a></li>
                <li><a href="ajout-rendezvous.php">Créer un rendez-vous</a></li>
                <li><a href="ajout-patient-rendez-vous.php">Ajouter un patient avec rendez-vous</a></li>
            </ul>
        </nav>

        <footer>
            <p>&copy; 2024 Hôpital ABC - Tous droits réservés</p>
        </footer>
    </div>
</body>
</html>
