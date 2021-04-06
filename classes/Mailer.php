<?php

class Mailer
{
	public $mail;			// PHPMailer-Objekt
	
	function __construct($recipient, $subject, $message)
	{
		$this->mail = new PHPMailer();
		
		$this->mail->isSMTP();									// Set mailer to use SMTP
		$this->mail->Host = MAIL_HOST;							// Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;							// Enable SMTP authentication
		$this->mail->Username = MAIL_USER;						// SMTP username
		$this->mail->Password = MAIL_PASS;						// SMTP password
		$this->mail->SMTPSecure = MAIL_ENCRYPTION;				// Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = MAIL_PORT;							// TCP port to connect to
		
		$this->mail->setFrom(MAIL_USER, MAIL_SENDER_NAME);
		$this->mail->addAddress($recipient);					// Add a recipient
		$this->mail->addReplyTo(MAIL_REPLY, MAIL_SENDER_NAME);
		
		$this->mail->isHTML(false);								// Set email format to HTML
		
		$this->mail->Subject = $subject;
		$this->mail->Body    = $message;
		$this->mail->AltBody = $message;
	}
	
	function send()
	{
		if (!$this->mail->send()) {
			_Meldung::set_fehler("E-Mail an $recipient konnte nicht versendet werden. " . $this->mail->ErrorInfo);
			return false;
		}
		else {
			return true;
		}
	}

}

?>