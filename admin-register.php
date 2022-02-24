 <?php
 include('admin_DB.php');
 $msg="";
 if(isset($_POST['submit'])){
     $name=$_POST['name'];
     $mobile=$_POST['mobile'];
     $email=$_POST['email'];
     $password=$_POST['password'];
     $cpassword=$_POST['cpassword'];

     $check=mysqli_num_rows(mysqli_query($con,"select * from admin_data where admin_email='$email'"));
     if($check>0){
        $msg="This Email Id is already Register.";
     }else{ 
        $verification_id=rand(11111,99999);
        mysqli_query($con,"insert into admin_data(admin_name,admin_mob,admin_email,admin_pass,admin_cpass,admin_verification) value('$name','$mobile','$email','$password','$cpassword',0)");
    
        $mailHtml="Please";
		
        smtp_mailer($email,'OTP Verification',$mailHtml);
    
    }
    }
 
    


    function smtp_mailer($to,$subject, $msg){
        require_once("smtp/class.phpmailer.php");
        $mail = new PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 1; 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'TLS'; 
        $mail->Host = "smtp.sendgrid.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "SHAIKHABDULRAZA";
        $mail->Password = "123456789_mini_project";
        $mail->SetFrom("shaikhrazaweb@gmail.com");
        $mail->Subject = $subject;
        $mail->Body =$msg;
        $mail->AddAddress($to);
        if(!$mail->Send()){
            return 0;
        }else{
            return 1;
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Register Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #00a8ff;
}

.wrapper {
    background: white;
    padding: 30px 30px;
    width: 500px;
    margin: 30px;
}

.wrapper .title {
    border-left: 5px solid #00a8ff;
    padding-left: 5px;
    margin-bottom: 15px;
}

.input-field {
    display: block;
    margin: 10px 0;
    width: 100%;
    margin-bottom: 30px;
    position: relative;
}

.input-field .input-label {
    display: flex;
    font-size: 15px;
    margin-bottom: 2px;
}

.input-field .input {
    font-family: 'Poppins', sans-serif;
    border: 1px solid #ccc;
    background: transparent;
    outline: none;
    width: 100%;
    padding: 10px;
    font-size: 15px;
    transition: 0.3s all ease;
}

.input-field .input:focus {
    border-color: #00a8ff;
}

.input-field.success input{
    border-color: #2ecc71;
}

.input-field.error input{
    border-color: #e74c3c;
}
 
.input-field i{
    position: absolute;
    right: 5%;
    top: 40px;
    visibility: hidden;
}

.input-field.success i.fa-check-circle{
    color: #2ecc71;
    visibility: visible;
}
.input-field.error i.fa-exclamation-circle{
    color: #e74c3c;
    visibility: visible;
}


.input-field small{
    color: #e74c3c;
    position:absolute; 
    left: 0;
    visibility: hidden;
}

.input-field.error small{
    visibility:visible ;
}

.btn {
    font-family: 'Poppins', sans-serif;
    background: #00a8ff;
    color: white;
    padding: 10px;
    width: 100%;
    font-size: 15px;
    border: 1px solid transparent;
    cursor: pointer;
    margin: 5px 0;
    transition: 0.3s all ease;
}

.btn:hover, .btn:focus {
    background: transparent;
    border-color: #00a8ff;
    color: #00a8ff;
}

.wrapper .form p {
    margin: 5px 0;
    text-align: center;
}

.wrapper .form p a {
    text-decoration: none;
    color: #333;
    transition: 0.3s all ease;
}

.wrapper .form p a:focus, .wrapper .form p a:hover {
    color: #00a8ff;
}


.second_box{display:none;}
.field_error{color:red;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="title">Admin Register</h2>
        <div class="msg" style="color:red;">
            <?php
            echo $msg;
            ?>
       </div>
        <form action="" method="post" class="form" id="form_1">
            <div class="input-field first_box" >
                <label for="name" class="input-label">Name </label>
                <input type="name" name="name" id="name" class="input" placeholder="Admin" autocomplete="off">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>

            <div class="input-field first_box">
                <label for="number" class="input-label">Mobile </label>
                <input type="number" name="mobile" id="mobile" class="input" placeholder="Enter your mobile"  autocomplete="off">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>

            <div class="input-field first_box">
                <label for="email" class="input-label">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Enter your email"  autocomplete="off">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>

        
            <div class="input-field first_box">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" id="password" class="input" placeholder="Enter your password" autocomplete="off">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>

            <div class="input-field first_box">
                <label for="cpassword" class="input-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="input" placeholder="Enter your confirm password" autocomplete="off">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>
            
            <button class="btn first_box" name="button" value="button" onclick="send_otp()">Register</button>
            <p>You have already an account! <a href="admin-login.php">Login</a>. <a href="index.php" style="color:red;">Close</a></p>
        
        
        
        

          

          

            <div class="input-field second_box">
                <label for="otp" class="input-label">OTP</label>
                <input type="otp" name="otp" id="otp" class="input" placeholder="Enter your OTP"  autocomplete="off">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Msg Error</small>
            </div>           
            <button class="btn second_box" name="submit" value="submit" onclick="submit_otp()">Submit</button>
            <p class="second_box">You have already an account! <a href="admin-login.php">Login</a>. <a href="index.php" style="color:red;">Close</a></p>
        </form>
    </div>
   
    <script>
function send_otp(){
	var email=jQuery('#email').val();
	jQuery.ajax({
		url:'send_otp.php',
		type:'post',
		data:'email='+email,
		success:function(result){
			if(result=='yes'){
				jQuery('.second_box').show();
				jQuery('.first_box').hide();
			}
			if(result=='not_exist'){
				jQuery('#email_error').html('Please enter valid email');
			}
		}
	});
}

function submit_otp(){
	var otp=jQuery('#otp').val();
	jQuery.ajax({
		url:'check_otp.php',
		type:'post',
		data:'otp='+otp,
		success:function(result){
			if(result=='yes'){
				window.location='dashboard.php'
			}
			if(result=='not_exist'){
				jQuery('#otp_error').html('Please enter valid otp');
			}
		}
	});
}
</script>
</body>
</html>