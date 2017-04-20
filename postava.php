<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 9:20
 */
require_once 'models/user.php';
require_once 'basicPrivateController.php';
require_once 'models/levels.php';

class characterController extends basicPrivateController
{
    public function run()
    {
        $user = new USER();
        $user->load(base64_decode($_SESSION['userSession']));
        $this->renderPrivate('postava.phtml');
    }
}

$class = new characterController();
$class->run();







