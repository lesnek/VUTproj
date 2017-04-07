<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */

class basicPublicController
{
    public function start()
    {
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}
?>
