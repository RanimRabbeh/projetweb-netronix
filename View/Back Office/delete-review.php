<?php

require_once '../../config.php';
require_once '../../Controller/AvisC.php';
require_once '../../vendor/autoload.php';  // Include the PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Check if 'Idavis' is passed via GET
if (isset($_GET['Idavis'])) {
    $id = $_GET['Idavis']; // Get the ID from GET

    // Fetch the email of the avis creator using the Avis model
    $pdo = config::getConnexion();
    $stmt = $pdo->prepare("SELECT * FROM avis WHERE Idavis = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $avis = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the avis exists
    if ($avis) {
        // Create an Avis object to use its methods
        $avisObj = new Avis($avis['Idavis'], $avis['Subject'], $avis['Nom'], $avis['Prenom'], $avis['Email'], $avis['Description']);

        // Get the email and other details from the Avis object
        $Email = $avisObj->getEmail();
        $Prenom = $avisObj->getPrenom();
        $Nom = $avisObj->getNom();

        // Delete the avis
        $stmt = $pdo->prepare("DELETE FROM avis WHERE Idavis = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Send confirmation email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use your email provider's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'laroussi.yasm@gmail.com'; // Your email address
            $mail->Password = 'dfqs ftes olgg airn'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipient
            $mail->setFrom('your-email@gmail.com', 'Cultivio'); // Sender's email and name
            $mail->addAddress($Email, "$Prenom $Nom"); // Recipient's email and name

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Avis Deletion Confirmation';
            $mail->Body = "
                <h1>Your Avis has been Deleted</h1>
                <p>Dear $Prenom $Nom,</p>
                <p>We wanted to inform you that your avis has been successfully deleted from our system.</p>
                <p>If you have any questions, feel free to contact us.</p>
                <p>Best regards,<br>Cultivio </p>
            ";

            // Send email
            $mail->send();
            header("Location: avis-back.php");
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Avis not found!";
    }
} else {
    echo "No ID provided!";
}
?>
