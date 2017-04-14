<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';

class verifyController extends basicPublicController
{
    public function run()
    {
        $id   = isset($_GET['id'])   ? $_GET['id']   : null;
        $code = isset($_GET['code']) ? $_GET['code'] : null;

        if (empty($id) || empty($code))
        {
            $this->redirect('index.php');
        }
        else
        {
            $id = base64_decode($id);
            $user = new USER($id);

            if ($user->getId() == $id && $user->getTokenCode() == $code)
            {
                if ($user->getUserStatus() == USER::IS_NOT_ACTIVATE)
                {
                    $user->setUserStatus(USER::IS_ACTIVATE);
                    $user->save();

                    $this->msg[] = ['type' => 'SUCCESS', 'text' => "<strong>Gratulujeme!</strong>  Účet máš nyní aktivovaný, <a href='login.php'>Zde se přihlaš</a></div>"];
                }
                else
                {
                    $this->msg[] = ['type' => 'ERROR', 'text' => "<strong>STOP!</strong> Tvůj účet je již aktivovaný, <a href='login.php'>raději se rovnou přihlaš</a></div>"];
                }
            }
            else
            {
                $this->msg[] = ['type' => 'ERROR', 'text' => "<strong>Hups! </strong>Tak tvůj učet tu asi není. <a href='register.php'>Registruj se zde</a></div>"];
            }
        }

        $this->render('verify.phtml');
    }
}
$app = new verifyController();
$app->run();
