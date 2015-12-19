<?php
	session_start();
	session_unset($_SESSION['idusuario']);
	session_unset($_SESSION['login']);
	session_unset($_SESSION['nombre']);
	session_destroy();
	header("location:../index.php");
?>