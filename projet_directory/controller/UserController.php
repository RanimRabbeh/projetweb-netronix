<?php
require_once '../models/UserModel.php';
require_once '../includes/database.php';

class UserController {
    private $model;

    public function __construct() {
        global $db; // Connexion à la base de données
        $this->model = new UserModel($db);
    }

    // Fonction de connexion
    public function login($email, $password) {
        $user = $this->model->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['Mdp'])) {
                session_start();
                $_SESSION['user_id'] = $user['IdUtilisateur'];
                $_SESSION['user_name'] = $user['Nom'];
                return "Connexion réussie !";
            }
            return "Mot de passe incorrect.";
        }
        return "Email introuvable.";
    }

    // Fonction d'inscription
    public function register($name, $email, $password) {
        if ($this->model->emailExists($email)) {
            return "Cet email est déjà utilisé.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        if ($this->model->insertUser($name, $email, $hashedPassword)) {
            return "Inscription réussie !";
        }
        return "Erreur lors de l'inscription.";
    }

    // Envoi d'un code de réinitialisation
    public function sendResetCode($email) {
        if ($this->model->emailExists($email)) {
            $resetCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Code à 6 chiffres
            if ($this->model->saveResetCode($email, $resetCode)) {
                // Envoi du code par email
                mail($email, "Code de réinitialisation", "Votre code est : $resetCode");
                return "Un code de réinitialisation a été envoyé à votre email.";
            }
            return "Erreur lors de la génération du code.";
        }
        return "Cet email n'est pas enregistré.";
    }

    // Réinitialisation du mot de passe
    public function resetPassword($email, $code, $newPassword) {
        $savedCode = $this->model->getResetCodeByEmail($email);
        if ($savedCode && $savedCode === $code) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            if ($this->model->updatePassword($email, $hashedPassword)) {
                return "Mot de passe réinitialisé avec succès.";
            }
            return "Erreur lors de la réinitialisation du mot de passe.";
        }
        return "Code de réinitialisation invalide ou expiré.";
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return "Déconnexion réussie.";
    }
}
?>
