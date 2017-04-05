<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Hesla nesouhlasí!
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Heslo změněno
						</div>";
				header("refresh:5;index.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				Účet nebyl nalezen, zkuste reset znovu nebo nás kontaktujte.
				</div>";
				
	}
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Reset hesla</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">

  </head>
  <body id="login">
    <div class="container">
    	<div class='alert alert-success'>
			<strong>Ahoj!</strong>  <?php echo $rows['userName'] ?>, na této stránce můžete resetovat heslo
		</div>
        <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Reset hesla</h3><hr>
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
        <input type="password" class="input-block-level" placeholder="Nové heslo" name="pass" required>
        <input type="password" class="input-block-level" placeholder="Potvrďte nové heslo" name="confirm-pass" required>
     	<hr>
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Resetovat heslo</button>
        
      </form>

    </div>
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>