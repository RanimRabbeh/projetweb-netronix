<?php
require_once '../../Model/SolutionReclamationModel.php';
require_once '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class SolutionReclamationController {
    private $model;

    public function __construct() {
        $this->model = new SolutionReclamationModel();
    }

    // Afficher toutes les solutions
    public function index() {
        try {
            $solutions = $this->model->getAllSolutions();
            return $solutions;
        } catch (Exception $e) {
            echo "Erreur dans index() : " . $e->getMessage();
            return [];
        }
    }
    public function addSolution($idReclamation, $idAdmin, $solution) {
        // Insérer la solution dans la base de données
        $this->model->insertSolution($idReclamation, $idAdmin, $solution);
    
        // Obtenez l'email de l'utilisateur associé à cette solution
        $userEmail = $this->model->getUserEmailBySolutionId($idReclamation);
    
        if ($userEmail) {
            // Envoyer un e-mail à l'utilisateur pour l'informer de la solution
            $this->sendSolutionEmail($userEmail, $solution);
            
        }
        header("Location: ../../index.html"); 
        exit;
    }
    
    private function sendSolutionEmail($toEmail, $solution) {
        $mail = new PHPMailer(true);
    
        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'aymenmbarek305@gmail.com'; // Votre adresse email
            $mail->Password = 'utew zifb binf ddja'; // Votre mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
          
            
    
            // Configurer l'expéditeur et le destinataire
            $mail->setFrom('aymenmbarek305@gmail.com', 'Service Reclamations');
            $mail->addAddress($toEmail);  // Adresse de l'utilisateur
    
            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Solution à votre reclamation';
            $mail->Body = "
                Bonjour,<br><br>
                Votre réclamation a reçu une réponse.<br>
                <strong>Solution proposée :</strong><br>
                $solution<br><br>
                Merci,<br>
                L'équipe support.
            ";
    
            // Envoyer l'e-mail
            $mail->send();
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    }
    
    
   
}
?>
