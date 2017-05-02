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
    const levl1      = 0;
    const levl2      = 25;
    const levl3      = 100;
    const levl4      = 200;
    const levl5      = 325;
    const levl6      = 475;
    const levl7      = 650;
    const levl8      = 850;
    const levl9      = 1075;
    const levl10     = 1325;
    const levl11     = 1600;
    const levl12     = 1900;
    const levl13     = 2225;
    const levl14     = 2600;
    const levl15     = 3000;
    const levl16     = 3425;
    const levl17     = 3850;
    const levl18     = 4325;
    const levl19     = 4825;
    const levl20     = 5350;
    const levl21     = 5900;
    const levl22     = 6475;
    const levl23     = 7075;
    const levl24     = 7700;
    const levl25     = 8350;
    const levl26     = 9025;


    private $levelData = [1 => levels::levl1,
                          2 => levels::levl2,
                          3 => levels::levl3,
                          4 => levels::levl4,
                          5 => levels::levl5,
                          6 => levels::levl6,
                          7 => levels::levl7,
                          8 => levels::levl8,
                          9 => levels::levl9,
                         10 => levels::levl10,
                         11 => levels::levl11,
                         12 => levels::levl12,
                         13 => levels::levl13,
                         14 => levels::levl14,
                         15 => levels::levl15,
                         16 => levels::levl16,
                         17 => levels::levl17,
                         18 => levels::levl18,
                         19 => levels::levl19,
                         20 => levels::levl20,
                         21 => levels::levl21,
                         22 => levels::levl22,
                         23 => levels::levl23,
                         24 => levels::levl24,
                         25 => levels::levl25,
                         26 => levels::levl26
                         ];

    public function getStartExp($level)
    {
        $startExp = 0;
        foreach ($this->levelData as $key => $value)
        {
            if ($level == 1){
                $startExp = 0;
            }
            elseif ($key == $level){
                $startExp = $value;
            }
        }
        return $startExp;
    }

    public function getEndExp($level)
    {
        $endExp = 0;
        foreach ($this->levelData as $key => $value)
        {
            if ($key == $level+1){
                $endExp = $value;
            }
        }
        return $endExp;
    }

    public function levelProgress(USER $user, $level, $zkusenosti)
    {
        $end = $this->getEndExp($level)-$this->getStartExp($level);
        $start = $zkusenosti-$this->getStartExp($level);
        $progress = (($start)/($end))*100;
        foreach ($this->levelData as $key => $value){
            if ($key == $level) {
                $highExp = $value;
                if ($highExp <= $zkusenosti) {
                    $user->setLevl($level++);
                    $user->save();
                }
            }
        }
        return $progress;
    }
}