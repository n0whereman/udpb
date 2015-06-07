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

CLASS CSRF
{

	/***/
	public function get_token_id()
	{
		if(isset($_SESSION['token_id'])) {
			return $_SESSION['token_id'];
		} else {
			$token_id = $this->random(10);
			$_SESSION['token_id'] = $token_id;
			return $token_id;
		}
	}

	public function get_token() {
		if(isset($_SESSION['token_value'])) {
			return $_SESSION['token_value'];
		} else {
			$token = hash('sha256', $this->random(500));
			$_SESSION['token_value'] = $token;
			return $token;
		}

	}

	public function check_valid($method) {
		if($method == 'post' || $method == 'get') {
			$post = $_POST;
			$get = $_GET;
			if(isset(${$method}[$this->get_token_id()]) && (${$method}[$this->get_token_id()] == $this->get_token())) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function form_names($names, $regenerate) {

		$values = array();
		foreach ($names as $n) {
			if($regenerate == true) {
				unset($_SESSION[$n]);
			}
			$s = isset($_SESSION[$n]) ? $_SESSION[$n] : $this->random(10);
			$_SESSION[$n] = $s;
			$values[$n] = $s;
		}
		return $values;
	}

	private function random($len) {
		if (function_exists('openssl_random_pseudo_bytes')) {
			$byteLen = intval(($len / 2) + 1);
			$return = substr(bin2hex(openssl_random_pseudo_bytes($byteLen)), 0, $len);
		} elseif (@is_readable('/dev/urandom')) {
			$f=fopen('/dev/urandom', 'r');
			$urandom=fread($f, $len);
			fclose($f);
			$return = '';
		}

		if (empty($return)) {
			for ($i=0;$i<$len;++$i) {
				if (!isset($urandom)) {
					if ($i%2==0) {
						mt_srand(time()%2147 * 1000000 + (double)microtime() * 1000000);
					}
					$rand=48+mt_rand()%64;
				} else {
					$rand=48+ord($urandom[$i])%64;
				}

				if ($rand>57)
					$rand+=7;
				if ($rand>90)
					$rand+=6;

				if ($rand==123) $rand=52;
				if ($rand==124) $rand=53;
				$return.=chr($rand);
			}
		}

		return $return;
	}
}

$csrf = new CSRF();
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
							//A4 - dopiseme .php co (naoko) zabrani lfi v page
                            @$pages=$_GET["page"];
                            if(!isLogin()) { $pages='login'; }
                            if (!isset($pages) || empty($pages)){
                                require("content/home.php");
                            }elseif (file_exists("content/$pages.php")) {
                                require("content/$pages.php");
                            }else{require ("content/error_page.php");}
							//A4 - bacha na tie linky
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
										//A10 - zmazeme sessiond_id
                                        echo '<li><a href="./?page=logout&go_page=index.php">Odhlásiť sa</a></li>';
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
			</div>
	</body>
</html>
