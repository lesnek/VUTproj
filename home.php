<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:20
 */
session_start();
require_once 'models/user.php';
$user_home = new USER();
$basic = new basicPublicController();

if(!$user_home->isloggedIn())
{
	$basic->redirect('index.php');
}

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>VUTgame</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/layout.css" rel="stylesheet" media="screen">
    </head>
    
    <body>
    <?php include_once "navMenu.php"?>
    </body>

</html>