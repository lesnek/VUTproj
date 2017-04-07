<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 23:36
 */

require_once 'dbconfig.php';

class USER
{
    const IS_ACTIVATE         = 'Y';
    const TABLE               = 'tbl_users';

    const COLUMN_USER_NAME    = 'userName';
    const COLUMN_USER_EMAIL   = 'userEmail';
    const COLUMN_USER_PASS    = 'userPass';
    const COLUMN_TOKEN_CODE   = 'tokenCode';
    const COLUMN_LEVL         = 'levl';
    const COLUMN_ZKUSENOSTI   = 'zkusenosti';
    const COLUMN_ENERGIE      = 'energie';
    const COLUMN_STESTI       = 'stesti';
    const COLUMN_INTELIGENCE  = 'inteligence';
    const COLUMN_SOUSTREDENI  = 'soustredeni';
    const COLUMN_ZNAMKA       = 'znamka';
    const COLUMN_POHLAVI      = 'pohlavi';

	private $database = null;

    private $columns = [USER::COLUMN_USER_NAME,
                        USER::COLUMN_USER_EMAIL,
                        USER::COLUMN_USER_PASS,
                        USER::COLUMN_TOKEN_CODE,
                        USER::COLUMN_LEVL,
                        USER::COLUMN_ZKUSENOSTI,
                        USER::COLUMN_ENERGIE,
                        USER::COLUMN_STESTI,
                        USER::COLUMN_INTELIGENCE,
                        USER::COLUMN_SOUSTREDENI,
                        USER::COLUMN_ZNAMKA,
                        USER::COLUMN_POHLAVI,
                       ];

	private $userName     = null;
    private $userEmail    = null;
    private $userPassword = null;
    private $token_code   = null;
    private $levl         = null;
    private $zkusenosti   = null;
    private $energie      = null;
    private $stesti       = null;
    private $inteligence  = null;
    private $soustredeni  = null;
    private $znamka       = null;
    private $pohlavi      = null;

    public function __construct()
    {
        $this->database = new Database();
    }

    /* setry */
    public function setUserName($value)     { $this->userName = $value; }
    public function setUserEmail($value)    { $this->userEmail = $value; }
    public function setUserPassword($value) { $this->userPassword = sha1($value); }
    public function setTokenCode($value)    { $this->token_code = $value; }
    public function setLevl($value)         { $this->levl = $value; }
    public function setZkusenosti($value)   { $this->zkusenosti = $value; }
    public function setEnergie($value)      { $this->energie = $value; }
    public function setStesti($value)       { $this->stesti = $value; }
    public function setInteligence($value)  { $this->inteligence = $value; }
    public function setSoustredeni($value)  { $this->soustredeni = $value; }
    public function setZnamka($value)       { $this->znamka = $value; }
    public function setPohlavi($value)      { $this->pohlavi = $value; }

    /* getry */
    public function getUserName()           { return $this->userName; }
    public function getUserEmail()          { return $this->userEmail; }
    public function getUserPassword()       { return $this->userPassword; }
    public function getTokenCode()          { return $this->token_code; }
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
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}

		return $result;
	}
	
	public function login($email)
	{
		try
		{
		    $data = $this->database->getByProperty(USER::TABLE, $this->columns, USER::COLUMN_USER_EMAIL, $email);

		    if(count($data) > 0)
            {
				if($data[USER::COLUMN_TOKEN_CODE] == USER::IS_ACTIVATE)
				{
					if($data[USER::COLUMN_USER_PASS] == $this->getUserPassword())
					{
						$_SESSION['userSession'] = $data['userID'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage(); 
		}
	}
	
	
	public static function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.seznam.cz";
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="vutgame@email.cz";
		$mail->Password="studentvpn";
		$mail->SetFrom('vutgame@email.cz','VUTgame');
		$mail->AddReplyTo("vutgame@email.cz","VUTgame");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}