<?php

require_once './utils/db-name.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider'])) {

    $idPatients = htmlspecialchars($_POST['idPatients']);
    $dateHour = ($_POST['dateHour']);

    $insertRDV = $pdo->prepare('INSERT INTO appointments(dateHour, idPatients) VALUES(?,?)');
    $insertRDV->execute(array($dateHour, $idPatients ));


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
    <form action="" method="post">
        <label for="dateHour">Date et heure :</label>
        <input type="datetime-local" id="dateHour" name="dateHour" required>
        <br><br>

        <label for="idPatients">Patient :</label>
        <select id="idPatients" name="idPatients" required>

            <option value="">Sélectionnez un patient</option>

            <?php foreach ($patients as $patient){ ?>

                <option value="<?= htmlspecialchars($patient['id']); ?>">
                    <?= htmlspecialchars($patient['firstname']); ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <button type="submit" name='valider'>Créer le rendez-vous</button>
    </form>
</body>

</html>