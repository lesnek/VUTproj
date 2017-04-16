<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 1:01
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';
require_once 'models/myMail.php';
class forgotPassController extends basicPublicController {
    public function run()
    {
        if(isset($_POST['submit']))
        {
            $user = new USER();
            $email = trim($_POST['txtemail']);
            if(USER::existEmail($email))
            {
                $user->loadByMail($email);
                $code = $user->getTokenCode();
                $mail = new MyMail();
                $mail->sendForgotPassword($user, $code, $email);
                $this->msg[] = ['type' => 'SUCCESS', 'text' => 'Resetovací link byl odeslán na adresu '. $email.'.'];
            }
            else
            {
                $this->msg[] = ['type' => 'ERROR', 'text' => 'Na tento email nebyl vytvořen žádný účet.'];
            }
        }

        $this->render('fpass.phtml');
    }
}
$class = new forgotPassController();
$class->run();
