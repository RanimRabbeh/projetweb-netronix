<?php
require_once '../../Controller/SolutionReclamationController.php';

$controller = new SolutionReclamationController();

// Par défaut, afficher toutes les solutions
$solutions = $controller->index(); // Renvoie les données des solutions

// Si une action est déclenchée (supprimer ou modifier)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'delete') {
        $controller->delete($id);
        header("Location: solutionsreclamation.php"); // Redirection après suppression
        exit();
    } elseif ($action === 'edit') {
        // Redirige vers une page d'édition
        header("Location: editSolution.php?id=$id");
        exit();
    }
}

// Si l'action est d'ajouter, redirige vers une page d'ajout
if (isset($_GET['action']) && $_GET['action'] === 'add') {
    header("Location: addSolution.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Solutions</title>
    <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="stylelist.css">
</head>
<body>
    

    <!-- Conteneur principal -->
    <div class="container">
        <h1>Liste des Solutions</h1>
        <table>
            <thead>
                <tr>
                    <th>IdSuivie</th>
                    <th>Réclamation ID</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($solutions as $solution): ?>
                    <tr>
                        <td><?= htmlspecialchars($solution['IdSuivie']) ?></td>
                        <td><?= htmlspecialchars($solution['IdReclamation']) ?></td>
                        <td><?= htmlspecialchars($solution['solution']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
