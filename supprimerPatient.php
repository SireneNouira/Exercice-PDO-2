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

   try {
 
        $pdo->beginTransaction();

        
        $deleteRdv = $pdo->prepare('DELETE FROM appointments WHERE idPatients = ?');
        $deleteRdv->execute([$idPatients]);

        
        $deletePatient = $pdo->prepare('DELETE FROM patients WHERE id = ?');
        $deletePatient->execute([$idPatients]);
        
        $pdo->commit();

        
        header("Location: supprimerPatient.php");
        exit();
    } catch (PDOException $error) {
        
        $pdo->rollBack();
        echo "Erreur lors de la suppression : " . $error->getMessage();
        exit();
    }

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
        

        <label for="idPatients">Patient a supprimer :</label>
        <select id="idPatients" name="idPatients" required>

            <option value="">Sélectionnez un patient</option>

            <?php foreach ($patients as $patient){ ?>

                <option value="<?= htmlspecialchars($patient['id']); ?>">
                    <?= htmlspecialchars($patient['firstname']); ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <button type="submit" name='valider'>Supprimer le patient</button>
    </form>
</body>
</html>