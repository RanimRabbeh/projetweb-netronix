<?php
require_once '../includes/database.php'; // Connexion à la base de données

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $id = $input['id'] ?? null;
    $name = $input['name'] ?? null;
    $email = $input['email'] ?? null;
    $accessToken = $input['accessToken'] ?? null;

    if ($id && $email) {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            // Créer un nouvel utilisateur
            $stmt = $db->prepare("INSERT INTO utilisateurs (name, email, facebook_id) VALUES (:name, :email, :facebook_id)");
            $stmt->execute(['name' => $name, 'email' => $email, 'facebook_id' => $id]);
        }

        // Connecter l'utilisateur
        session_start();
        $_SESSION['user_id'] = $id; // Ou autre identifiant unique

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Données invalides.']);
    }
} else {
    http_response_code(405); // Méthode non autorisée
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}
?>
