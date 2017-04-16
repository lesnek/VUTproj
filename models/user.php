<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 23:36
 */

require_once 'database.php';

class USER
{
    /** Konstanty */

    const IS_ACTIVATE         = 'Y';
    const IS_NOT_ACTIVATE     = 'N';

    const DEFAULT_LEVL        = 1;
    const DEFAULT_ZKUSENOSTI  = 0;
    const DEFAULT_ENERGIE     = 100;
    const DEFAULT_STESTI      = 1;
    const DEFAULT_INTELIGENCE = 1;
    const DEFAULT_SOUSTREDENI = 1;
    const DEFAULT_ZNAMKA      = 0;

    const TABLE               = 'tbl_users';

    const COLUMN_ID           = 'id';
    const COLUMN_USER_NAME    = 'userName';
    const COLUMN_USER_EMAIL   = 'userEmail';
    const COLUMN_USER_PASS    = 'userPass';
    const COLUMN_TOKEN_CODE   = 'tokenCode';
    const COLUMN_USER_STATUS  = 'userStatus';
    const COLUMN_LEVL         = 'levl';
    const COLUMN_ZKUSENOSTI   = 'zkusenosti';
    const COLUMN_ENERGIE      = 'energie';
    const COLUMN_STESTI       = 'stesti';
    const COLUMN_INTELIGENCE  = 'inteligence';
    const COLUMN_SOUSTREDENI  = 'soustredeni';
    const COLUMN_ZNAMKA       = 'znamka';
    const COLUMN_POHLAVI      = 'pohlavi';

	private $database = null;

    private $columns = [USER::COLUMN_ID,
                        USER::COLUMN_USER_NAME,
                        USER::COLUMN_USER_EMAIL,
                        USER::COLUMN_USER_PASS,
                        USER::COLUMN_TOKEN_CODE,
                        USER::COLUMN_USER_STATUS,
                        USER::COLUMN_LEVL,
                        USER::COLUMN_ZKUSENOSTI,
                        USER::COLUMN_ENERGIE,
                        USER::COLUMN_STESTI,
                        USER::COLUMN_INTELIGENCE,
                        USER::COLUMN_SOUSTREDENI,
                        USER::COLUMN_ZNAMKA,
                        USER::COLUMN_POHLAVI,
                       ];

    private $id           = null;
	private $userName     = null;
    private $userEmail    = null;
    private $userPassword = null;
    private $tokenCode   = null;
    private $userStatus   = null;
    private $levl         = null;
    private $zkusenosti   = null;
    private $energie      = null;
    private $stesti       = null;
    private $inteligence  = null;
    private $soustredeni  = null;
    private $znamka       = null;
    private $pohlavi      = null;

    public function __construct($id = null)
    {
        $this->database = new Database();

        if($id !== null)
        {
            $this->load($id);
        }
    }

    /* setry */
    public function setId($value)           { $this->id = $value; }
    public function setUserName($value)     { $this->userName = $value; }
    public function setUserEmail($value)    { $this->userEmail = $value; }
    public function setUserPassword($value) { $this->userPassword = $value; }
    public function setTokenCode($value)    { $this->tokenCode = $value; }
    public function setUserStatus($value)   { $this->userStatus = $value; }
    public function setLevl($value)         { $this->levl = $value; }
    public function setZkusenosti($value)   { $this->zkusenosti = $value; }
    public function setEnergie($value)      { $this->energie = $value; }
    public function setStesti($value)       { $this->stesti = $value; }
    public function setInteligence($value)  { $this->inteligence = $value; }
    public function setSoustredeni($value)  { $this->soustredeni = $value; }
    public function setZnamka($value)       { $this->znamka = $value; }
    public function setPohlavi($value)      { $this->pohlavi = $value; }

