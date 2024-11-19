<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Réclamation</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="View/css/formcss.css"> 
</head>
<body>
    <div class="form-container">  
        <h1>Modifier une Réclamation</h1>    <!-- n3aytou l formulaire m3bya -->

        <form method="POST" action="index.php?action=edit&id=<?= $reclamation['IdReclamation'] ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="idUtilisateur">ID Utilisateur :</label>
                <input type="number" name="idUtilisateur" id="idUtilisateur" value="<?= $reclamation['IdUtilisateur'] ?>" required>
            </div>

            <div class="form-group">
                <label for="date">Date de la Réclamation :</label>
                <input type="date" name="date" id="date" value="<?= $reclamation['DateDeLaReclamation'] ?>" required>
            </div>

            <div class="form-group">
                <label for="type">Type de Réclamation :</label>
                <select name="type" id="type" required>
                    <option value="Problème de billetterie" <?= $reclamation['TypeDeReclamation'] === "Problème de billetterie" ? 'selected' : '' ?>>Problème de billetterie</option>
                    <option value="Problème lié à l'événement" <?= $reclamation['TypeDeReclamation'] === "Problème lié à l'événement" ? 'selected' : '' ?>>Problème lié à l'événement</option>
                    <option value="Problème avec l'accès ou l'entrée" <?= $reclamation['TypeDeReclamation'] === "Problème avec l'accès ou l'entrée" ? 'selected' : '' ?>>Problème avec l'accès ou l'entrée</option>
                    <option value="Problème de qualité du service" <?= $reclamation['TypeDeReclamation'] === "Problème de qualité du service" ? 'selected' : '' ?>>Problème de qualité du service</option>
                    <option value="Problème avec la communication" <?= $reclamation['TypeDeReclamation'] === "Problème avec la communication" ? 'selected' : '' ?>>Problème avec la communication</option>
                    <option value="Problème de remboursement" <?= $reclamation['TypeDeReclamation'] === "Problème de remboursement" ? 'selected' : '' ?>>Problème de remboursement</option>
                    <option value="Problème technique avec le site" <?= $reclamation['TypeDeReclamation'] === "Problème technique avec le site" ? 'selected' : '' ?>>Problème technique avec le site</option>
                    <option value="Autre réclamation" <?= $reclamation['TypeDeReclamation'] === "Autre réclamation" ? 'selected' : '' ?>>Autre réclamation</option>

                </select>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" required><?= $reclamation['DescriptionDeLaReclamation'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="pieces">Pièces Jointes :</label>
                <input type="file" name="pieces" id="pieces" value="<?= $reclamation['PiecesJointes'] ?>" accept="image/*, .pdf">
            </div>

            <div class="form-group">
                <label for="contact">Contact :</label>
                <input type="text" name="contact" id="contact" value="<?= $reclamation['Contact'] ?>" required>
            </div>

            <div class="form-group">
                <label for="etat">État :</label>
                <select name="etat" id="etat" required>
                    <option value="En attente" <?= $reclamation['Etat'] === "En attente" ? 'selected' : '' ?>>En attente</option>
                    <option value="En cours" <?= $reclamation['Etat'] === "En cours" ? 'selected' : '' ?>>En cours</option>
                    <option value="Résolue" <?= $reclamation['Etat'] === "Résolue" ? 'selected' : '' ?>>Résolue</option>
                </select>
            </div>

            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>
