<?php
/**
 * Created by PhpStorm.
 * User: Milan
 * Date: 18.04.2017
 * Time: 23:22
 */
require_once 'models/user.php';
require_once 'basicPrivateController.php';
require_once 'models/quest.php';

class prednaska extends basicPrivateController
{
    private $user = null;
    public $userQuestList = null;
    public $questList = null;


    public function run()
    {
        $quest = new quests();
        $this->user = USER::loadFromSession();
        $this->questList = quests::getQuestList();
        $this->userQuestList = $this->user->getQuests();





        if(isset($_POST['zacit'])) {
            $idPrednasky = $_POST['prednaska'];
        $this->user->setQuest($idPrednasky, quest::STATUS_RUNNING);
        }
        $this->renderPrivate('prednaska.phtml');
    }
}

$class = new prednaska();
$class->run();