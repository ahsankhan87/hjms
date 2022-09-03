<!DOCTYPE html>
<html>
<head>
 <title>Complete User Registration and Login System in Codeigniter</title>
 <link rel="stylesheet" href="<?php echo base_url('asset/vendor/bootstrap/css/bootstrap.min.css');?>" />
</head>

<body>
 <div class="container">
  <br />
  <h3 align="center">Complete User Registration and Login in Karwan-e-Taif</h3>
  <br />
  <div class="card">
   <div class="card-header">Register</div>
   <div class="card-body">
    <form method="post" action="<?php echo base_url(); ?>Login/register">
     <div class="form-group">
      <label>Enter Your Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" />
      <span class="text-danger"><?php echo form_error('name'); ?></span>
     </div>
     <div class="form-group">
      <label>Enter Your Company Name <span class="text-danger">*</span></label>
      <input type="text" name="company" class="form-control" value="<?php echo set_value('company'); ?>" />
      <span class="text-danger"><?php echo form_error('company'); ?></span>
     </div>
     <div class="form-group">
      <label>Enter Your Valid Email Address</label>
      <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
      <span class="text-danger"><?php echo form_error('user_email'); ?></span>
     </div>
     <div class="form-group">
      <label>Enter Your Contact No.</label>
      <input type="text" name="contact" class="form-control" value="<?php echo set_value('contact'); ?>" />
      <span class="text-danger"><?php echo form_error('contact'); ?></span>
     </div>
     <div class="form-group">
      <label>Enter Your Address</label>
      <input type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>" />
      <span class="text-danger"><?php echo form_error('address'); ?></span>
     </div>
     
     <div class="form-group">
      <label>Enter Your Username <span class="text-danger">*</span></label>
      <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>" />
      <span class="text-danger"><?php echo form_error('username'); ?></span>
     </div>
     <div class="form-group">
      <label>Enter Password <span class="text-danger">*</span></label>
      <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" />
      <span class="text-danger"><?php echo form_error('password'); ?></span>
     </div>
     <div class="form-group">
		<label>Confirm Password <span class="text-danger">*</span></label>
		<input type="password" name="confirm_password" class="form-control" value="<?php echo set_value('confirm_password'); ?>"/>
	    <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
    </div>
    
    <div class="form-group">
      <label>User Role <span class="text-danger">*</span></label>
      <select name="user_level" class="form-control">
            <option value="2">Member</option>
            <option value="1">Administrator</option>
      </select>
      <span class="text-danger"><?php echo form_error('user_level'); ?></span>
     </div>
     
     <div class="form-group">
      <input type="submit" name="register" value="Register" class="btn btn-info" />
      <a href="#" onclick="history.back();" class="btn btn-warning" >back</a>
     </div>
    </form>
   </div>
  </div>
 </div>
</body>
</html>
