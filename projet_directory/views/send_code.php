<?php
// Connexion à la base de données (utilisez PDO)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cultivio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => 'Erreur de connexion à la base de données.']));
}

// Vérification de l'email dans la requête POST
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Vérification si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Générer un code aléatoire
        $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

        // Mettre à jour le code dans la base de données
        $stmt = $pdo->prepare("UPDATE utilisateurs SET code = :code WHERE email = :email");
        $stmt->execute(['code' => $code, 'email' => $email]);

        // Envoyer le code par email
        mail($email, "Code de réinitialisation", "Votre code de réinitialisation est : $code");

        // Répondre avec succès
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Adresse email introuvable."]);
    }
    exit;
}

// Si aucun email n'est fourni
echo json_encode(['status' => 'error', 'message' => 'Aucun email fourni.']);
?>
