<?php

require_once '../utils/db-name.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider'])) {
    
    
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $birthdate = ($_POST['birthdate']);
    $phone = htmlspecialchars($_POST['phone']);
    $mail = htmlspecialchars($_POST['mail']);
    
    
    $insertPatient = $pdo->prepare('INSERT INTO patients(lastname, firstname, birthdate, phone, mail) VALUES(?,?, ?, ?, ?)');
    $insertPatient->execute(array($lastname, $firstname, $birthdate, $phone, $mail));

    }

?>
