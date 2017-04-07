<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */
session_start();
require_once 'models/user.php';
require_once 'basicPublicController.php';

class registerController extends basicPublicController
{
    public function start()
    {
        $msg = [];

        parent::start();

        if (isset($_POST['btn-signup'])) {
            $uname = trim($_POST['txtuname']);
            $email = trim($_POST['txtemail']);

            $isValid = true;
            if (USER::existEmail($email)) {
                $msg[] = ['type' => 'ERROR', 'text' => 'Na tento email už byl vytvořen účet.'];
                $isValid = false;
            }
            if (USER::existUserName($uname)) {
                $msg[] = ['type' => 'ERROR', 'text' => 'Tento login již existuje.'];
                $isValid = false;
            }

            if ($isValid) {

                $user = new USER();
                $user->setUserName($uname);
                $user->setUserEmail($email);
                $user->setUserPassword(trim($_POST['txtpass']));
                $user->setTokenCode(USER::IS_NOT_ACTIVATE);
                $user->setLevl(USER::DEFAULT_LEVL);
                $user->setZkusenosti(USER::DEFAULT_ZKUSENOSTI);
                $user->setEnergie(USER::DEFAULT_ENERGIE);
                $user->setStesti(USER::DEFAULT_STESTI);
                $user->setInteligence(USER::DEFAULT_INTELIGENCE);
                $user->setSoustredeni(USER::DEFAULT_SOUSTREDENI);
                $user->setZnamka(USER::DEFAULT_ZNAMKA);
                $user->setPohlavi(trim($_POST['pohlavi']));
                $user->register();

                $id = $user->getId();
                $code = sha1(uniqid(rand()));
                $user->setTokenCode($code);
                //$user->save();

                //$mail = new MyMail();
                //$mail->sendRegisterEmail($user, $code);

                $msg[] = ['type' => 'SUCCESS', 'text' => '<strong>Výborně!</strong>  Na adresu ' . $email . ' jsme zaslali aktivační link, po kterém bude tvoje registrace platná.'];
                //$key = base64_encode($id);
                /*
                            $message = "Dobrý den $uname,
                                        <br /><br />
                                        Vítejte v naší malé VUT hře<br/>
                                        Pro registraci pokračujte přes odkaz níže<br/>
                                        <br /><br />
                                        <a href='http://www.suprweb.php5.cz/verify.php?id=$key&code=$code'>Klikněte zde pro aktivaci vašeho účtu</a>
                                        <br /><br />
                                        Děkujeme za registraci";

                            $subject = "Potvrďte registracu";

                            $reg_user->send_mail($email, $message, $subject);
                */
            }
        }

        include_once "views/header.phtml";
        include_once "views/registerPage.phtml";
        include_once "views/footer.phtml";

    }
}
$class = new registerController();
$class->start();
