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

    public static function getQuestList() {
        $database = new Database();
        $data = $database->getAll(quest::TABLE, [quest::COLUMN_ID, quest::COLUMN_DESC, quest::COLUMN_DURATION, quest::COLUMN_AFTER_FINISH]);

        $result = [];
        foreach($data as $item) {
            $id = $item[quest::COLUMN_ID];
            $quest = new quest($id, $item[quest::COLUMN_DESC], $item[quest::COLUMN_DURATION], $item[quest::COLUMN_AFTER_FINISH]);
            $result[$id] = $quest;
        }
        return $result;
    }

    public static function getUserQuestList($userId) {
        $database = new Database();
        $data = $database->getByPropertyAll(UserQuest::TABLE, [UserQuest::COLUMN_ID, UserQuest::COLUMN_USER_ID, UserQuest::COLUMN_TASK_ID, UserQuest::COLUMN_CREATE_TIME, UserQuest::COLUMN_STATUS], UserQuest::COLUMN_USER_ID, $userId);

        $result = [];
        foreach($data as $item) {
            $taskId = $item[UserQuest::COLUMN_TASK_ID];
            $quest = new UserQuest($item[UserQuest::COLUMN_ID], $item[UserQuest::COLUMN_USER_ID], $taskId, $item[UserQuest::COLUMN_CREATE_TIME], $item[UserQuest::COLUMN_STATUS]);
            $result[$taskId] = $quest;
        }
        return $result;
    }

    public static function userQuestListToJson($list) {
        $result = [];
        foreach($list as $item) {
            /** @var UserQuest $item */
            $id = $item->getId();
            $taskId = $item->getTaskId();
            $createime = $item->getCreateTime();
            $status = $item->getStatus();
            $result[$taskId] = ['id' => $id, 'taskId' => $taskId, 'createTime' => $createime, 'status' => $status];
        }
        return json_encode($result);
    }
}