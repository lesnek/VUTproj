<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 16:12
 */
class MyMail extends basicPublicController
{
    const SMTP             = 'smtp.email.cz';
    const Port             = 465;
    const UserN            = 'vutgame@email.cz';
    const Pass             = 'studentvpn';

    public function sendForgotPassword(USER $user, $code, $email)
    {
        $key = base64_encode($user->getId());

        $message= "Dobrý den, $email
				   <br /><br />
				   Byl nám zaslán dotaz o obnovení hesla pro účet registrovaný na adresu $email,
				   <br /><br />
				   Klikněte prosím níže pro resetování hesla:
				   <br /><br />
				   <a href='http://www.lesnek.eu/resetPass.php?id=$key&code=$code'>Resetovat heslo</a>";
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
                    <a href='http://www.lesnek.eu/verify.php?id=$key&code=$code'>Klikněte zde pro aktivaci vašeho účtu</a>
                    <br /><br />
                    Děkujeme za registraci";

        $subject = "Potvrzení registrace";

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
        $mail->Port = myMail::Port;
        $mail->AddAddress($email);
        $mail->Username = myMail::UserN;
        $mail->Password = myMail::Pass;
        $mail->SetFrom('vutgame@email.cz', 'VUTgame (no-reply)');
        $mail->AddReplyTo("vutgame@email.cz", "VUTgame");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}