<?

class Mailer {
  /**
   * Sending email via Google's Gmail servers.
   */

  public static function send_mail($to, $name, $subject, $body) {
    $mail = new PHPMailer;

    //Config file
    require_once('../mailer/smtp_config.php');

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = HOST;

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = PORT;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = USERNAME;

    //Password to use for SMTP authentication
    $mail->Password = PASSWORD;

    //Set who the message is to be sent from
    $mail->setFrom(USERNAME, NAME);

    //Set an alternative reply-to address
    $mail->addReplyTo(USERNAME, NAME);

    //Set who the message is to be sent to
    $mail->addAddress($to, $name);

    //Set the subject line
    $mail->Subject = $subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

    //Replace the plain text body with one created manually
    $mail->AltBody = 'alt body?';
    $mail->MsgHTML($body);


    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!"; exit;
    }
  }
}