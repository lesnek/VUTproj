<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 20.04.2017
 * Time: 9:34
 */

/** For Quest creating, their value, desc, everything what they are and do */

class quest
{
    /** Constants **/

    const TABLE               = 'tbl_quests';
    const COLUMN_ID           = 'id';
    const COLUMN_DESC         = 'description';
    const COLUMN_DURATION     = 'duration';
    const COLUMN_AFTER_FINISH = 'after_finish';

    const STATUS_NONE             = 0;
    const STATUS_RUNNING          = 1;
    const STATUS_READY_TO_COLLECT = 2;
    const STATUS_COLLECTING       = 3;

    public $columns = [quest::COLUMN_ID,
                       quest::COLUMN_DESC,
                       quest::COLUMN_DURATION,
                       quest::COLUMN_AFTER_FINISH
                       ];

    private $id          = null;
    private $desc        = null;
    private $duration    = null;
    private $afterFinish = null;

    public function setId($value)          {$this->id = $value;}
    public function setDesc($value)        {$this->desc = $value;}
    public function setDuration($value)    {$this->duration = $value;}
    public function setAfterFinish($value) {$this->afterFinish = $value;}

    public function getId()          {return $this->id;}
    public function getDesc()        {return $this->desc;}
    public function getDuration()    {return $this->duration;}
    public function getAfterFinish() {return $this->afterFinish;}

    public function __construct($id, $desc, $duration, $afterFinish) {
        $this->setId($id);
        $this->setDesc($desc);
        $this->setDuration($duration);
        $this->setAfterFinish($afterFinish);
    }

}