<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */

class basicPrivateController extends basicPublicController
{
    public function start()
    {
        if (USER::isLoggedIn() !== true) {
            $this->redirect('index.php');
        }
    }
}

