<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 2:35
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';

class resetPass extends basicPublicController
{
    public function run()
    {
        $user = new USER();
        if (empty($_GET['id']) && empty($_GET['code'])) {
            $this->redirect('login.php');
        }

        if (isset($_GET['id']) && isset($_GET['code'])) {
            $id = base64_decode($_GET['id']);
            $code = $_GET['code'];

            $user->load($id);
            if ($user->getTokenCode() == $code) {
                if (isset($_POST['btn-reset-pass'])) {
                    $pass = $_POST['pass'];
                    $cpass = $_POST['confirm-pass'];
                    if ($cpass !== $pass) {
                        $this->msg[] = ['type' => 'ERROR', 'text' => 'Hesla nesouhlasí!'];
                    } else {
                        $password = sha1($cpass);
                        $user->setUserPassword($password);
                        $user->save();
                        $this->msg[] = ['type' => 'SUCCESS', 'text' => 'Heslo změněno'];
                    }
                }
            } else {
                $this->msg[] = ['type' => 'ERROR', 'text' => 'Účet nebyl nalezen, zkuste reset znovu nebo nás kontaktujte.'];
            }
        }
        $this->render('resetPass.phtml');
    }
}
$class = new resetPass();
$class->run();
