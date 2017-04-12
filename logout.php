<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 22:20
 */
session_start();
require_once 'models/user.php';
require_once 'basicPublicController.php';
$user = new USER();

if(!$user->isLoggedIn())
{
	$basic->redirect('index.php');
}

if($user->isLoggedIn())
{
	$user->logout();	
	$basic->redirect('index.php');
}