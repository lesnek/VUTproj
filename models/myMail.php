<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 16:12
 */
class MyMail extends basicPublicController
{
    //const SMTP             = 'smtp.gmail.com';
    //const Port             = "587";
    private $UserN;
    private $Pass;

    const CONFIG_FILE = __DIR__ . "/../conf.json";


    public function sendForgotPassword(USER $user, $code, $email)
    {
        $key = base64_encode($user->getId());

        $message= "Dobrý den, $email
				   <br /><br />
				   Byl nám zaslán dotaz o obnovení hesla pro účet registrovaný na adresu $email,
				   <br /><br />
				   Klikněte prosím níže pro resetování hesla:
				   <br /><br />
				   <a href='https://lesnek.eu/resetPass.php?id=$key&code=$code'>Resetovat heslo</a>";
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
                    <a href='https://lesnek.eu/verify.php?id=$key&code=$code'>Klikněte zde pro aktivaci vašeho účtu</a>
                    <br /><br />
                    Děkujeme za registraci";

        $subject = "Potvrzení registrace";

        $this->sendMail($email, $message, $subject);
    }

    private function sendMail($email, $message, $subject)
    {
        require_once(__DIR__ . '/../mailer/class.phpmailer.php');
        $content = file_get_contents(self::CONFIG_FILE);
        $json = (array)json_decode($content);
        $mail = new PHPMailer();
        $mail->SMTPDebug = 3;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->AddAddress($email);
        $mail->Username = $this->UserN = $json["mail_user_name"];
        $mail->Password = $this->Pass = $json["mail_pass"];
        $mail->SetFrom('vutgame.noreply@gmail.com', 'VUTgame (no-reply)');
        $mail->AddReplyTo("vutgame.noreply@gmail.com", "VUTgame");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->IsSMTP();
        $mail->Send();
        mail($email,$subject,$message);
    }
}