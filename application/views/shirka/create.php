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
    echo form_open('Shirka/create', $attributes);

    ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Name">Name:<span class="required">* </span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" placeholder="description"></textarea>

      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="logo">logo:</label>
      <div class="col-sm-10">
        <input type="file" name="userfile" size="20" />

      </div>
    </div>

    <?php
    echo '<div class="form-group"><label class="control-label col-sm-2" for="Default">Default</label>';
    echo '<div class="col-sm-10">';
    $option = array('1' => 'Yes', '0' => 'No');
    echo form_dropdown('is_default', $option, '', 'class="form-control"') . '</div></div>';

    echo '<div class="form-group"><label class="control-label col-sm-10" for="status">Status</label>';
    echo '<div class="col-sm-10">';
    $option = array('1' => 'active', '0' => 'inactive');
    echo form_dropdown('active', $option, '', 'class="form-control"') . '</div></div>';


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