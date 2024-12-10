<?php
session_start();

// Inclure la classe Database pour établir la connexion à la base de données
require_once 'includes/database.php'; // Assurez-vous que le chemin est correct
require_once 'controller/UserController.php'; // Assurez-vous que le chemin est correct

// GitHub OAuth credentials
$clientId = 'Ov23liEdQ7qkXTArJ4Qy';
$clientSecret = '655bc7b3c2e68a1853a13f7c1a972d19b8c2854e';
$redirectUri = 'http://localhost/projet_directory/github-callback.php';

function console_log($data) {
    echo "<script>console.log(" . json_encode($data) . ");</script>";
}

try {
    // Assurez-vous que la connexion à la base de données est bien établie
    $database = new Database();
    $db = $database->getConnection();
    if (!$db) {
        throw new Exception("Erreur de connexion à la base de données.");
    }

    // Vérifiez si le code d'autorisation est dans l'URL
    if (!empty($_GET['code'])) {
        $code = htmlspecialchars($_GET['code']);
        console_log("Authorization code: " . $code);

        // Échangez le code d'autorisation contre un token d'accès
        $url = 'https://github.com/login/oauth/access_token';
        $postData = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'redirect_uri' => $redirectUri
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
        console_log($responseData);

        // Si un token d'accès est récupéré
        if (isset($responseData['access_token'])) {
            $accessToken = $responseData['access_token'];

            // Récupérer les informations de l'utilisateur depuis GitHub
            $url = 'https://api.github.com/user';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'User-Agent: MyApp'
            ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $githubUser = json_decode($response, true);
            console_log($githubUser);

            // Vérifiez si l'utilisateur GitHub est valide
            if (isset($githubUser['id'])) {
                $userController = new UserController($db); // Assurez-vous que $db est passé correctement

                // Utilisation du nom GitHub ou du login comme nom d'utilisateur
                $name = $githubUser['name'] ?? $githubUser['login'];
                $email = $githubUser['email'] ?? $githubUser['login'] . '@github.com'; // Utilisez un email générique si non fourni

                // Vérifiez si l'utilisateur existe déjà dans la base de données
                $existingUser = $userController->getUserByEmail($email);
                console_log($existingUser ? "User exists in DB" : "User does not exist, registering...");

                if (!$existingUser) {
                    // Si l'utilisateur n'existe pas, enregistrez-le
                    $userController->register($name, $email, null);
                }

                // Récupérez les informations de l'utilisateur après l'enregistrement
                $user = $userController->getUserByEmail($email);
                console_log($user);

                if ($user) {
                    // Créez une nouvelle session et stockez les informations de l'utilisateur
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['IdUtilisateur'];
                    $_SESSION['user_name'] = $user['Nom'];
                    $_SESSION['user_email'] = $user['Email'];
                    console_log($_SESSION);
                } else {
                    throw new Exception("Failed to fetch user from the database.");
                }

                // Redirigez l'utilisateur vers la page de profil après une connexion réussie
                header("Location: ./views/profile.php");
                exit;
            } else {
                throw new Exception("Error fetching user details from GitHub.");
            }
        } else {
            throw new Exception("Error retrieving access token from GitHub.");
        }
    } else {
        throw new Exception("Authorization code not found.");
    }
} catch (Exception $e) {
    console_log("Error: " . $e->getMessage());
    error_log($e->getMessage());
    echo "An error occurred during GitHub login. Please try again later.";
}
?>
