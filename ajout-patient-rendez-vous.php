<?php

require_once './utils/db-name.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider'])) {
    // Récupération des données du formulaire
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $birthdate = $_POST['birthdate'];
    $phone = htmlspecialchars($_POST['phone']);
    $mail = htmlspecialchars($_POST['mail']);
    $dateHour = $_POST['dateHour'];

    try {
        
        $pdo->beginTransaction();

        
        $insertPatient = $pdo->prepare(
            'INSERT INTO patients(lastname, firstname, birthdate, phone, mail) VALUES(?, ?, ?, ?, ?)'
        );
        $insertPatient->execute([$lastname, $firstname, $birthdate, $phone, $mail]);

       
        $idPatients = $pdo->lastInsertId();
        
        if (!$idPatients) {
            throw new Exception("L'insertion du patient a échoué.");
        }

      
        $insertRDV = $pdo->prepare('INSERT INTO appointments(dateHour, idPatients) VALUES(?, ?)');
        $insertRDV->execute([$dateHour, $idPatients]);

       
        $pdo->commit();
        echo "Patient et rendez-vous ajoutés avec succès.";
    } catch (Exception $error) {
        $pdo->rollBack();
        echo "Erreur : " . $error->getMessage();
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstyles.css">

    <title>Document</title>
</head>
<body>
    <form action="" method="post">

    <label for="lastname">Nom :</label>
    <input type="text" id="lastname" name="lastname" required placeholder="Entrez votre nom">
    <br><br>

    <label for="firstname">Prénom :</label>
    <input type="text" id="firstname" name="firstname" required placeholder="Entrez votre prénom">
    <br><br>

    <label for="birthdate">Date de naissance :</label>
    <input type="date" id="birthdate" name="birthdate" required>
    <br><br>

    <label for="phone">Téléphone :</label>
    <input type="tel" id="phone" name="phone" required placeholder="Entrez votre numéro">
    <br><br>

    <label for="mail">Email :</label>
    <input type="email" id="mail" name="mail" required placeholder="Entrez votre adresse email">
    <br><br>
 
    <label for="dateHour">Date et heure :</label>
        <input type="datetime-local" id="dateHour" name="dateHour" required>
        <br><br>

        </select>
        <br><br>

  <button type="submit" name='valider' >Envoyer</button>

    </form>
</body>
</html>