<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des réclamations</title>
    <link rel="stylesheet" href="View/css/listcss.css"> 
</head>
<body>
   

    <!-- Conteneur de la liste des réclamations -->
    <div class="container">
        <h1>Liste des réclamations</h1>
        <a href="index.php?action=add" class="add-link">Ajouter une Réclamation</a>

        <!-- Tableau des réclamations -->
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
                <?php foreach ($reclamations as $reclamation): ?> <!-- parcourir tt les reclamation une par une -->
                    <tr>
                        <td><?= $reclamation['IdReclamation'] ?></td>
                        <td><?= $reclamation['DateDeLaReclamation'] ?></td>
                        <td><?= $reclamation['TypeDeReclamation'] ?></td>
                        <td><?= $reclamation['DescriptionDeLaReclamation'] ?></td>
                        <td>
                            <?php if (!empty($reclamation['PiecesJointes'])): ?>
                                <a href="<?= $reclamation['PiecesJointes'] ?>" target="_blank">Voir le document</a>
                            <?php else: ?>
                                Aucun document
                            <?php endif; ?>
                        </td>
                        <td><?= $reclamation['Contact'] ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $reclamation['IdReclamation'] ?>">Modifier</a>
                            <a href="index.php?action=delete&id=<?= $reclamation['IdReclamation'] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