    /* getry */
    public function getId()                 { return $this->id; }
    public function getUserName()           { return $this->userName; }
    public function getUserEmail()          { return $this->userEmail; }
    public function getUserPassword()       { return $this->userPassword; }
    public function getTokenCode()          { return $this->tokenCode; }
    public function getUserStatus()         { return $this->userStatus; }
    public function getLevl()               { return $this->levl; }
    public function getZkusenosti()         { return $this->zkusenosti; }
    public function getEnergie()            { return $this->energie; }
    public function getStesti()             { return $this->stesti; }
    public function getInteligence()        { return $this->inteligence; }
    public function getSoustredeni()        { return $this->soustredeni; }
    public function getZnamka()             { return $this->znamka; }
    public function getPohlavi()            { return $this->pohlavi; }

	public function register()
	{
        $result = null;

		try
		{
            $data = [USER::COLUMN_USER_NAME   => $this->getUserName(),
                     USER::COLUMN_USER_EMAIL  => $this->getUserEmail(),
                     USER::COLUMN_USER_PASS   => $this->getUserPassword(),
                     USER::COLUMN_TOKEN_CODE  => $this->getTokenCode(),
                     USER::COLUMN_USER_STATUS => $this->getUserStatus(),
                     USER::COLUMN_LEVL        => $this->getLevl(),
                     USER::COLUMN_ZKUSENOSTI  => $this->getZkusenosti(),
                     USER::COLUMN_ENERGIE     => $this->getEnergie(),
                     USER::COLUMN_STESTI      => $this->getStesti(),
                     USER::COLUMN_INTELIGENCE => $this->getInteligence(),
                     USER::COLUMN_SOUSTREDENI => $this->getSoustredeni(),
                     USER::COLUMN_ZNAMKA      => $this->getZnamka(),
                     USER::COLUMN_POHLAVI     => $this->getPohlavi()
                    ];
		    $result = $this->database->insert(USER::TABLE, $data);

		    $id = $this->database->getLastId();
		    $this->setId($id);
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}

		return $result;
	}

