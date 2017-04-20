<?php

/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 20:20
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';

class indexController extends basicPublicController
{
    public function run()
    {
        $this->render('index.phtml');
    }
}

$app = new indexController();
$app->run();
