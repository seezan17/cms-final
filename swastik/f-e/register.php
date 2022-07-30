<?php
require 'public_auth.php';

$fullname = "";
$email = "";
$password1 = "";
$password2 = "";
$code = "";


if(isset($_POST['submit-register'])){
 $info = $obj_admin->add_new_user($_POST);

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $code = $_POST['code'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <title>Register</title>
    <link rel="stylesheet" href="../style/style-public.css">
    <link rel="stylesheet" href="../style/style-public-form.css">


</head>

<body>
    <div class="bg-img"></div>

    <div class="container">
        <div class="fixed">
            <div class="header">

                <div class="logo-section">
                    <img src="../img/swastik-logo-red.png">
                </div>

                <div class="menu-section">
                    <a href="index.html" id="about-us">About Us</a>
                    <a href="contact.php" id="contact">Contact</a>
                    <a href="login.php" id="login">Log In</a>
                    <a href="#" class="active" id="register">Register</a>
                </div>

            </div>
        </div>
        <div class="body">

            <div class="content">


                <div class="form form-register">
                    <h3 class="topic">Sign Up</h3>
                    <form method="post">

                        <label for="">Who?</label>
                        <select name="who" onmouseover="forStudents(value)" onclick ="forStudents(value)">
                            <option value="1" >Teacher</option>
                            <option value="0" selected>Student</option>
                        </select>

                        <div id="forStudents">
                        <label for="">Faculty</label>
                        <select name="faculty">
                            <option value="1">CSIT</option>
                            <option value="0" >BCA</option>
                        </select>  

                        <label for="">Semester</label>
                        <select name="semester">
                            <option value="1">First</option>
                            <option value="2" >Second</option>
                            <option value="3">Third</option>
                            <option value="4" >Fourth</option>
                            <option value="5">Fifth</option>
                            <option value="6" >Sixth</option>
                            <option value="7">Seventh</option>
                            <option value="8" >Eighth</option>
                        </select>  
                        </div>



                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname" value="<?php echo $fullname ?>" required>
                        <div id="name-msg" class="error"> </div>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"  value="<?php echo $email ?>" onblur="validateEmail(value)" required>
                        <div id="email-msg" class="error"> </div>

                        <label for="password">Password</label>
                        <input type="password" id="password1" name="password1" value="<?php echo $password1 ?>" required>
                        <div id="pass1-msg" class="error"> </div>

                        <label for="password">Confirm Password</label>
                        <input type="password" id="password2" name="password2" value="<?php echo $password2 ?>" required> 
                        <div id="pass2-msg" class="error"> </div>

                        <label for="code">Student/Teacher Code</label>
                        <input type="text" name="code" value="<?php echo $code ?>" required> 

                        <?php if(isset($info)){ ?>
                        <a class="error"><?php echo $info; ?></a>
              <?php } ?>

                        <input type="submit" id="submit" name="submit-register"  value="Sign Up">

                    </form>
                    <div class="form-bottom">
                        <span class=" center"><a href="login.php" id="login-btm">Already Have an account?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

    function forStudents(who){
        if (who==1) {
            document.getElementById('forStudents').style.display="none";
        }else{
            document.getElementById('forStudents').style.display="block";
        }
    }

    

    function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(email)) {
        document.getElementById('email-msg').innerHTML ='';
        
    } else {
        document.getElementById('email-msg').innerHTML ='Invalid Email';
        
    }
}


setInterval(function() {
    let pw1 = document.getElementById('password1').value;
    let pw2 = document.getElementById('password2').value;
    
    if(pw1!=""){
        if(pw1.length<6){
        document.getElementById('pass1-msg').innerHTML ='At least 6 characters are required.';
        
    } else{
        document.getElementById('pass1-msg').innerHTML =' ';   
    }
    }


    if(pw2!=""){
        if(pw1!=pw2){
        document.getElementById('pass2-msg').innerHTML ='Password not matched ';
        
     } else{
        document.getElementById('pass2-msg').innerHTML ='';
        
    }

    }
    
    }, 1);



  
</script>



</body>

</html>