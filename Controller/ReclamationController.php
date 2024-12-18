<?php
require_once('../../config.php'); 
require_once('../../Model/Reclamation.php');
require_once('../../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ReclamationController
{
    // Ajouter une nouvelle réclamation dans la base de données
    public function addReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamations (IdUtilisateur, DateDeLaReclamation, TypeDeReclamation, 
                DescriptionDeLaReclamation, PiecesJointes, Contact, Etat) 
                VALUES (:IdUtilisateur, :DateDeLaReclamation, :TypeDeReclamation, 
                :DescriptionDeLaReclamation, :PiecesJointes, :Contact, :Etat)";
        
        $db = Config::getConnexion(); // Utilise la classe Config pour obtenir la connexion
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'IdUtilisateur' => $reclamation->getIdUtilisateur(),
                'DateDeLaReclamation' => $reclamation->getDateDeLaReclamation(),
                'TypeDeReclamation' => $reclamation->getTypeDeReclamation(),
                'DescriptionDeLaReclamation' => $reclamation->getDescriptionDeLaReclamation(),
                'PiecesJointes' => $reclamation->getPiecesJointes(),
                'Contact' => $reclamation->getContact(),
                'Etat' => $reclamation->getEtat()
            ]);

            // Si la réclamation a été ajoutée avec succès, envoyer l'email de confirmation
            $this->sendConfirmationEmail(
                $reclamation->getTypeDeReclamation(),
                $reclamation->getIdUtilisateur(),
                $reclamation->getDescriptionDeLaReclamation()
            );

            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Fonction d'envoi d'email
    private function sendConfirmationEmail($typeReclamation, $idUtilisateur, $description)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'aymenmbarek305@gmail.com'; 
            $mail->Password = 'utew zifb binf ddja'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Options SSL
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            // Configurer l'expéditeur et le destinataire
            $mail->setFrom('aymenmbarek305@gmail.com', 'Service Reclamations');
            $mail->addAddress('cultivio76@gmail.com');  // Adresse du destinataire

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Soumission de nouvelle reclamation';
            $mail->Body = "
                Bonjour,<br><br>
                Nous avons reçu une nouvelle réclamation avec les détails suivants :<br>
                <ul>
                    <li><strong>Type de Réclamation :</strong> $typeReclamation</li>
                    <li><strong>Utilisateur ID :</strong> $idUtilisateur</li>
                    <li><strong>Description :</strong> $description</li>
                </ul>
                Veuillez la traiter dans les meilleurs délais.<br><br>
                Merci,<br>
                L'équipe support.
            ";

            // Envoyer l'e-mail
            $mail->send();
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    }

    // Récupérer toutes les réclamations
    public function getAllReclamations()
    {
        $sql = "SELECT * FROM reclamations";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    // Récupérer une réclamation par ID
    public function getReclamationById($id)
    {
        $sql = "SELECT * FROM reclamations WHERE IdReclamation = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            return null;
        }
    }

    

    // Compter le nombre total de réclamations
    public function countReclamations()
    {
        $sql = "SELECT COUNT(*) as count FROM reclamations";
        $db = Config::getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch();
            return $result['count'];
        } catch (Exception $e) {
            return 0;
        }
    }

    // Compter les réclamations par type
    public function countReclamationsByType()
    {
        $sql = "SELECT TypeDeReclamation, COUNT(*) as count 
                FROM reclamations 
                GROUP BY TypeDeReclamation";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            return [];
        }
    }

    // Compter les réclamations par état
    public function countReclamationsByEtat()
    {
        $sql = "SELECT Etat, COUNT(*) as count 
                FROM reclamations 
                GROUP BY Etat";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            return [];
        }
    }

    // Récupérer les réclamations d'un utilisateur avec leur solution
    public function getReclamationsWithSolutionByUserId($idUtilisateur)
    {
        $sql = "SELECT r.IdReclamation, sr.Solution, r.DescriptionDeLaReclamation
                FROM reclamations r
                LEFT JOIN solutionreclamations sr ON r.IdReclamation = sr.IdReclamation
                WHERE r.IdUtilisateur = :idUtilisateur";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idUtilisateur' => $idUtilisateur]);
            return $query->fetchAll();
        } catch (Exception $e) {
            return [];
        }
    }

    // Récupérer le type de réclamation le plus fréquent
    public function getMostCommonReclamationType()
    {
        $sql = "SELECT TypeDeReclamation, COUNT(*) as count 
                FROM reclamations 
                GROUP BY TypeDeReclamation 
                ORDER BY count DESC LIMIT 1";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            return null;
        }
    }

    // Récupérer le type de réclamation le plus fréquent avec son pourcentage
    public function getMostCommonReclamationTypeAndPercentage()
    {
        // Récupérer le type de réclamation le plus fréquent
        $mostCommonType = $this->getMostCommonReclamationType();

        // Si aucun type trouvé, retourner des valeurs par défaut
        if (!$mostCommonType) {
            return [
                'type' => 'Aucun',
                'count' => 0,
                'percentage' => 0,
                'status' => 'faible'
            ];
        }

        // Récupérer le nombre total de réclamations
        $totalReclamations = $this->countReclamations();

        // Calcul du pourcentage
        $percentage = 0;
        if ($totalReclamations > 0) {
            $percentage = ($mostCommonType['count'] / $totalReclamations) * 100;
        }

        // Déterminer le statut
        $status = 'faible';
        if ($percentage >= 50) {
            $status = 'critique';
        } elseif ($percentage >= 20) {
            $status = 'moyen';
        }

        return [
            'type' => $mostCommonType['TypeDeReclamation'],
            'count' => $mostCommonType['count'],
            'percentage' => $percentage,
            'status' => $status
        ];
    }
}
?>
