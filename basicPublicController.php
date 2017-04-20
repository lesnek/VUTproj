<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
class basicPublicController
{
    public $msg = [];

    public function  __construct()
    {
    }

    public function run()
    {
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function render($phtmlPath)
    {
        include_once "views/header.phtml";
        include_once "views/" . $phtmlPath;
        include_once "views/footer.phtml";
    }
    public function renderPrivate($phtmlPath)
    {
        include_once "views/header.phtml";
        include_once "views/navMenu.phtml";
        include_once "views/" . $phtmlPath;
        include_once "views/footer.phtml";
    }

    public function renderEmpty($phtmlPath)
    {
        include_once "views/" . $phtmlPath;
    }
}