	public function save()
    {
        $result = null;

        try
        {
            $id = $this->getId();

            $data = [USER::COLUMN_USER_NAME   => $this->getUserName(),
                     USER::COLUMN_USER_EMAIL  => $this->getUserEmail(),
                     USER::COLUMN_USER_PASS   => $this->getUserPassword(),
                     USER::COLUMN_TOKEN_CODE  => $this->getTokenCode(),
                     USER::COLUMN_USER_STATUS => $this->getUserStatus(),
                     USER::COLUMN_LEVL        => $this->getLevl(),
                     USER::COLUMN_ZKUSENOSTI  => $this->getZkusenosti(),
                     USER::COLUMN_ENERGIE     => $this->getEnergie(),
                     USER::COLUMN_STESTI      => $this->getStesti(),
                     USER::COLUMN_INTELIGENCE => $this->getInteligence(),
                     USER::COLUMN_SOUSTREDENI => $this->getSoustredeni(),
                     USER::COLUMN_ZNAMKA      => $this->getZnamka(),
                     USER::COLUMN_POHLAVI     => $this->getPohlavi()
            ];
            $result = $this->database->update(USER::TABLE, $data, $id);
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }

        return $result;
    }
    public function loadByMail($email)
    {
        try
        {
            $data = $this->database->getByProperty(USER::TABLE, $this->columns, USER::COLUMN_USER_EMAIL, $email);

            if(count($data) > 0)
            {
                $this->setId($data[USER::COLUMN_ID]);
                $this->setUserName($data[USER::COLUMN_USER_NAME]);
                $this->setUserEmail($data[USER::COLUMN_USER_EMAIL]);
                $this->setUserPassword($data[USER::COLUMN_USER_PASS]);
                $this->setTokenCode($data[USER::COLUMN_TOKEN_CODE]);
                $this->setUserStatus($data[USER::COLUMN_USER_STATUS]);
                $this->setLevl($data[USER::COLUMN_LEVL]);
                $this->setZkusenosti($data[USER::COLUMN_ZKUSENOSTI]);
                $this->setEnergie($data[USER::COLUMN_ENERGIE]);
                $this->setStesti($data[USER::COLUMN_STESTI]);
                $this->setInteligence($data[USER::COLUMN_INTELIGENCE]);
                $this->setSoustredeni($data[USER::COLUMN_SOUSTREDENI]);
                $this->setZnamka($data[USER::COLUMN_ZNAMKA]);
                $this->setPohlavi($data[USER::COLUMN_POHLAVI]);
            }
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function load($id)
    {
        try
        {
            $data = $this->database->getByProperty(USER::TABLE, $this->columns, USER::COLUMN_ID, $id);

            if(count($data) > 0)
            {
                $this->setId($data[USER::COLUMN_ID]);
                $this->setUserName($data[USER::COLUMN_USER_NAME]);
                $this->setUserEmail($data[USER::COLUMN_USER_EMAIL]);
                $this->setUserPassword($data[USER::COLUMN_USER_PASS]);
                $this->setTokenCode($data[USER::COLUMN_TOKEN_CODE]);
                $this->setUserStatus($data[USER::COLUMN_USER_STATUS]);
                $this->setLevl($data[USER::COLUMN_LEVL]);
                $this->setZkusenosti($data[USER::COLUMN_ZKUSENOSTI]);
                $this->setEnergie($data[USER::COLUMN_ENERGIE]);
                $this->setStesti($data[USER::COLUMN_STESTI]);
                $this->setInteligence($data[USER::COLUMN_INTELIGENCE]);
                $this->setSoustredeni($data[USER::COLUMN_SOUSTREDENI]);
                $this->setZnamka($data[USER::COLUMN_ZNAMKA]);
                $this->setPohlavi($data[USER::COLUMN_POHLAVI]);
            }

        }
        catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

	public function login($email, $upass)
	{
		try
		{
		    $data = $this->database->getByProperty(USER::TABLE, $this->columns, USER::COLUMN_USER_EMAIL, $email);

            $_SESSION['userSession'] = null;

		    if(count($data) > 0 && $data[USER::COLUMN_USER_PASS] == sha1($upass))
            {
                $this->setId($data[USER::COLUMN_ID]);
                $this->setUserName($data[USER::COLUMN_USER_NAME]);
                $this->setUserEmail($data[USER::COLUMN_USER_EMAIL]);
                $this->setUserPassword($data[USER::COLUMN_USER_PASS]);
                $this->setTokenCode($data[USER::COLUMN_TOKEN_CODE]);
                $this->setUserStatus($data[USER::COLUMN_USER_STATUS]);
                $this->setLevl($data[USER::COLUMN_LEVL]);
                $this->setZkusenosti($data[USER::COLUMN_ZKUSENOSTI]);
                $this->setEnergie($data[USER::COLUMN_ENERGIE]);
                $this->setStesti($data[USER::COLUMN_STESTI]);
                $this->setInteligence($data[USER::COLUMN_INTELIGENCE]);
                $this->setSoustredeni($data[USER::COLUMN_SOUSTREDENI]);
                $this->setZnamka($data[USER::COLUMN_ZNAMKA]);
                $this->setPohlavi($data[USER::COLUMN_POHLAVI]);

                if($data[USER::COLUMN_USER_STATUS] == USER::IS_ACTIVATE)
                {
                    $_SESSION['userSession'] = base64_encode($data[USER::COLUMN_ID]);
                }
            }

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public static function isLoggedIn()
	{
	    $result = false;
		if(isset($_SESSION['userSession']) && $_SESSION['userSession'] !== null)
		{
            $result = true;
		}
		return $result;
	}

	public static function logout()
	{
		$_SESSION['userSession'] = null;
	}

    public static function existEmail($email)
    {
        $database = new Database();
        $data = $database->getByProperty(USER::TABLE, [USER::COLUMN_USER_EMAIL], USER::COLUMN_USER_EMAIL, $email);
        $result = ($data && count($data) > 0);
        return $result;
    }

    public static function existUserName($uname) {
        $database = new Database();
        $data = $database->getByProperty(USER::TABLE, [USER::COLUMN_USER_NAME], USER::COLUMN_USER_NAME, $uname);
        $result = ($data && count($data) > 0);
        return $result;
    }

}