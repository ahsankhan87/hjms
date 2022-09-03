<div class="container">
<?php 
      if(@$error)
      {
        echo "<div class='alert alert-danger'>";
        echo @$error;
        echo '</div>';
      }
?>
 
  <?php
  if ($this->session->flashdata('message')) {
    echo "<div class='alert alert-success'>";
    echo $this->session->flashdata('message');
    echo '</div>';
  }
  if ($this->session->flashdata('error')) {
    echo "<div class='alert alert-danger'>";
    echo $this->session->flashdata('error');
    echo '</div>';
  }
  ?>
  <div class="card">
    <div class="card-header">Profile</div>

    <?php foreach ($users as $list) : ?>
      <div class="card-body">
        <form method="post" action="<?php echo base_url(); ?>Users/profile" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?php echo $list['id']; ?>" />
          <input type="hidden" name="old_img_name" value="<?php echo $list['image']; ?>" />

          <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="<?php echo $list['name']; ?>" />
            <span class="text-danger"><?php echo form_error('name'); ?></span>
          </div>
          <div class="form-group">
            <label>Company Name <span class="text-danger">*</span></label>
            <input type="text" name="company" class="form-control" value="<?php echo $list['company']; ?>" />
            <span class="text-danger"><?php echo form_error('company'); ?></span>
          </div>
          <div class="form-group">
            <label>Valid Email Address</label>
            <input type="text" name="user_email" class="form-control" value="<?php echo $list['email']; ?>" />
            <span class="text-danger"><?php echo form_error('user_email'); ?></span>
          </div>
          <div class="form-group">
            <label>Contact No.</label>
            <input type="text" name="contact" class="form-control" value="<?php echo $list['contact']; ?>" />
            <span class="text-danger"><?php echo form_error('contact'); ?></span>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $list['address']; ?>" />
            <span class="text-danger"><?php echo form_error('address'); ?></span>
          </div>

          <div class="form-group">
            <label>User Role <span class="text-danger">*</span></label>
            <select name="user_level" class="form-control">
              <option <?php echo ($list['user_level'] == '2' ? 'selected="selected"' : '') ?> value="2">Member</option>
              <option <?php echo ($list['user_level'] == '1' ? 'selected="selected"' : '') ?> value="1">Administrator</option>
            </select>
            <span class="text-danger"><?php echo form_error('user_level'); ?></span>
          </div>

          <div class="col-sm-12 col">
          <img src="<?php echo base_url('asset/images/'.$list['image'])?>" class="img-fluid img-thumbnail" width="100" height="100"/>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="logo">logo:</label>
            <div class="col-sm-10">
              <input type="file" name="userfile" size="20" />

            </div>
          </div>

          <div class="form-group">
            <input type="submit" name="update" value="Update Profile" class="btn btn-info" />

          </div>
        </form>
      </div><!-- /. card body- -->
    <?php endforeach; ?>
  </div>
</div>