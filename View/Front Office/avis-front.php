<?php
// Fetch available subjects from the database
require_once '../../config.php'; // Include the database connection
require_once '../../Controller/AvisC.php';
require_once '../../Model/Comment.php';

$pdo = Config::getConnexion(); 


// Check for success flag in URL
$success = isset($_GET['success']) && $_GET['success'] == 1 ? true : false;

// Fetch available subjects from the database
$query = "SELECT * FROM subjects";
$subjectsResult = $pdo->query($query);

$avisC = new avisC();  // Use the avisC controller

// Get the selected subject from the URL parameter (if any)
$subjectFilter = isset($_GET['subject']) ? $_GET['subject'] : '';

// Get all avis, optionally filtered by subject


// Check if avis form data is set and process form submission
if (isset($_POST["subject"]) && $_POST["nom"] && $_POST["prenom"] && $_POST["email"] && $_POST["description"]) {
    if (!empty($_POST["subject"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["description"])) {
        $avis = new avis(
            null,
            $_POST['subject'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['description']
        );

        $avisC->addAvis($avis);
    } else {
        $error = "Missing information";  // If any required fields are missing
    }
}
// Fetch comments for a given avis
function getComments($avis_id) {
    global $pdo;
    $query = "SELECT * FROM comments WHERE avis_id = :avis_id ORDER BY date_post DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['avis_id' => $avis_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$avisList = $avisC->getAllAvis($subjectFilter); // Assuming `getAllAvis` can take an optional subject parameter
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="css/stylefront.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <img src="assets/images/log.png" alt="Logo" class="logo">
            </div>
            <ul class="menu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="event-front.php">Événements</a></li>
                <li><a href="#boutique">Boutique</a></li>
                <li><a href="avis-front.php">Forum</a></li>
                <li><a href="index.php#pricing">Réclamations</a></li>
            </ul>
            <div class="nav-right">
                <button class="login-btn">Se connecter</button>
            </div>
        </nav>
    </header>

    <main>
    <section class="events-section">
    <div class="container-fluid service pb-5">
        <div class="container pb-5">
            <div class="row g-4">
                <form id="avisForm" action="submit_avis.php" method="POST" class="review-form" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <select id="subject" name="subject" >
                            <option value="" disabled selected>Choisissez un sujet</option>
                            <?php
                            // Loop through the subjects and populate the dropdown
                            while ($subject = $subjectsResult->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$subject['id']}'>{$subject['name']}</option>";
                            }
                            ?>
                        </select>
                        <span id="subjectError" class="error-message"></span> <!-- Error message for subject -->
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Votre nom" >
                        <span id="nomError" class="error-message"></span> <!-- Error message -->
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Votre Prenom" >
                        <span id="prenomError" class="error-message"></span> <!-- Error message -->
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Votre email" >
                        <span id="emailError" class="error-message"></span> <!-- Error message -->
                    </div>
                    <div class="form-group">
                        <label for="review">Description</label>
                        <textarea id="review" name="description" rows="5" placeholder="Donnez votre avis ici..." ></textarea>
                        <span id="descriptionError" class="error-message"></span> <!-- Error message -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Display Reviews (Avis) -->
<section class="filter-section">
    <form method="GET" action="avis-front.php">
    <select name="subject" id="subjectFilter">
    <option value="">Tous les sujets</option>
    <?php
    $stmt = $pdo->query("SELECT * FROM subjects");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected = ($row['name'] == $subjectFilter) ? 'selected' : '';
        echo "<option value='{$row['name']}' $selected>{$row['name']}</option>";
    }
    ?>
</select>

        <button type="submit">Filtrer</button>
    </form>
</section>

        

            <!-- Display the reviews -->
<?php foreach ($avisList as $avis): ?>
    <div class="avis-item">
        <h3><?php echo $avis['Nom'] . ' ' . $avis['Prenom']; ?> - <?php echo $avis['Datepost']; ?></h3>
        <p><strong>Sujet:</strong> <?php echo $avis['Subject']; ?></p>
        <p><strong>Description:</strong> <?php echo $avis['Description']; ?></p>

        <!-- Display Comments -->
        <div class="comments-section">
            <h4>Commentaires:</h4>
            <?php
            $comments = getComments($avis['Idavis']);
            foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?php echo $comment['nom'] . ' ' . $comment['prenom']; ?></strong> - <?php echo $comment['date_post']; ?></p>
                    <p><?php echo $comment['comment']; ?></p>
                </div>
            <?php endforeach; ?>

            <!-- Comment Form -->
            <form action="submit_comment.php" method="POST">
                <input type="hidden" name="avis_id" value="<?php echo $avis['Idavis']; ?>">
                <input type="text" name="nom" placeholder="Votre nom" required>
                <input type="text" name="prenom" placeholder="Votre prenom" required>
                <textarea name="comment" placeholder="Votre commentaire..." required></textarea>
                <button type="submit">Ajouter Commentaire</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
    </main>
    <script>
    // Function to validate the form fields
    function validateForm() {
        let isValid = true;

        // Clear previous error messages
        document.getElementById('nomError').textContent = '';
        document.getElementById('prenomError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('descriptionError').textContent = '';
        document.getElementById('subjectError').textContent = '';

        // Subject validation: Must not be the default option "Choisissez un sujet"
        const subject = document.getElementById('subject').value;
        if (subject === "") {
            document.getElementById('subjectError').textContent = 'Please select a subject.';
            isValid = false;
        }

        // Nom validation: Only letters and 1-50 characters
        const nom = document.getElementById('nom').value;
        const nomPattern = /^[A-Za-z]+$/;
        if (!nomPattern.test(nom) || nom.length < 1 || nom.length > 50) {
            document.getElementById('nomError').textContent = 'Nom must contain only letters and be between 1 and 50 characters.';
            isValid = false;
        }

        // Prenom validation: Only letters and 1-50 characters
        const prenom = document.getElementById('prenom').value;
        if (!nomPattern.test(prenom) || prenom.length < 1 || prenom.length > 50) {
            document.getElementById('prenomError').textContent = 'Prenom must contain only letters and be between 1 and 50 characters.';
            isValid = false;
        }

        // Email validation: Must be a valid email format
        const email = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailError').textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        // Description validation: Must be more than 1 character
        const description = document.getElementById('review').value;
        if (description.length < 1) {
            document.getElementById('descriptionError').textContent = 'Description must be Filled.';
            isValid = false;
        }

        return isValid;  // Return false to prevent form submission if validation fails
    }
</script>
<style>

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}
</style>
    <script>
        // Show SweetAlert if success is true
        <?php if ($success): ?>
            Swal.fire({
                icon: 'success',
                title: 'Votre avis a été ajouté avec succès!',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    </script>
</body>
</html>
