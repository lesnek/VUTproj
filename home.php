<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:20
 */

require_once 'models/user.php';
require_once 'basicPrivateController.php';

class home extends basicPrivateController
{
    public function run()
    {
        $this->render('home.phtml');
    }
}
$app = new home();
$app->run();

