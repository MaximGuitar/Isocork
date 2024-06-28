<?php
	// require_once $_SERVER['DOCUMENT_ROOT'].'/local/includes/vars.php';
	// require_once $_SERVER['DOCUMENT_ROOT'].'/local/includes/utils.php';

    # PS PHPMAILER
    require __DIR__.'/PHPMailer/src/PHPMailer.php';
    require __DIR__.'/PHPMailer/src/SMTP.php';
    require __DIR__.'/PHPMailer/src/Exception.php';

    function custom_mail($to, $subject, $message, $additional_headers='', $additional_parameters='', $context=null) {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
            #    $mail->SMTPDebug = 4;                      //Enable verbose debug output
                $mail->Debugoutput = 'echo';                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.system.place-start.ru';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'isocork-ru';                     //SMTP username
                $mail->Password   = 'WesternPersonAlaskaFortieth09';                               //SMTP password
                $mail->Port       = 250;                                    //TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above

                $mail->setFrom('isocork@bitrix.ps', 'isocork.ru');
                //Recipients
                $mail->addAddress($to);
                $mail->addCC('feadback@place-start.ru');

                //Content
                $mail->isHTML(false);                                  //Set email format to HTML
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

?>