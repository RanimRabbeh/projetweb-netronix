<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Enable verbose debugging for troubleshooting (set to 0 in production)
    $mail->SMTPDebug = 2; // 0 = off, 2 = debug output

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';          // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'nourboua20@gmail.com'; // Your Gmail address
    $mail->Password = 'ordf uusw flzv ttvm';      // Replace with your App Password (16-character code)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
    $mail->Port = 587;                        // Port for TLS/STARTTLS

    // Email settings
    $mail->setFrom('saifchaalene5@gmail.com', 'Saif Chaalene'); // Sender email (must match Username)
    $mail->addAddress('rejebadem13@gmail.com', 'Recipient Name'); // Recipient email and name
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent from XAMPP using PHPMailer and Gmail SMTP.';

    // Send the email
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
?>
