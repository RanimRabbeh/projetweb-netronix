<?php
 include '../Controller/EvenementsC.php';


 $error = "";

 $event= null;
 $EvenementsC = new EvenementsC();

 if (
    isset($_POST["Nomevenement"])  && $_POST["Lieuevenement"] && $_POST["Dateevenement"]  && $_POST["Prixbillet"] 
) {
    if (
        !empty($_POST["Nomevenement"])  && !empty($_POST["Lieuevenement"])  && !empty($_POST["Dateevenement"]) && !empty($_POST["Prixbillet"])
        ) {
            $event = new Evenements(
                null,
                $_POST['Nomevenement'],
                $_POST['Lieuevenement'],
                $_POST['Dateevenement'],
                $_POST['Prixbillet'],
                null,
            );
            //
                
            $EvenementsC->addEvent($event);
    
           
        } else
            $error = "Missing information";
    }
    $events = $EvenementsC->getAllEvents();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Événements</title>
    <link rel="stylesheet" href="event-back.css">
</head>
<body>

    <header>
        <h1>Gestion des Événements</h1>
    </header>

    <div class="container">
        <section>
            <h2>Créer un Nouvel Événement</h2>
            <form id="addEventForm" method="Post" action="">
                <div class="form-group">
                    <label for="event-name">Nom de l'Événement :</label>
                    <input type="text" id="event-name" name='Nomevenement' class="input-field" placeholder="Exemple : Musée du Louvre" required>
                </div>
                <div class="form-group">
                    <label for="event-location">Lieu :</label>
                    <input type="text" id="event-location" name='Lieuevenement' class="input-field" placeholder="Exemple : Paris, France" required>
                </div>
                <div class="form-group">
                    <label for="event-date">Date :</label>
                    <input type="date" id="event-date" name='Dateevenement' class="input-field" required>
                </div>
                <div class="form-group">
                    <label for="event-price">Prix du Billet (€) :</label>
                    <input type="number" id="event-price" name='Prixbillet' class="input-field" placeholder="Prix en euros" required>
                </div>
                
                <button type="submit">Créer l'Événement</button>
            </form>
        </section>

        <!-- Tableau pour Gérer les Événements -->
        <section>
            <h2>Gérer les Événements</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom de l'Événement</th>
                            <th>Lieu</th>
                            <th>Date</th>
                            <th>Prix (€)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Loop through each event and display it in a table row
                        foreach ($events as $event) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($event['Nomevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Lieuevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Dateevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Prixbillet']) . "</td>";
                            echo "<td>";
                            echo "<button class='modify-btn' data-id='" . $event['Idevenement'] . "'>Modifier</button>";
                            echo "<button class='delete-btn' data-id='" . $event['Idevenement'] . "'>Supprimer</button>";
                            echo "<td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script>
        // Fonction pour activer les champs d'un événement (Modifier)
        document.querySelectorAll('.modify-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let row = this.closest('tr');
                let inputs = row.querySelectorAll('input');
                // Activer les champs de saisie
                inputs.forEach(input => input.disabled = false);
                // Afficher le bouton Enregistrer et masquer le bouton Modifier
                row.querySelector('.save-btn').style.display = 'inline-block';
                this.style.display = 'none';
            });
        });

        // Fonction pour enregistrer les modifications
        document.querySelectorAll('.save-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let row = this.closest('tr');
                let inputs = row.querySelectorAll('input');
                // Désactiver les champs après l'enregistrement
                inputs.forEach(input => input.disabled = true);
                // Masquer le bouton Enregistrer et afficher le bouton Modifier
                row.querySelector('.modify-btn').style.display = 'inline-block';
                this.style.display = 'none';
            });
        });

        // Fonction pour supprimer un événement
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm("Êtes-vous sûr de vouloir supprimer cet événement ?")) {
                    let row = this.closest('tr');
                    row.remove(); // Supprimer la ligne de l'événement
                }
            });
        });
    </script>

</body>
</html>
