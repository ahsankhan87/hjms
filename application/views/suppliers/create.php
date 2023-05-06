<div class="row">
  <div class="col-sm-12">
    <?php if (@$error) {
      echo "<div class='alert alert-danger'>";
      echo @$error;
      echo '</div>';
    }

    ?>

    <?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data");
    echo validation_errors();
    echo form_open('Suppliers/create', $attributes);

    ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Name">Name:<span class="required text-danger">* </span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_no">Phone No.:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Phone No." />
      </div>
    </div>
    

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="address">Address:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="address" name="address" placeholder="address" />
      </div>
    </div>
    
    <?php
   
    echo '<div class="form-group"><label class="control-label col-sm-2" for="submit"></label>';
    echo '<div class="col-sm-10">';
    echo form_submit('submit', 'Submit', 'class="btn btn-success"');
    echo '</div></div>';

    echo form_close();

    ?>
  </div>
  <!-- /.col-sm-12 -->
</div>
<!-- /.row -->