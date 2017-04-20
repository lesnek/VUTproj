<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 18.04.2017
 * Time: 23:22
 */
require_once 'models/user.php';
require_once 'basicPrivateController.php';

class prednaska extends basicPrivateController
{
    public function run()
    {
        if(isset($_POST['zacit'])) {
            $dobaPrednasky = $_POST['prednaska'];

            }
        $this->renderPrivate('prednaska.phtml');
    }
}

$class = new prednaska();
$class->run();