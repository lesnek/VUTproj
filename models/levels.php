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
    const levl1      = 25;
    const levl2      = 50;
    const levl3      = 125;
    const levl4      = 225;
    const levl5      = 350;
    const levl6      = 500;
    const levl7      = 675;
    const levl8      = 875;
    const levl9      = 1100;
    const levl10     = 1350;
    const levl11     = 1625;
    const levl12     = 1925;
    const levl13     = 2250;
    const levl14     = 2625;
    const levl15     = 3025;
    const levl16     = 3450;
    const levl17     = 3875;
    const levl18     = 4350;
    const levl19     = 4850;
    const levl20     = 5375;
    const levl21     = 5925;
    const levl22     = 6500;
    const levl23     = 7100;
    const levl24     = 7725;
    const levl25     = 8375;
    const levl26     = 9050;


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