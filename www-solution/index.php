<?php
session_start();
ob_start();
include_once('include/db.php');
function isLogin() {
    if(@$_SESSION['id'] > 0){
        return true;
    }else{
        return false;
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>VulnerableBlog9000</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div class="inner">
                            <?php

                            @$pages=$_GET["page"];
                            if(!isLogin()) { $pages='login'; }
//                            var_dump($_SESSION);
                            if (!isset($pages) || empty($pages)){
                                require("content/home.php");
                            }elseif (file_exists("content/$pages.php")) {
//                            }elseif (file_exists("content/$pages.php")) {
                                require("content/$pages.php");
//                                require("content/$pages.php");
                            }else{require ("content/error_page.php");}

                            /*
                             * Ak to osetris tak musis vsetky linky prepisat z hocico.php na hocico ... vymazat .php
                             */
                            ?>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<h1 id="logo"><a href="#">LameBlog</a></h1>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="current"><a href="./?page=">Články</a></li>
                                    <li><a href="./?page=kontakt">Kontakt</a></li>
                                    <?php
                                    if(isLogin()){
					//nepouzivaju sa nahodou Cookies? :)
                                        echo '<li><a href="./?page=logout&session_id='.session_id().'&go_page=index.php">Odhlásiť sa</a></li>';
                                    }else{
                                        echo '<li><a href="./?page=login">Login</a></li>';
                                    }
                                    ?>
								</ul>
							</nav>

						<!-- Search -->
							<section class="box search">
								<form method="post" action="index.php?page=search">
									<input type="text" class="text" name="search" placeholder="Search" />
								</form>
							</section>

						<!-- Copyright -->
							<ul id="copyright">
							</ul>
					</div>
                //<?php
                //nieco
                ?>-->
			</div>
<!-- http://192.168.56.102/preview.php?file=index.php -->
	</body>
</html>
