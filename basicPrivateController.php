<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */

require_once 'basicPublicController.php';
class basicPrivateController extends basicPublicController
{

    public function __construct()
    {
        if (USER::isLoggedIn() !== true) {
            $this->redirect('login.php');
            exit;
        }
    }

    public function run()
    {

    }
}

