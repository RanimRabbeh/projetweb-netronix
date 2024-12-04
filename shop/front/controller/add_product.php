<?php
require_once 'ProductController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $photo = $_FILES['photo']; // Get the uploaded photo

    // Check if a file was uploaded
    if ($photo['error'] == UPLOAD_ERR_OK) {
        // Check if the file is an image
        $check = getimagesize($photo["tmp_name"]);
        if ($check !== false) {
            // File is an image

            // Read the file content into a variable
            $photoData = file_get_contents($photo["tmp_name"]);

            // Create the product and pass the photo binary data
            $product = new Product($nom, $prix, $quantite, $photoData);

            // Add the product to the database using the controller
            $productController = new ProductController();
            $productController->addProduct($product);

            // Redirect to the product view page after adding the product
            header('Location: ../view/view.php');
            exit();
        } else {
            echo "Le fichier n'est pas une image.";
        }
    } else {
        echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
    }
}
?>
