<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 9:20
 */
require_once 'models/user.php';
require_once 'basicPrivateController.php';

class characterController extends basicPrivateController {
    public function run()
    {
        $this->renderPrivate('postava.phtml');
    }
}

$class = new characterController();
$class->run();




