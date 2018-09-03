<?php
session_start();
	unset($_SESSION['symb']);
	unset($_SESSION['fname']);
	unset($_SESSION['pass']);
	header("refresh:0,url=index.php");
session_destroy();
?>