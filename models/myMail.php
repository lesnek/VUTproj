<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 16:12
 */
class MyMail extends basicPublicController
{
    const SMTP             = 'smtp.seznam.cz';
    const SMTPDbg          = 0;
    const SMTPAuthentic    = true;
    const Port             = 465;
    const UserN            = 'vutgame@seznam.cz';
    const Pass             = 'studentvpn';
    const From             = ['vutgame@email.cz', 'VUTgame (no-reply)'];
    const ReplyTo          = ["vutgame@email.cz", "VUTgame"];


    public function sendForgotPassword(USER $user, $code, $email)
    {
        $key = base64_encode($user->getId());

        $message= "Dobrý den, $email
				   <br /><br />
				   Byl nám zaslán dotaz o obnovení hesla pro účet registrovaný na adresu $email,
				   <br /><br />
				   Klikněte prosím níže pro resetování hesla:
				   <br /><br />
				   <a href='http://www.suprweb.php5.cz/resetPass.php?id=$key&code=$code'>Resetovat heslo</a>";
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

        $subject = "Potvrzení registrace";

        $this->sendMail($email, $message, $subject);
    }

    private function sendMail($email, $message, $subject)
    {
        require_once(__DIR__ . '/../mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = myMail::SMTPDbg;
        $mail->SMTPAuth = myMail::SMTPAuthentic;
        $mail->SMTPSecure = "ssl";
        $mail->Host = myMail::SMTP;
        $mail->Port = myMail::Port;
        $mail->AddAddress($email);
        $mail->Username = myMail::UserN;
        $mail->Password = myMail::Pass;
        $mail->SetFrom(myMail::From);
        $mail->AddReplyTo(myMail::ReplyTo);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}