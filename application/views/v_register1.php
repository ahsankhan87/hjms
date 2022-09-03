<!DOCTYPE html>
<html>
<head>
<title>Karwan-e-Taif SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="<?php echo base_url(); ?>asset/css/register.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Karwan-e-Taif SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post">
					<input type="text" name="name" placeholder="Full Name" value="<?php echo set_value('name'); ?>" />
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
					
                    <input type="text" name="company" placeholder="Company" value="<?php echo set_value('company'); ?>" />
                      <span class="text-danger"><?php echo form_error('company'); ?></span>
                      
                      <input type="text" name="user_email" placeholder="Email" value="<?php echo set_value('user_email'); ?>" />
                      <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                      
                      <input type="text" name="contact" placeholder="Contact" value="<?php echo set_value('contact'); ?>" />
                      <span class="text-danger"><?php echo form_error('contact'); ?></span>
                      
                      <input type="text" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>" />
                      <span class="text-danger"><?php echo form_error('address'); ?></span>
                      
                      <input type="text" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
                      <span class="text-danger"><?php echo form_error('username'); ?></span>
                      
                      <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
                      <span class="text-danger"><?php echo form_error('password'); ?></span>
                      
                      <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>"/>
                	    <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
                        
                        <select name="user_level">
                            <option value="2">Member</option>
                            <option value="1">Administrator</option>
                      </select>
                      <span class="text-danger"><?php echo form_error('user_level'); ?></span>
      
      
                   <div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a href="<?php echo site_url('Login');?>"> Login Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>&copy; <?php echo date("Y");?> Karwan-e-Taif. All rights reserved | Developed by <a href="https://khybersoft.com/" target="_blank">KHYBERSOFT</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>