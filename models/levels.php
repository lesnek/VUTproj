<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 15.04.2017
 * Time: 16:26
 */
require_once 'database.php';

class levels
{
    const TABLE      = 'tbl_users';
    const levl2      = 100;
    const levl3      = 225;
    const levl4      = 375;
    const levl5      = 550;
    const levl6      = 725;
    const levl7      = 950;
    const levl8      = 1200;
    const levl9      = 1500;
    const levl10     = 1850;
    const levl11     = 2225;
    const levl12     = 2625;


    private $levelData = [levels::levl2,
                          levels::levl3,
                          levels::levl4,
                          levels::levl5,
                          levels::levl6,
                          levels::levl7,
                          levels::levl8,
                          levels::levl9,
                          levels::levl10,
                          levels::levl11,
                          levels::levl12
    ];

    public function levelCheck(USER $user)
    {
        $this->levelData;
    }

    public function levelProgress($level, $zkusenosti)
    {
        $progres = ($level/$zkusenosti)*100;
        return $progres;
    }

}