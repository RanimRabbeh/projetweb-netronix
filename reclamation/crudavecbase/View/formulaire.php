<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Réclamation</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="View/css/formcss.css"> 
</head>
<body>
    <div class="form-container">
        <form method="POST" action="index.php?action=add" onsubmit="return validerFormulaire()">
            <div class="form-group">
                <label for="idUtilisateur">ID Utilisateur :</label>
                <input type="number" name="idUtilisateur" id="idUtilisateur" required>
            </div>

            <div class="form-group">
                <label for="date">Date de la Réclamation :</label>
                <input type="date" name="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="type">Type de Réclamation :</label>
                <select name="type" id="type" required>
                <option value="billet">Problème de billetterie</option>
                <option value="evenement">Problème lié à l'événement</option>
                <option value="acces">Problème avec l'accès ou l'entrée</option>
                <option value="service">Problème de qualité du service</option>
                <option value="communication">Problème avec la communication</option>
                <option value="remboursement">Problème de remboursement</option>
                <option value="technique">Problème technique avec le site</option>
                <option value="autre">Autre réclamation</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
    <label for="pieces">Pièces Jointes :</label>
    <input type="file" name="pieces" id="pieces" accept="image/*, .pdf">
</div>


            <div class="form-group">
                <label for="contact">Contact :</label>
                <input type="text" name="contact" id="contact" required>
            </div>

            <div class="form-group">
                <label for="etat">État :</label>
                <select name="etat" id="etat" required>
                    <option value="En attente">En attente</option>
                    <option value="En cours">En cours</option>
                    <option value="Résolue">Résolue</option>
                </select>
            </div>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
<script>
    function validerFormulaire() {
        const utilisateurId = document.getElementById("idUtilisateur").value.trim();
        const dateReclamation = document.getElementById("date").value;
        const type = document.getElementById("type").value;
        const description = document.getElementById("description").value.trim();
        const contact = document.getElementById("contact").value.trim();

        // Validation de l'identifiant
        if (utilisateurId === "") {
            alert("Veuillez entrer votre identifiant.");
            return false;
        }

        // Validation de la date
        if (dateReclamation === "") {
            alert("Veuillez sélectionner une date.");
            return false;
        }

        // Validation du type de réclamation
        if (type === "") {
            alert("Veuillez sélectionner un type de réclamation.");
            return false;
        }

        // Validation de la description
        if (description === "") {
            alert("Veuillez fournir une description pour votre réclamation.");
            return false;
        }

        // Validation du contact
        if (contact === "") {
            alert("Veuillez entrer votre contact (email ou téléphone).");
            return false;
        } else if (!/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,4}$/.test(contact) && !/^\+?\d+$/.test(contact)) {
            alert("Veuillez entrer un email ou numéro de téléphone valide.");
            return false;
        }

        // Si tout est valide
        alert("Votre réclamation a été envoyée avec succès !");
        return true;
    }
</script>