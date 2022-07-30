<?php 
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];

	if($p1 != NULL){
	if(strlen($p1) < 6 ){
		$message = "At least 6 characters are required.";
	} else{
		$message = "";
	} }


echo $message;



?>