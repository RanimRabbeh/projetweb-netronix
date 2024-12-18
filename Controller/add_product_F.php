<?php
// Démarrer la session
session_start();

// Simuler un utilisateur connecté pour les tests (remplacer avec un ID utilisateur valide)
$_SESSION['userId'] = 1; // Par exemple, l'ID d'un utilisateur fictif dans la base de données

// Activer les messages d'erreur
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le contrôleur du produit
require_once 'ProductController_F.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prix = isset($_POST['prix']) ? floatval($_POST['prix']) : 0;
    $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 0;
    $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;

    // Vérifier que tous les champs sont remplis
    if (empty($nom) || $prix <= 0 || $quantite <= 0 || !$photo) {
        echo "Tous les champs sont requis. Veuillez vérifier vos informations.";
        exit;
    }

    // Récupérer l'ID de l'utilisateur depuis la session
    $idUtilisateur = $_SESSION['userId'];

    // Vérifier si un fichier a été téléchargé
    if ($photo['error'] == UPLOAD_ERR_OK) {
        // Vérifier si le fichier est une image
        $check = getimagesize($photo["tmp_name"]);
        if ($check !== false) {
            // Le fichier est une image

            // Lire le contenu du fichier dans une variable
            $photoData = file_get_contents($photo["tmp_name"]);

            // Créer le produit et passer les données (photo binaire et ID de l'utilisateur)
            $product = new Product($nom, $prix, $quantite, $photoData, $idUtilisateur);

            // Ajouter le produit à la base de données via le contrôleur
            $productController = new ProductController();
            if ($productController->addProduct($product)) {
                // Rediriger vers la page de vue des produits après l'ajout du produit
                header('Location: ../view/Front Office/view.php');
                exit();
            } else {
                echo "Erreur lors de l'ajout du produit.";
            }
        } else {
            echo "Le fichier n'est pas une image.";
        }
    } else {
        echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Ajouter un produit</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom du produit</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prix">Prix (en TND)</label>
                <input type="number" id="prix" name="prix" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" id="quantite" name="quantite" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo du produit</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>

            <div class="form-group">
                <button type="submit">Ajouter le produit</button>
            </div>
        </form>
    </div>

</body>
</html>
