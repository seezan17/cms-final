<?php
$e = $_POST['e'];
require '../f-e/public_auth.php';
 $info = $obj_admin->emailValidation($e);
 echo $info;


?>