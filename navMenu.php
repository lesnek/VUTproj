<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 7.4.17
 * Time: 11:00
 */
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="home.php">VUT game</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle"
                           data-toggle="dropdown">lvl <?php echo $user->getLevl(); ?> <i class="icon-user"></i>
                            <?php echo $user->getUserName() ?> <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="logout.php">Odhlásit</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav">
                    <li>
                        <a href="postava.php">Postava</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tutorials <b class="caret"></b>

                        </a>
                        <ul class="dropdown-menu" id="menu1">
                            <li><a href="http://www.codingcage.com/search/label/PHP OOP">PHP OOP</a></li>
                            <li><a href="http://www.codingcage.com/search/label/PDO">PHP PDO</a></li>
                            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
                            <li><a href="http://www.codingcage.com/search/label/Bootstrap">Bootstrap</a></li>
                            <li><a href="http://www.codingcage.com/search/label/CRUD">CRUD</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://www.codingcage.com/2015/09/login-registration-email-verification-forgot-password-php.html">Tutorial
                            Link</a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>
<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="assets/scripts.js"></script>