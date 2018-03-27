<?php
require ('../library/_local_universal_variables.php');
require('../library/_global_universal_variables.php');
require ('../library/_db_connect.php');
require ('../library/_my_functions.php');

if(isset($_POST['vb_submit'])) {
		
		$vb_firstname     = vfTools_Protect(ucwords(strtolower($_POST['vb_firstname'])));
		$vb_lastname      = vfTools_Protect(ucwords(strtolower($_POST['vb_lastname'])));
        $vb_email         = vfTools_Protect(strtolower($_POST['vb_email']));
		$vb_password      = $_POST['vb_password'];
		$vb_confirm_password     = $_POST['vb_confirm_password'];
		$vb_phone         = vfTools_SanitizeNumberOnly($_POST['vb_phone']);		
		$vb_hear_about_us        = FALSE; 
		$vb_password_md5  = md5($vb_password);
		
		////$vb_phone
		if(strlen($vb_phone) == '10'){
		$vb_phone = '1' . $vb_phone;
			}
		
		if(!$vb_hear_about_us){
		$vb_hear_about_us = 'N/A';
		}
				
        if(($vb_firstname) == '') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must enter your first name.</div>';
		} else if(strlen($vb_firstname) < '3') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must enter a valid first name.</div>';
        } else if(($vb_lastname) == '') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must enter your last name.</div>';
        } else if(strlen($vb_lastname) < '3') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must enter a valid last name.</div>';
        } else if(trim($vb_email) == '') {
        	$error = '<div class="vbbox vbalert-box">Attention! Please enter a valid email address.</div>';
        } else if(!vfEmail_IsThisAValidEmail($vb_email)){
        	$error = '<div class="vbbox vbalert-box">Attention! You have enter an invalid e-mail address, please try again.</div>';
		} else if(vfEmail_CheckIfThisEmailExists($vb_email) == TRUE) {
        	$error = "<div class='vbbox vbalert-box'>Attention! The Email: <strong>$vb_email</strong> is already in the system. You may be one of the members accounts imported by your Church Administrator! Please <a href='../vxforgotpass'>click here to retrieve your login password</a> to this new secure membership portal.</div>";
        } else if(trim($vb_password) == '') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must enter a password!</div>';
		} else if(trim(strlen($vb_password)) < 6) {
        	$error = '<div class="vbbox vbalert-box">Attention! Your password is too short! Minimum of 6 characters.</div>';			
		 } else if(!ctype_alnum($vb_password)) {
        	$error = '<div class="vbbox vbalert-box">Attention! Your password can only contain letters and numbers!</div>';
		 } else if(!vfTools_CheckIfPasswordContainsBothNumberAndLetter($vb_password)) {
        	$error = '<div class="vbbox vbalert-box">Attention! Your password must contain both letters and numbers!</div>';
		 } else if(trim($vb_password) != trim($vb_confirm_password)) {
        	$error = '<div class="vbbox vbalert-box">Attention! Your Password and Confirm Password are NOT the same!</div>';		 	
		} else if($vb_phone == '') {
        	$error = '<div class="vbbox vbalert-box">Attention! You must specify a phone number!</div>';
		} else if(!is_numeric($vb_phone)) {
        	$error = '<div class="vbbox vbalert-box">Attention! Phone number can only be digits. No space or dash. e.g. 2125554444</div>';
		} else if(strlen($vb_phone) < 10) {
        	$error = '<div class="vbbox vbalert-box">Attention! You must specify a valid phone number!</div>';			
		}
		
        if($error == '') {
    
require ('../library/_head.php');
?>
<script language="JavaScript">

function vbCheckForm(){
var message="";
var vbPasswdValue = document.reg.vb_password.value;

if (document.reg.vb_firstname.value.length==0){
	message+="Please enter your First Name";
}

if (document.reg.vb_firstname.value.length<3){
	message += (Boolean(message.length)) ? ", a valid Firstname" : "Please enter a valid Firstname";
}

if (document.reg.vb_lastname.value.length==0){
	message += (Boolean(message.length)) ? ", your Lastname" : "Please enter your Lastname";
}

if (document.reg.vb_lastname.value.length<3){
	message += (Boolean(message.length)) ? ", a valid Lastname" : "Please enter a valid Lastname";
}


if (document.reg.vb_phone.value.length<8){
	message += (Boolean(message.length)) ? ", Phone Number" : "Please enter a valid Phone Number";
}

if (document.reg.vb_email.value.length==0){
	message += (Boolean(message.length)) ? ", your Email Address" : "Please enter your Email Address";
}

if (document.reg.vb_email.value.length<5){
	message += (Boolean(message.length)) ? ", valid Email Address" : "Please enter a valid Email Address";
}

if (document.reg.vb_password.value.length==0){
	message += (Boolean(message.length)) ? ", your Password" : "Please enter your Password!";
}

if (document.reg.vb_password.value.length<6){
	message += (Boolean(message.length)) ? ", a minimum of 6 charaters Password" : "Your password is too short! Please enter a minimum of 6 Characters";
}else if (document.reg.vb_password.value!=document.reg.vb_confirm_password.value){
	message += (Boolean(message.length)) ? ", Password and Confirm Password do NOT match!" : "Password and Confirm Password do NOT match!";
}

if (document.reg.vb_password.value.length>5){
if (vbPasswdValue.match(/[^0-9a-z]/i)){
	message+=" Only a combination of letters and numbers are allowed in the Password fields!";
	
}else if(!vbPasswdValue.match(/\d/)){    
	message+=" At least one number is required in the Password fields!";
	
}else if(!vbPasswdValue.match(/[a-z]/i)){  
	message+=" At least one letter is required in the Password fields!";
}
}

if (message.length>0){
	alert(message);
	return false;
	}
else{
	return true;
	}
}

</script>		
    <!-- END HEADER -->   

<html>
	

			<div role="main" class="main" id="home">
<section class="parallax section section-text-light section-parallax section-center" data-stellar-background-ratio="0.5" style="background-image: url(../images/parallax.jpg);">
						<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2 class="mb-none"><strong>Welcome to <?php echo $church_name; ?> <br></strong></h2>
							</div>
						</div>
					</div>
				</section>

									<div class="container">

									<div class="row">
			
									<div class="col-sm-7">
										<div class="featured-box featured-box-primary align-left mt-xlg">
											<div class="box-content">
											<?php
			
			if(isset($_POST['vb_submit']) && $error == ''){
			
			echo "<h2 class='title-page'>&nbsp;&nbsp;&nbsp;&nbsp;Congratulations! <?php echo $vb_firstname;?> <?php echo $vb_lastname;?></h2>";
					
			}else{
			// echo "<div class='heads2'>Vomoz Sign-Up Form</div>";
			
			echo"  <h2 class='title-page'>Register for your $church_full_name Portal Management</h2>
                   <h4 class='heading-primary mb-none'>Already registered? <a href='../vxlogin'>please click here to login</a></h4> 			
                
				<p>
					Please fill out the form below and click on the Register button. All fields are required. 
				</p>";
						
   	 }
			
			?>
				<!-- <div id="usermessagea"></div> -->
				<?php echo $error; ?>
				
				 <?php
			  if(!isset($_POST['vb_submit']) || $error != '') // Do not edit.

			  ?>
									<form action="" method="post" name="reg" class="vb-form-contact" id="vb-form-contact">
									<ol class="cf-ol">
														<div class="row">
														<div class="form-group">
															<div class="col-md-6">
																<label><i class="fa fa-user"></i> First Name</label>
																<input type="text" value="<?php echo $vb_firstname;?>" name="vb_firstname" class="form-control input-sm">
															</div>
															<div class="col-md-6">
																<label><i class="fa fa-user"></i> Last Name</label>
																<input type="text" value="<?php echo $vb_lastname;?>" name="vb_lastname" class="form-control input-sm">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-6">
																<label><i class="fa fa-phone"></i> Phone Number</label>
																<input type="text" value="<?php echo $vb_phone;?>" name="vb_phone" class="form-control input-sm">
															</div>
															<div class="col-md-6">
																<label><i class="fa fa-envelope-o"></i> E-mail Address</label>
																<input type="text" value="<?php echo $vb_email;?>" name="vb_email" class="form-control input-sm">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-6">
																<label><i class="fa fa-key"></i>Password</label>
																<input type="password" value="<?php echo $vb_password;?>" name="vb_password" class="form-control input-sm">
															
															</div>
													
															<div class="col-md-6">
																<label><i class="fa fa-key"></i>Confirm Password</label>
																<input type="password" value="<?php echo $vb_confirm_password;?>" name="vb_confirm_password" class="form-control input-sm">
															
															</div>
														<p align="center" style="font-size:9px">Minimum of six (6) characters. Password must contain at least a letter and a number.</p>
														</div>

															

																<p style="font-size:12px"><i class="fa fa-arrow-down"></i> By clicking the <strong>"REGISTER"</strong> button below, I agree to <?php echo $vb_dcenter_full_name; ?> and Vomoz.NET <a href="javascript: void(0)" onclick="window.open('https://www.vomoz.net/vterms/','Vomoz Communications', 'width=950,  height=450, directories=no, location=no, menubar=no, resizable=no, scrollbars=1, status=no, toolbar=no'); return false;">Terms of Service</a></p>
													

														<input type="hidden" name="action" value="send">
														<p align="center">
														<input type="submit" name="vb_submit" id="vb_sendbutton" value="Register" onClick="return vbCheckForm();" class="btn btn-primary" data-loading-text="Loading...">
														<input type="submit" name="vbcancel" id="vb_sendbutton" class="btn btn-primary" value="Cancel" />
													</p>
														</div>
													</ol>
												</form>
											</div>
										</div>
									</div>

											

								</div>

				<?php
				
				if(isset($_POST['vb_submit']) && $error == ''){
		
					header("location: login.php");    }		 
				
				?>		
											</div>
										</div>
									</div>
<?php
include '../library/_footer.php';
?>
