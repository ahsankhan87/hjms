
<div class="row">
    <div class="col-sm-12">
<?php 
$attributes = array('class' => 'form-horizontal', 'role' => 'form','enctype'=>"multipart/form-data");
echo validation_errors();
echo form_open('TransportationTrip/edit',$attributes);

foreach($update_transportation_trip as $row)
{
?>
<div class="form-group">
  <label class="control-label col-sm-2" for="Name">Name:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" name="name" placeholder="Name"/>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2" for="description">Description:</label>
  <div class="col-sm-10">
    <textarea class="form-control" id="description" name="description" placeholder="Description" ><?php echo $row['description']; ?></textarea>
    
  </div>
</div>
<?php 
echo '<div class="form-group"><label class="control-label col-sm-2" for="status">Active</label>';
echo '<div class="col-sm-10">';
$option = array('1'=>'active','0'=>'inactive');
echo form_dropdown('active',$option,$row['active'],'class="form-control"') . '</div></div>';
 

echo form_hidden('id',$row['id']);

echo '<div class="form-group"><label class="control-label col-sm-2" for="submit"></label>';
echo '<div class="col-sm-10">';
echo form_submit('submit','Update','class="btn btn-success"');
echo '</div></div>';
}
echo form_close();

?>
</div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->