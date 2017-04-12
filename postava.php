<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 9:20
 */
session_start();
require_once 'models/user.php';
require_once 'basicPublicController.php';
$user_home = new USER();
$basic = new basicPublicController();

if(!$user_home->isLoggedIn())
{
    $basic->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">

<head>
    <title>VUTgame | <?php echo $row['userName']; ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/layout.css" rel="stylesheet" media="screen">
</head>

<body>
<?php include_once "navMenu.php"?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="col-sm-4">
                    <img src="pics/iceking.png">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
