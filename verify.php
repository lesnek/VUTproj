<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 1:15
 */
require_once 'models/user.php';
require_once 'basicPublicController.php';

$user = new USER();
$basic = new basicPublicController();
$msg = [];

if (empty($_GET['id']) && empty($_GET['code'])) {
    $basic->redirect('index.php');
}

if (isset($_GET['id']) && isset($_GET['code'])) {
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $IS_ACTIVATE = 'Y';
    $IS_NOT_ACTIVATE = 'N';

    if ($user->getId() == $id && $user->getTokenCode() == $code) {
        if ($user->getUserStatus() == $IS_NOT_ACTIVATE) {
            $user->setUserStatus($IS_ACTIVATE);

            $msg = ['type' => 'SUCCESS', 'text' => "<strong>Gratulujeme!</strong>  Účet máš nyní aktivovaný, <a href='index.php'>Zde se přihlaš</a></div>"];
        } else {
            $msg = ['type' => 'ERROR', 'text' => "<strong>STOP!</strong> Tvůj účet je již aktivovaný, <a href='index.php'>raději se rovnou přihlaš</a></div>"];
        }
    } else {
        $msg = ['type' => 'SUCCESS', 'text' => "<strong>Hups! </strong>Tak tvůj učet tu asi není. <a href='register.php'>Registruj se zde</a></div>"];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Potvrzení registrace</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/layout.css" rel="stylesheet" media="screen">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body id="login">
<div class="container">
    <?php if (isset($msg)) {
        echo $msg;
    } ?>
</div>
<script src="vendors/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>