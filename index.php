<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 20:20
 */
session_start();
require_once 'models/user.php';
require_once 'basicPublicController.php';
$user_login = new USER();
$basic = new basicPublicController();

if($user_login->isLoggedIn())
{
	$basic->redirect('home.php');
}

if(isset($_POST['login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email, $upass))
	{
		$basic->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Přihlášení | VUT game</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/layout.css" rel="stylesheet" media="screen">
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				Tento účet není aktivovaný, prosím zkontrolujte si emailovou schránku kam vám byl zasklán aktivační link.
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Nesprávné zadání</strong>
			</div>
            <?php
		}
		?>
        <h2 class="form-signin-heading">Přihlášení</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Heslo" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="login">Přihlásit</button>
        <a href="register.php" style="float:right;" class="btn btn-large">Registrovat</a><hr />
        <a href="fpass.php">Zapomněl jsi heslo?</a>
      </form>

    </div>
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>