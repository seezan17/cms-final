
<?php
	require 'auth.php';
	$a = $_GET['a'];
	$b = $_GET['b'];
	$c = $_GET['c'];
	$d = $_GET['d'];
	if($a == 'swastik_questions'){
		$delete = $obj_admin->delete("swastik_replies","r_to",$c);
	}
	$verify = $obj_admin->delete($a,$b,$c);
	if($a == 'swastik_resources'){
		header('Location: ../public.php');
	}
	if($a=="swastik_replies"){
		header('Location: ../replies.php?q='.$d);
	}
	if($a=="swastik_feedback"){
		header('Location: ../feedback.php');
	}
	else{
	header('Location: ../manage.php'); }

?>
