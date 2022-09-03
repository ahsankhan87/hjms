<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link href="<?php echo base_url('asset/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Animate CSS-->
  <link href="<?php echo base_url(); ?>asset/css/animate.min.css" rel="stylesheet">
  
  </head>
  <body class="animated bounceIn">
 
      <div class="container">
      
       <div class="col-sm-4 col-sm-offset-4">
         <form class="form-signin" action="<?php echo site_url('Login/auth');?>" method="post">
           <h2 class="form-signin-heading">Please sign in</h2>
           <?php
            if($this->session->flashdata('msg'))
            {
                echo "<div class='alert alert-success'>";
                echo '<span>'.$this->session->flashdata('msg').'</span>';
                echo '</div>';
            }
            if($this->session->flashdata('error'))
            {
                echo "<div class='alert alert-danger'>";
                echo '<span>'. $this->session->flashdata('error').'</span>';
                echo "</div>";
            }
            
        ?>
           <label for="username" class="sr-only">Username</label>
           <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
           <label for="password" class="sr-only">Password</label>
           <input type="password" name="password" class="form-control" placeholder="Password" required>
           <div class="checkbox">
             <label>
               <a href="<?php echo site_url('Login/register');?>">Register</a>
             </label>
           </div>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
         </form>
       </div>
       </div> <!-- /container -->
 
    <script src="<?php echo base_url('asset/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
  </body>