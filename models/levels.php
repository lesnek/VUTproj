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
    const levl1      = 50;
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
                         12 => levels::levl12
    ];

    public function getStartExp($level)
    {
        $startExp = 0;
        $this->levelData;
        foreach ($this->levelData as $key => $value){
            if ($key == $level){
                $startExp = $value;
            }
        }
        return $startExp;
    }

    public function getEndExp($level)
    {
        $endExp = 0;
        $this->levelData;
        foreach ($this->levelData as $key => $value){
            if ($key-1 == $level){
                $endExp = $value;
            }
        }
        return $endExp;
    }

    public function levelProgress(USER $user, $level, $zkusenosti)
    {
        $highExp = 0;
        $this->levelData;
        foreach ($this->levelData as $key => $value){
            if ($key-1 == $level) {
                $highExp = $value;
                if ($highExp <= $zkusenosti) {
                    $user->setLevl($level++);
                    $user->save();
                }
            }
        }
        $this->getEndExp($level);
        $progres = (($zkusenosti-$this->getStartExp($level))/($highExp-$this->getStartExp($level)))*100;
        return $progres;
    }
}