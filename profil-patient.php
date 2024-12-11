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
        // modif
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider'])) {
            $lastnameNew = htmlspecialchars($_POST['lastname']);
            $firstnameNew = htmlspecialchars($_POST['firstname']);
            $birthdateNew = htmlspecialchars($_POST['birthdate']);
            $phoneNew = htmlspecialchars($_POST['phone']);
            $mailNew = htmlspecialchars($_POST['mail']);

            $updateInfos = $pdo->prepare('UPDATE patients SET lastname = ?,firstname = ?, birthdate = ?, phone = ?, mail = ? WHERE id = ? ');
            $updateInfos->execute(array($lastnameNew, $firstnameNew, $birthdateNew, $phoneNew, $mailNew, $getid));

            header("Location: profil-patient.php?id=" . urlencode($patient['id']));
            exit();
        }
    }
} else {
    echo "Le patient n'a pas été trouvé";
}

?>  


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations du patient</title>
    <link rel="stylesheet" href="profilstyles.css">
</head>

<body>

    <h1>Informations de <?= htmlspecialchars($patient['lastname'] . ' ' . $patient['firstname']); ?></h1>

    <section>
        <h2>Informations personnelles</h2>
        <ul>
            <li><strong>Nom :</strong> <?= htmlspecialchars($patient['lastname']); ?></li>
            <li><strong>Prénom :</strong> <?= htmlspecialchars($patient['firstname']); ?></li>
            <li><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['birthdate']); ?></li>
            <li><strong>Numéro de téléphone :</strong> <?= htmlspecialchars($patient['phone']); ?></li>
            <li><strong>Email :</strong> <?= htmlspecialchars($patient['mail']); ?></li>
        </ul>
    </section>

    <?php if ($rdv) { ?>
    <section>
        <h2>Rendez-vous</h2>
        <p><strong>Rendez-vous le :</strong> <?= htmlspecialchars($rdv['dateHour']); ?></p>
        <a href="supprimer-rdv.php?id=<?= $rdv['id']; ?>">
            <button>Annuler le rendez-vous</button>
        </a>
    </section>
    <?php } ?>

    <section>
        <h2>Modifiez les informations</h2>
        <form method="POST">
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($patient['lastname']); ?>" required>

            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($patient['firstname']); ?>" required>

            <label for="birthdate">Date de naissance :</label>
            <input type="date" id="birthdate" name="birthdate" value="<?= htmlspecialchars($patient['birthdate']); ?>" required>

            <label for="phone">Numéro de téléphone :</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($patient['phone']); ?>" required>

            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" value="<?= htmlspecialchars($patient['mail']); ?>" required>

            <button type="submit" name="valider">Enregistrer les modifications</button>
        </form>
    </section>

</body>

</html>
