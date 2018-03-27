<?php
require ('../library/_local_universal_variables.php');
require('../library/_global_universal_variables.php');
require ('../library/_db_connect.php');
require ('../library/_my_functions.php');
require ('../library/_my_login_process_parse.php');


$vb_user_agent = $_SERVER['HTTP_USER_AGENT'];
$vb_user_ip_address = $_SERVER['REMOTE_ADDR'];

//Let's get some information about IP address:

$vb_user_ip_address_information = vbVBS_GetThisIPAddressGEOParameters($vb_user_ip_address);

if($vb_user_ip_address_information){
$vb_ip_address_info_returned = 'Yes';	

$vb_returned_country = $vb_user_ip_address_information['country_name']; 
$vb_returned_region_name = $vb_user_ip_address_information['region_name'];
$vb_returned_city = $vb_user_ip_address_information['city'];
	
}else{
$vb_ip_address_info_returned = 'No';	

$vb_returned_country = 0; 
$vb_returned_region_name = 0;
$vb_returned_city = 0;	
}


$vb_parser = new vbUserAgentStringParserClass();
$vb_parser->includeAndroidName = true;
$vb_parser->includeWindowsName = true;
$vb_parser->includeMacOSName = true;
$vb_parser->parseUserAgentString($vb_user_agent); 

if($vb_parser->knownbrowser){ 

$vb_user_agent_browser_info_returned = 'Yes';

$vb_user_agent_fullname = $vb_parser->fullname;
$vb_user_agent_browsername = $vb_parser->browsername;
$vb_user_agent_osname = $vb_parser->osname;
$vb_user_agent_browserversion = $vb_parser->browserversion;
$vb_user_agent_type = $vb_parser->type;    // Device Type (PC, mobile, or bot)

}else{

$vb_user_agent_browser_info_returned = 'No';

}
?>


<script language="JavaScript">

function checkform(){
var message="";
if (document.vlogin.pr_login.value.length==0){
	message+="Please enter your Email Address";
	}
if (document.vlogin.pr_password.value.length<6){
	message += (Boolean(message.length)) ? " and Password (at least 6 characters)." : "Please enter your Password (at least 6 characters)";
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

<script type="text/javascript">
	$(document).ready(function(){

		$("#vbFadeOutTriggerDIV").click(function(){
			$("#vbDIVToBeFadedOut1").fadeOut();			        			
		});	
		
	});
</script>
               
<?php
require '../library/_head.php';
?>
<html>
	

			<div role="main" class="main" id="home">
<section class="parallax section section-text-light section-parallax section-center" data-stellar-background-ratio="0.5" style="background-image: url(../images/parallax.jpg);">
					<div class="container">
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
						<div class="col-md-12">


							<div class="featured-boxes">
								<div class="row">
									<div class="col-sm-6">
										<div class="featured-box featured-box-primary align-left mt-xlg">
											<div class="box-content">
												<?php 
				if(isset($_GET['vb_err'])){
	 $vb_get_error = trim($_GET['vb_err']);
	 
	 if($vb_get_error == '1'){
	 
	 $vb_show_error = "Error! Wrong Email/Password. Please try again!";
	 
	 }else if($vb_get_error == '2'){
	 
		$vb_show_error = "Error! Contact admin";
		
	 }else if($vb_get_error == '3'){
		$vb_show_error = "Error! Wrong Email/Password. Please try again!";
		
	 }else{
	 $vb_show_error = "Error processing your request! Please try again later!"; 
	 
	 }
	 
	 echo "<div class='box error-box'> $vb_show_error </div>";
	 }
?>
											<h4 class="heading-primary text-uppercase mb-md">Login Page</h4>
													<div id="vbDIVToBeFadedOut1">
														<?php 
														echo $error;
														require('../library/message_anchor.php');
														?>
													</div>
									<form action="../Dashboard/" method="post" name="vlogin" class="vb-form-contact" id="vb-form-contact" onSubmit="return checkform();">
													
													<div id="vbFadeOutTriggerDIV">			
													<ol class="cf-ol">			
														<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label><i class="fa fa-envelope-o"></i> E-mail Address</label>
																<input type="text" value="" name="pr_login" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<a class="pull-right" href="../vxforgotpass">(Forgot Password?)</a>
																<label><i class="fa fa-key"></i> Password</label>
																<input type="password" value="" name="pr_password" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
																	<input type="checkbox" id="rememberme" name="rememberme"><p style="font-size: 12px">Remember Me</p>
																</label>
															</span>
														</div>
													   <input type='hidden' name='user_agent_browser_info_returned' value='<?php echo $vb_user_agent_browser_info_returned; ?>'>
													   <input type='hidden' name='user_agent_browsername' value='<?php echo $vb_user_agent_browsername; ?>'>
													   <input type='hidden' name='user_agent_osname' value='<?php echo $vb_user_agent_osname; ?>'>
													   <input type='hidden' name='user_agent_device_type' value='<?php echo $vb_user_agent_type; ?>'>
													   <input type='hidden' name='user_agent_fullname' value='<?php echo $vb_user_agent_fullname; ?>'>
													   <input type='hidden' name='ip_address_info_returned' value='<?php echo $vb_ip_address_info_returned; ?>'>
													   <input type='hidden' name='user_ip_address' value='<?php echo $vb_user_ip_address; ?>'>
													   <input type='hidden' name='returned_country' value='<?php echo $vb_returned_country; ?>'>
													   <input type='hidden' name='returned_state_province' value='<?php echo $vb_returned_region_name; ?>'>
													   <input type='hidden' name='returned_city' value='<?php echo $vb_returned_city; ?>'>
												<div class="col-md-6">
												<input type="submit" name="vb_submit" id="vb_sendbutton" value="Login" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
														</div>
													</div>
												</ol>
											</div>
											<p><img src="../../main_images/profile.png" class="text_img_middle" title="I forgot my password!" alt="I forgot my password!"/> I don't have an account! <span class="footerLightRed"><a href="../register.php">Please click here to create one in 30 seconds!</a></span> 						
						</p>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
					

								</div>
							</div>
					</div>

			
<?php
include '../library/_footer.php';
?>
