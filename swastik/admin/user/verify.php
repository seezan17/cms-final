<?php
	 include 'auth.php';

	echo "hi";
	$id = $_GET['id'];
	echo $id;
	$verify = $obj_admin->verifyUser($id);
	
	header('Location: ../home.php');

?>