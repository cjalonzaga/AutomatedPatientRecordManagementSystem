<?php
	
	$username = 'admin_aprms';
	$password = '';

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password) {

			//include 'patients/index.php';
			header('Location: http://localhost/aprms/patients/');
			exit();
		}
	}
	
	include 'index.welcome.php';
?>