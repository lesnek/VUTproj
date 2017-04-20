<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 20.04.2017
 * Time: 9:34
 */
class quests
{
    /** Constants **/

    const TABLE              = 'quests';
    const COLUMN_START_TIME  = 0;
    const COLUMN_DURATION    = 0;
    const COLUMN_SUCCESS     = false;

    private $database = null;

    private $columns = [quests::COLUMN_START_TIME,
                        quests::COLUMN_DURATION,
                        quests::COLUMN_SUCCESS
                       ];

    private $startTime       = null;
    private $duration        = null;
    private $success         = null;

    public function setStartTime($value)  {$this->startTime = $value;}
    public function setDuration($value)   {$this->duration = $value;}
    public function setSuccess($value)    {$this->success = $value;}

    public function getStartTime() {return $this->startTime;}
    public function getDuration()  {return $this->duration;}
    public function getSuccess()   {return $this->success;}
}