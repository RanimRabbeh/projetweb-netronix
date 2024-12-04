<?php
require_once '../../Controller/ReclamationController.php';
session_start(); // Démarre la session pour accéder à $_SESSION['admin']

// Initialisation du contrôleur
$controller = new ReclamationController();

// Récupération des réclamations via le contrôleur
$reclamations = $controller->getReclamations();
// Récupération du nombre de réclamations par type
$reclamationsByType = $controller->getReclamationsCountByType();
// Récupération du type de réclamation le plus fréquent et son pourcentage
$mostCommonTypeInfo = $controller->getMostCommonReclamationTypeAndPercentage();
// Récupération du nombre de réclamations traitées et non traitées
$reclamationsByEtat = $controller->getReclamationsCountByEtat();

// Initialisation des variables
$traitées = 0;
$nonTraitées = 0;

foreach ($reclamationsByEtat as $etat) {
    if ($etat['Etat'] === 'traité') {
        $traitées = $etat['count'];
    } elseif ($etat['Etat'] === 'non traité') {
        $nonTraitées = $etat['count'];
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="listcss.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des réclamations</title>
</head>
<style>
.main-container {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Réduit l'espace entre les sections */
    max-width: 800px; /* Réduit encore la largeur totale */
    margin: 0 auto; /* Centre toujours le contenu */
}

.top-stats {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px; /* Réduit l'espacement entre les éléments */
}

.stats-most-container,
.stats-container,
.stats-reclamations {
    flex: 1;
    min-width: 200px;
    max-width: 250px; /* Diminue encore la largeur maximale */
    padding: 10px; /* Réduit les marges internes */
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center; /* Centre le texte */
}

.list-reclamations {
    padding: 10px; /* Réduit le padding interne */
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    max-width: 800px; /* Réduit également la taille maximale */
    margin: 0 auto; /* Centre toujours la liste */
}



</style>
<body>
<div class="main-container">
    <div class="top-stats">
        <!-- Statistique du type de réclamation le plus fréquent -->
        <div class="stats-most-container">
            <h2>Statistiques du type de réclamation le plus fréquent</h2>
            <div class="statistic-badge">
               
                <div class="badge-details">
                    <span class="badge-type"><?= htmlspecialchars($mostCommonTypeInfo['type']) ?></span>
                    <span class="badge-count"><?= htmlspecialchars($mostCommonTypeInfo['count']) ?> réclamations</span>
                    <span class="badge-percentage"><?= number_format($mostCommonTypeInfo['percentage'], 2) ?>%</span>
                    <span class="badge-status"><?= htmlspecialchars($mostCommonTypeInfo['status']) ?></span>
                </div>
            </div>
        </div>

        <!-- Statistiques des réclamations -->
        <div class="stats-container">
            <h2>Statistiques des réclamations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Type de Réclamation</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reclamationsByType as $type): ?>
                        <tr>
                            <td><?= htmlspecialchars($type['TypeDeReclamation']) ?></td>
                            <td><?= htmlspecialchars($type['count']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Réclamations traitées / non traitées -->
        <div class="stats-reclamations">
            <h2>Statut des réclamations</h2>
            <p>Réclamations traitées : <strong><?= $traitées ?></strong></p>
            <p>Réclamations non traitées : <strong><?= $nonTraitées ?></strong></p>
        </div>
    </div>

    
</div>


   
    <div class="container">
        <h1>Liste des réclamations</h1>
        <table>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Date de la réclamation</th>
                    <th>Type de la réclamation</th>
                    <th>Description de la réclamation</th>
                    <th>Pièces Jointes</th>
                    <th>Email ou téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reclamations as $reclamation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reclamation['IdReclamation']) ?></td>
                        <td><?= htmlspecialchars($reclamation['DateDeLaReclamation']) ?></td>
                        <td><?= htmlspecialchars($reclamation['TypeDeReclamation']) ?></td>
                        <td><?= htmlspecialchars($reclamation['DescriptionDeLaReclamation']) ?></td>
                        <td>
                            <?php if (!empty($reclamation['PiecesJointes'])): ?>
                                <a href="<?= htmlspecialchars($reclamation['PiecesJointes']) ?>" target="_blank">Voir le document</a>
                            <?php else: ?>
                                Aucun document
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($reclamation['Contact']) ?></td>
                        <td>
                                <!-- Bouton Ajouter Solution -->
                            <a href="/backz/Views/solution/add.php?idreclamation=<?= htmlspecialchars($reclamation['IdReclamation']) ?>&idadmin=<?= $_SESSION['admin'] ?>">Ajouter Solution</a>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
