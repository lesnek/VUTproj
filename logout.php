<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 22:20
 */

require_once 'models/user.php';
require_once 'basicPublicController.php';

class logout extends basicPublicController{

    public function run()
    {
        USER::logout();
        $this->redirect('index.php');
    }
}
$app = new logout();
$app->run();

