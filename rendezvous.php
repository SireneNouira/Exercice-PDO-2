<?php

require_once './utils/db-name.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupPatient = $pdo->prepare('SELECT * FROM patients WHERE id = ? ');
    $recupPatient->execute(array($getid));

    

    if ($recupPatient->rowCount() > 0) {
        $patient = $recupPatient->fetch(PDO::FETCH_ASSOC);
        
        
    $recupRdv = $pdo->prepare('SELECT * FROM appointments WHERE idPatients = ?');
    $recupRdv->execute(array($getid));
    
    $rdv = $recupRdv->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider'])) {

        $dateHour = ($_POST['dateHour']);

        $updateRdv = $pdo->prepare('UPDATE appointments SET dateHour = ? WHERE idPatients = ? ');
        $updateRdv->execute(array($dateHour, $getid));
    
        header("Location: rendezvous.php?id=" . urlencode($patient['id']));
        exit();
    }
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Rendez-vous</title>
    <link rel="stylesheet" href="rdvstyles.css">
</head>

<body>

    <h1>Informations du rendez-vous de <?= htmlspecialchars($patient['lastname'] . ' ' . $patient['firstname']); ?> </h1>

    <?php if ($rdv) { ?>
    <p><strong>Rendez-vous actuel :</strong> <?= htmlspecialchars($rdv['dateHour']); ?></p>
    <?php } else { ?>
    <p class="message">Aucun rendez-vous trouvé pour ce patient.</p>
    <?php } ?>

    <h1>Modifiez le rendez-vous</h1>

    <form action="" method="post">
        <label for="dateHour">Date et heure :</label>
        <input type="datetime-local" id="dateHour" name="dateHour" required>
        <br><br>

        <button type="submit" name="valider">Confirmez le nouveau rendez-vous</button>
    </form>

</body>

</html>