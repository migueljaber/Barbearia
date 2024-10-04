<?php

	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['senha']);
	header("Location: cadastro/login.php");

?>