<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Activer le debug
    $mail->isSMTP();                                            // Utilisation du SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specification du serveur SMTP à utiliser
    $mail->SMTPAuth   = true;                                   // Activer l'authentification SMTP
    $mail->Username   = 'no.reply.huissier@gmail.com';                     // Username du compte mail
    $mail->Password   = 'Cl3mFr3dQu3nt1n';                               // Password du compte mail
    $mail->SMTPSecure = 'tls';                                  // Activation du chiffrement TLS. Le SSL est aussi disponible
    $mail->Port       = 587;                                    // Port TCP de notre serveur SMTP (Google : 587)

    //Recipients
    $mail->setFrom('no.reply.huissier@gmail.com', 'Admin');
    $user_email = isset($_POST['login']) ? $_POST['login'] : $email;
    $mail->addAddress($user_email);

    // Content
    $mail->isHTML(true);                                  // Email au format HTML
    $mail->Subject = isset($_POST['login']) ? 'Recuperation de mot de passe' : 'Confirmation de compte';
    $mail->Body    = isset($_POST['login']) ? "Veuillez cliquez sur le lien pour changer votre mot de passe : <a href='https://www.mymobil-kpi.com/email_modify_password.php?nmuser=$token'>Cliquez-ici</a>" : "Veuillez cliquer sur le lien suivant pour confirmer votre compte : <a href='https://www.mymobil-kpi.com/confirm_account.php?nmuser=$token'>cliquez-ici</a>";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
