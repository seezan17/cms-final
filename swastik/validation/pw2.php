<?php 
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];


	if($p2 != NULL){
		if($p1 != $p2){
			$message = "Passwords don't matched";
		}
	}

echo $message;



?>