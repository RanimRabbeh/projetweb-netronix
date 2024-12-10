<?php
session_start(); // Démarrer la session



// Inclusion des contrôleurs
require_once __DIR__ . '/../../Controller/SolutionReclamationController.php';
require_once __DIR__ . '/../../Controller/AdminController.php';


// Récupération des administrateurs
$adminController = new AdminController();
$admins = $adminController->getAllAdmins();

// Récupération des paramètres
$idReclamation = $_GET['idreclamation'] ?? null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idReclamation = $_POST['idreclamation'];
    $idAdmin = $_POST['idadmin'];
    $solution = $_POST['solution'];

    if ($idReclamation && $idAdmin && $solution) {
        // Utilise SolutionReclamationController au lieu de SolutionController
        $solutionController = new SolutionReclamationController();
        $isAdded = $solutionController->addSolution($idReclamation, $idAdmin, $solution);

        if ($isAdded) {
            header("Location: sl.php");
            exit();
        } else {
            $message = "Erreur lors de l'ajout de la solution.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Solution</title>
    <!-- Lier le fichier CSS -->
    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <!-- Conteneur principal pour le formulaire -->
    <div class="form-container">
        <h1>Ajouter une Solution pour la réclamation ID: <?= htmlspecialchars($idReclamation) ?></h1>
        
        <!-- Message d'erreur s'il y en a -->
        <?php if (!empty($message)): ?>
            <p style="color: red;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <!-- Formulaire -->
        <form method="POST" action="">
            <!-- Champ caché pour idreclamation -->
            <input type="hidden" name="idreclamation" value="<?= htmlspecialchars($idReclamation) ?>">

            <!-- Liste déroulante pour les administrateurs -->
            <div class="form-group">
                <label for="idadmin">Administrateur :</label>
                <select name="idadmin" id="idadmin" required>
                    <option value="">-- Choisir un administrateur --</option>
                    <?php foreach ($admins as $admin): ?>
                        <option value="<?= htmlspecialchars($admin['IdAdmin']) ?>">
                            <?= htmlspecialchars($admin['NomUtilisateur']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Champ pour la solution -->
            <div class="form-group">
                <label for="solution">Solution :</label>
                <textarea name="solution" id="solution" required></textarea>
            </div>

            <!-- Bouton pour soumettre -->
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>

