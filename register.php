<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';
require_once 'models/myMail.php';

class registerController extends basicPublicController
{
    public function run()
    {
        $phtmlPath = 'registerPage.phtml';

        if (isset($_POST['btn-signup'])) {

            $uname = trim($_POST['txtuname']);
            $email = trim($_POST['txtemail']);

            $isValid = true;
            if (USER::existEmail($email)) {
                $this->msg[] = ['type' => 'ERROR', 'text' => 'Na tento email už byl vytvořen účet.'];
                $isValid = false;
            }
            if (USER::existUserName($uname)) {
                $this->msg[] = ['type' => 'ERROR', 'text' => 'Tento login již existuje.'];
                $isValid = false;
            }

            if ($isValid) {

                $user = new USER();
                $user->setUserName($uname);
                $user->setUserEmail($email);
                $user->setUserPassword(sha1(trim($_POST['txtpass'])));
                $user->setLevl(USER::DEFAULT_LEVL);
                $user->setUserStatus(USER::IS_NOT_ACTIVATE);
                $user->setZkusenosti(USER::DEFAULT_ZKUSENOSTI);
                $user->setEnergie(USER::DEFAULT_ENERGIE);
                $user->setStesti(USER::DEFAULT_STESTI);
                $user->setInteligence(USER::DEFAULT_INTELIGENCE);
                $user->setSoustredeni(USER::DEFAULT_SOUSTREDENI);
                $user->setZnamka(USER::DEFAULT_ZNAMKA);
                $user->setPohlavi(trim($_POST['pohlavi']));
                $code = sha1(uniqid(rand()));
                $user->setTokenCode($code);
                $user->register();

                $mail = new MyMail();
                $mail->sendRegisterEmail($user, $code);

                $this->msg[] = ['type' => 'SUCCESS', 'text' => '<strong>Výborně!</strong>  Na adresu ' . $email . ' jsme zaslali aktivační link, po kterém bude tvoje registrace platná.'];

                $phtmlPath = 'registerPageSuccesfull.phtml';
            }

        }

        $this->render($phtmlPath);
    }
}
$app = new registerController();
$app->run();
