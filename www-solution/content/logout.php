<?php
//zrusime session
$_SESSION = array();
session_destroy();
//A10 posleme pouzivatela na stranku kde sa nachadza login ;)
header("LOCATION: index.php");
?>
