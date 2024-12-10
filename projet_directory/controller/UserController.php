<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php'; // Inclure PHPMailer via Composer

class UserController {
    private $db;
    private $model;

    // Initialisation de la connexion à la base de données et du modèle
    public function __construct($db) {
        $this->db = $db;
        $this->model = new UserModel($db); // Passer l'objet $db à UserModel
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail($email) {
        try {
            return $this->model->getUserByEmail($email);
        } catch (Exception $e) {
            error_log("Erreur dans getUserByEmail: " . $e->getMessage());
            return false;
        }
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($userId) {
        try {
            return $this->model->getUserById($userId);
        } catch (Exception $e) {
            error_log("Erreur dans getUserById: " . $e->getMessage());
            return false;
        }
    }

    // Envoi du code de réinitialisation par email
    public function sendResetCode($email) {
        if (!$this->model->emailExists($email)) {
            return "Cet email n'est pas enregistré.";
        }

        try {
            $resetCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Générer un code à 6 chiffres
            if (!$this->model->saveResetCode($email, $resetCode)) {
                return "Erreur lors de la génération du code.";
            }

            // Envoi de l'email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nourboua20@gmail.com'; // Remplacez par votre email
            $mail->Password   = 'ordf uusw flzv ttvm';  // Remplacez par votre mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('nourboua20@gmail.com', 'Support');
            $mail->addAddress($email);
            $mail->Subject = "Code de réinitialisation du mot de passe";
            $mail->Body    = "Votre code de réinitialisation est : $resetCode";

            $mail->send();
            return "Un code de réinitialisation a été envoyé à votre adresse e-mail.";
        } catch (Exception $e) {
            error_log("Erreur dans sendResetCode: " . $mail->ErrorInfo);
            return "Erreur lors de l'envoi de l'e-mail. Veuillez réessayer plus tard.";
        }
    }

    // Réinitialisation du mot de passe
    public function resetPassword($email, $code, $newPassword) {
        try {
            $savedCode = $this->model->getResetCodeByEmail($email);
            if ($savedCode && $savedCode === $code) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                if ($this->model->updatePassword($email, $hashedPassword)) {
                    return "Mot de passe réinitialisé avec succès.";
                }
                return "Erreur lors de la réinitialisation du mot de passe.";
            }
            return "Code de vérification invalide ou expiré.";
        } catch (Exception $e) {
            error_log("Erreur dans resetPassword: " . $e->getMessage());
            return "Erreur interne, veuillez réessayer plus tard.";
        }
    }

    // Connexion de l'utilisateur
    public function login($email, $password) {
        try {
            $user = $this->model->getUserByEmail($email);
            if ($user && password_verify($password, $user['Mdp'])) {
                session_start();  // Démarrer la session
                session_regenerate_id(true);  // Régénérer l'ID de session pour des raisons de sécurité
                $_SESSION['user_id'] = $user['IdUtilisateur'];
                $_SESSION['user_name'] = $user['Nom'];
                $_SESSION['user_email'] = $user['Email'];
                header("Location: profile.php");  // Redirection vers le profil
                exit;
            }
            return "Email ou mot de passe incorrect.";
        } catch (Exception $e) {
            error_log("Erreur dans login: " . $e->getMessage());
            return "Erreur interne, veuillez réessayer plus tard.";
        }
    }

    // Inscription d'un nouvel utilisateur
    public function register($name, $email, $password) {
        try {
            if ($this->model->emailExists($email)) {
                return "Cet email est déjà utilisé.";
            }
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);  // Hacher le mot de passe avant de l'enregistrer
            return $this->model->insertUser($name, $email, $hashedPassword);
        } catch (Exception $e) {
            error_log("Erreur dans register: " . $e->getMessage());
            return "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_unset();  // Supprimer toutes les variables de session
        session_destroy();  // Détruire la session
        return "Déconnexion réussie.";
    }

    // Mise à jour du profil de l'utilisateur
    public function updateProfile($userId, $name, $email) {
        try {
            return $this->model->updateUserProfile($userId, $name, $email);
        } catch (Exception $e) {
            error_log("Erreur dans updateProfile: " . $e->getMessage());
            return "Erreur lors de la mise à jour du profil.";
        }
    }
}
?>
