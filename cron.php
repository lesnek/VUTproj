<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 12.05.2017
 * Time: 19:04
 */

class Cron {
    public function __construct()
    {

    }

    public function check_mission() {

    }
}

if (isset($argv[1])) {
    $object = new Cron();
    if (method_exists($object, $argv[1])) {
        $object->{$argv[1]}();
    } else {
        echo "Method " . $argv[1] . " not found";
    }
} else {
    echo "Missing argument";
}