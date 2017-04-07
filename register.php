<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 00:25
 */
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$levl = 1;
	$zkusenosti = 0;
	$energie = 100;
	$stesti = 1;
	$inteligence = 1;
	$soustredeni = 1;
	$znamka = 0;
	$pohlavi = trim($_POST['pohlavi']);

	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "<div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					Na tento email už byl vytvořen účet.
			  </div>";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$levl,$zkusenosti,$energie,$stesti,$inteligence,$soustredeni,$znamka,$pohlavi,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "Dobrý den $uname,
						<br /><br />
						Vítejte v naší malé VUT hře<br/>
						Pro registraci pokračujte přes odkaz níže<br/>
						<br /><br />
						<a href='http://www.suprweb.php5.cz/verify.php?id=$id&code=$code'>Klikněte zde pro aktivaci vašeho účtu</a>
						<br /><br />
						Děkujeme za registraci";
						
			$subject = "Potvrďte registracu";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Výborně!</strong>  Na adresu $email
                    jsme zaslali aktivační link, po kterém bude tvoje registrace platná.
			  		</div>
					";
		}
		else
		{
			echo "Omlouváme se nastala chyba";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registrace</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Registrace</h2><hr />
        <input type="text" class="input-block-level" placeholder="Login" name="txtuname" required>
        <input type="email" class="input-block-level" placeholder="Email" name="txtemail" required>
        <input type="password" class="input-block-level" placeholder="Heslo" name="txtpass" required>
          <label>
              <input type="radio" class="radio-inline" name="pohlavi" value="M"> Muž
          </label>
          <label>
              <input type="radio" class="radio-inline" name="pohlavi" value="W"> Žena
          </label>
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Registrovat</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Přihlásit</a>
      </form>

    </div>
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>