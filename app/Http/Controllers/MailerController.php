<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController extends Controller
{
    // server setting member variable
    private $SMTP_DEBUG;
    private $HOST;
    private $SMTP_AUTH;
    private $USERNAME;
    private $PASSWORD;
    private $SMTP_SECURE;
    private $PORT;
    private $SET_FROM;
    private $SET_FROM_NAME;

    public function __construct($HOST, $PORT, $USERNAME, $PASSWORD, $SET_FROM, $SET_FROM_NAME, $SMTP_SECURE, $SMTP_DEBUG = false, $SMTP_AUTH = true)
    {
        $this->HOST = $HOST;    //Set the SMTP server to send through
        $this->PORT = $PORT;    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->USERNAME = $USERNAME;    //SMTP username
        $this->PASSWORD = $PASSWORD;    //SMTP password
        $this->SET_FROM = $SET_FROM;    //sender mail 
        $this->SET_FROM_NAME = $SET_FROM_NAME;  //sender name
        $this->SMTP_DEBUG = $SMTP_DEBUG; // enable or disable the debug
        $this->SMTP_AUTH = $SMTP_AUTH;  //SMTP authentication by default is enable
        $this->SMTP_SECURE = $SMTP_SECURE;  //secure mailing enter 'tls'
    }

    public function MailConfiguration()
    {
        $mail = new PHPMailer(true);
        if ($this->SMTP_DEBUG) {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        }
        $mail->isSMTP();
        $mail->Host       = $this->HOST;
        $mail->SMTPAuth   = $this->SMTP_AUTH;                        
        $mail->Username   = $this->USERNAME;                     
        $mail->Password   = $this->PASSWORD;                     
        $mail->SMTPSecure = $this->SMTP_SECURE;          
        $mail->Port       = $this->PORT;
        $mail->setFrom($this->SET_FROM, $this->SET_FROM_NAME);
        return $mail;
    }

    public function SendMail($recipentAddress = [[]], $subject, $HTMLBody, $AltBody = null, $atachement = [[]], $cc = [], $bcc = [], $reply = false)
    {
        require base_path("vendor/autoload.php");
        $mail = $this->MailConfiguration();

        // recipent address 

        if (!empty($recipentAddress)) {
            foreach ($recipentAddress as $addressDetail) {
                if (sizeof($addressDetail) > 1)
                    $mail->addAddress($addressDetail[0], $addressDetail[1]);
                else
                    $mail->addAddress($addressDetail[0]);
            }
        }

        // if true reply active else reply deactive

        if ($reply) {
            $mail->addReplyTo($this->SET_FROM, $this->SET_FROM_NAME);
        }

        // cc address

        if (!empty($cc)) {
            foreach ($cc as $ccDetail) {
                $mail->addCC($ccDetail);
            }
        }

        //bcc address

        if (!empty($bcc)) {
            foreach ($bcc as $bccDetail) {
                    $mail->addBCC($bccDetail);
            }
        }

        // file attachement

        if (!empty($atachement)) {
            foreach ($atachement as $atachementDetail) {
                if (sizeof($atachementDetail) > 1){
                    $mail->addAttachment($atachementDetail[0], $atachementDetail[1]);
                }
                else{
                    if(sizeof($atachementDetail) > 0)
                        $mail->addAttachment($atachementDetail[0]);
                }
            }
        }

        //Content

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $HTMLBody;
        $mail->AltBody = $AltBody;

        if ($mail->send()) {
            return true;
        } else {

            return false;
        }
    }
}
