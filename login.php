<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 20:20
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';
class loginController extends basicPublicController {

    public function run()
    {
        if (isset($_POST['login'])) {
            $email = trim($_POST['txtemail']);
            $upass = trim($_POST['txtupass']);
            $user = new USER();
            $user->login($email, $upass);
            if(USER::isLoggedIn())
            {
                $this->redirect('home.php');
            }
            elseif ($user->getId() == null)
            {
                $this->msg[] = ['type' => 'ERROR', 'text' => "<strong>Nesprávné zadání</strong>"];
            }
            elseif ($user->getUserStatus() == USER::IS_NOT_ACTIVATE)
            {
                $this->msg[] = ['type' => 'ERROR', 'text' => "Tento účet není aktivovaný, prosím zkontrolujte si emailovou schránku kam vám byl zasklán aktivační link"];
            }
        }
        $this->render('login.phtml');
    }
}

$app = new loginController();
$app->run();