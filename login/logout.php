<?php 
	session_start();
	unset($_SESSION["nip"]);
	session_destroy();
	header("location:../index.php");
?>
