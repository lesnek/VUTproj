<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 6.4.17
 * Time: 1:01
 */
session_start();
require_once 'models/user.php';
require_once 'basicPublicController.php';

$user = new USER();
$basic = new basicPublicController();

if($user->isLoggedIn()!="")
{
	$basic->redirect('home.php');
}

if(isset($_POST['submit']))
{
	$email = $_POST['txtemail'];
	
	$emailVerify = $user->getUserEmail();
	$code = $user->getTokenCode();
	if($email == $emailVerify)
	{
		$mail = new MyMail();
		$mail->sendForgotPassword($user, $code);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Resetovací link byl odeslán na adresu $email.
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Na tento email nebyl vytvořen žádný účet. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Zapomenuté heslo</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/layout.css" rel="stylesheet" media="screen">
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Zapomenuté heslo</h2><hr />
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Prosím zadejte email na který máte založený účet. Bude vám na něj zaslán resetovací link.
				</div>  
                <?php
			}
			?>
        
        <input type="email" class="input-block-level" placeholder="Email @" name="txtemail" required />
     	<hr />
        <button class="btn btn-danger btn-primary" type="submit" name="submit">Vygenerovat nové heslo</button>
      </form>

    </div>
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>