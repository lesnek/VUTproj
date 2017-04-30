<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 20.04.2017
 * Time: 9:34
 */
class UserQuest
{
    /** Constants **/

    const TABLE               = 'tbl_users_quests';
    const COLUMN_ID           = 'id';
    const COLUMN_USER_ID      = 'user_id';
    const COLUMN_TASK_ID      = 'task_id';
    const COLUMN_CREATE_TIME  = 'create_time';
    const COLUMN_STATUS       = 'status';

    private $database = null;

    private $columns = [UserQuest::COLUMN_ID,
                        UserQuest::COLUMN_USER_ID,
                        UserQuest::COLUMN_TASK_ID,
                        UserQuest::COLUMN_CREATE_TIME,
                        UserQuest::COLUMN_STATUS
                       ];

    private $id          = null;
    private $userId      = null;
    private $taskId      = null;
    private $createTime  = null;
    private $status      = null;

    public function setId($value)          {$this->id = $value;}
    public function setUserId($value)      {$this->userId = $value;}
    public function setTaskId($value)      {$this->taskId = $value;}
    public function setCreateTime($value)  {$this->createTime = $value;}
    public function setStatus($value)      {$this->status = $value;}

    public function getId()         {return $this->id;}
    public function getUserId()     {return $this->userId;}
    public function getTaskId()     {return $this->taskId;}
    public function getCreateTime() {return $this->createTime;}
    public function getStatus()     {return $this->status;}

    public function __construct($id, $userId, $taskId, $createTime, $status) {
        $this->database = new Database();
        $this->setId($id);
        $this->setUserId($userId);
        $this->setTaskId($taskId);
        $this->setCreateTime($createTime);
        $this->setStatus($status);
    }

    public function save()
    {
        $result = null;

        try
        {
            $id = $this->getId();

            $data = [UserQuest::COLUMN_USER_ID     => $this->getUserId(),
                     UserQuest::COLUMN_TASK_ID     => $this->getTaskId(),
                     UserQuest::COLUMN_CREATE_TIME => $this->getCreateTime(),
                     UserQuest::COLUMN_STATUS      => $this->getStatus()
            ];
            $this->database->update(self::TABLE, $data, $id);
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }

        return $result;
    }
}