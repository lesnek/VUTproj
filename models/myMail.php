<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 16:12
 */
class MyMail extends basicPublicController
{
    const SMTP = 'smtp.seznam.cz';


    public function sendForgotPassword(USER $user, $code)
    {
        $key = base64_encode($user->getId());
        $email = $user->getUserEmail();


        $message= "Dobrý den, $email
				   <br /><br />
				   Byl nám zaslán dotaz o obnovení hesla pro účet registrovaný na adresu $email,
				   <br /><br />
				   Klikněte prosím níže pro resetování hesla:
				   <br /><br />
				   <a href='http://www.suprweb.php5.cz/resetpass.php?id=$key&code=$code'>Resetovat heslo</a>";
        $subject = "Reset hesla";

        $this->sendMail($email,$message,$subject);
    }

    public function sendRegisterEmail(USER $user, $code)
    {
        $key = base64_encode($user->getId());
        $uname = $user->getUserName();
        $email = $user->getUserEmail();
        $message = "Dobrý den $uname,
                    <br /><br />
                    Vítejte v naší malé VUT hře<br/>
                    Pro registraci pokračujte přes odkaz níže<br/>
                    <br /><br />
                    <a href='http://www.suprweb.php5.cz/verify.php?id=$key&code=$code'>Klikněte zde pro aktivaci vašeho účtu</a>
                    <br /><br />
                    Děkujeme za registraci";

        $subject = "Potvrďte registraci";

        $this->sendMail($email, $message, $subject);
    }

    private function sendMail($email, $message, $subject)
    {
        require_once(__DIR__ . '/../mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = myMail::SMTP;
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username = "vutgame@email.cz";
        $mail->Password = "studentvpn";
        $mail->SetFrom('vutgame@email.cz', 'VUTgame');
        $mail->AddReplyTo("vutgame@email.cz", "VUTgame");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}