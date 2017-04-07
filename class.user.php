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

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$levl,$zkusenosti,$energie,$stesti,$inteligence,$soustredeni,$znamka,$pohlavi,$code)
	{
		try
		{							
			$password = sha1($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode,levl,zkusenosti,energie,stesti,inteligence,soustredeni,znamka,pohlavi) 
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code, :user_level, :zkusenosti, :energie, :stesti, :inteligence, :soustredeni, :znamka, :pohlavi)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->bindParam(":user_level",$levl);
            $stmt->bindParam(":zkusenosti",$zkusenosti);
            $stmt->bindParam(":energie",$energie);
            $stmt->bindParam(":stesti",$stesti);
            $stmt->bindParam(":inteligence",$inteligence);
            $stmt->bindParam(":soustredeni",$soustredeni);
            $stmt->bindParam(":znamka",$znamka);
            $stmt->bindParam(":pohlavi",$pohlavi);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==sha1($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
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
	
	
	public function is_logged_in()
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