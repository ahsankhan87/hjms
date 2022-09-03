<div ng-controller="passengersCtrl">
<?php
//flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new supplier created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
?>
<div class="row">
    <div class="col-sm-12">
   
<?php 
$attributes = array('class' => 'form-horizontal', 'role' => 'form','enctype'=>"multipart/form-data");
echo validation_errors();
echo form_open('pos/C_passengers/bulk_create',$attributes);

?>

<div class="form-group">
  <label class="control-label col-md-2" for="cust">Customer / Party:</label>
  <div class="col-md-6">
    <?php echo form_dropdown('customer_id',$customerDDL,'','class="form-control select2me" required=""'); ?>
  </div>
</div>
<input type="button" name="add" value="+Add new row" id="addrows" class="btn" />

   <table class="" id="bulk_entry_table">
        <thead class="flip-content">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father Name</th>
                <th>Passport No</th>
                <th>CNIC</th>
                <th>Nationality</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>PP Issue Date</th>
                <th>PP Expiry Date</th>
                <th>Birth Place</th>
                <th>Mobile No</th>
                <th>Mehram</th>
                <th>VISA No.</th>
                <th>VISA Status</th>
                <th>VISA Type</th>
                <th>Description</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" style="width:200px" class="form-control" id="first_name" name="first_name[]" value="<?php echo set_value('first_name') ?>" placeholder="First Name" /></td>
                <td>
                <input type="text" style="width:100px" class="form-control" id="last_name" name="last_name[]" value="<?php echo set_value('last_name') ?>" placeholder="Last Name" />
                </td>
                <td><input type="text" style="width:200px" class="form-control" id="father_name" name="father_name[]" value="<?php echo set_value('father_name') ?>" placeholder="Father Name"  />
                </td>
                <td><input type="text" style="width:100px" class="form-control" id="passport_no" name="passport_no[]" value="<?php echo set_value('passport_no') ?>"placeholder="Passport No" /></td>
                <td><input type="text" style="width:200px" class="form-control" id="cnic" name="cnic[]" value="<?php echo set_value('cnic') ?>"placeholder="CNIC" /></td>
                <td>
                <?php
                $option = array('0'=>'Please Select','Pakistan'=>'Pakistan','Others'=>'Others');
                    echo form_dropdown('country[]',$option,'Pakistan','class="form-control select2me" style="width:120px" ');
                     ?>
                </td>
                <td>
                <?php $option = array('0'=>'Please Select','male'=>'Male','female'=>'Female');
                    echo form_dropdown('gender[]',$option,'male','class="form-control" style="width:80px" ');
                     ?>
                </td>
                <td><input type="date" class="form-control" id="dob" name="dob[]" value="<?php echo set_value('dob') ?>" placeholder="DOB" /></td>
                <td><input type="date" class="form-control" id="passport_issue_date" name="passport_issue_date[]" value="<?php echo set_value('passport_issue_date') ?>" /></td>
                <td><input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date[]" value="<?php echo set_value('passport_expiry_date') ?>" /></td>
                <td><input type="text" class="form-control" style="width:150px"  name="city[]" value="<?php echo set_value('city') ?>"value="<?php echo set_value('city') ?>" /></td>
                <td><input type="number" class="form-control" style="width:200px" id="Mobile" name="mobile_no[]" value="<?php echo set_value('mobile_no') ?>"placeholder="Mobile No" /></td>
                <td>
                <?php $option = array('0'=>'Please Select','Grand Father'=>'Grand Father','Father'=>'Father','Son'=>'Son',
                    'Grand Son'=>'Grand Son','Brother'=>'Brother','Nephew'=>'Nephew','Uncle'=>'Uncle','Husband'=>'Husband','Father in law'=>'Father in law',
                    'Son-in-law'=>'Son-in-law','Stepfather (Mother\'s husband)'=>'Stepfather (Mother\'s husband)','Stepson (Husband\'s son)'=>'Stepson (Husband\'s son)',
                    'Self'=>'Self','Women Group'=>'Women Group');
                    echo form_dropdown('mehram[]',$option,'','class="form-control" style="width:200px" ');
                     ?>
                </td>
                <td><input type="text" class="form-control" style="width:100px"  name="visa_no[]" value="<?php echo set_value('visa_no') ?>"placeholder="VISA No." /></td>
                <td>
                <?php $option = array('0'=>'Please Select','In office'=>'In office','Send to embasy'=>'Send to embasy',
                    'Approved and send to embasy'=>'Approved and send to embasy','Return to our office'=>'Return to our office',
                    'Return to agent or passenger'=>'Return to agent or passenger');
                    echo form_dropdown('visa_status[]',$option,'','class="form-control" style="width:100px" ');
                     ?>
                </td>
                <td>
                <?php 
                    $option = array('0'=>'Please Select','umrah'=>'Umrah','ticket'=>'Ticket',
                    'hajj'=>'Hajj','other'=>'Ohter');
                    echo form_dropdown('visa_type',$option,'','class="form-control"');
                     ?>
                </td>
                <td><textarea name="description[]" class="form-control" style="width:200px" ></textarea></td>
                                
            </tr>
        
        </tbody>
    </table>
    
<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="submit"></label>';
echo '<div class="col-sm-10">';
echo form_submit('submit','Submit','class="btn btn-success"');
echo '</div></div>';

echo form_close();
 
?>
</div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.cusotmer ctrl -->
                
<script>
$(document).delegate('#addrows', 'click', function() {
    
    var row = '<tr><td><input type="text" class="form-control" id="first_name" name="first_name[]" value="" placeholder="First Name" /></td><td><input type="text" class="form-control" id="last_name" name="last_name[]" value="" placeholder="Last Name" /></td><td><input type="text" class="form-control" id="father_name" name="father_name[]" value="" placeholder="Father Name"  /></td><td><input type="text" class="form-control" id="passport_no" name="passport_no[]" value=""placeholder="passport_no" /></td><td><input type="text" class="form-control" id="cnic" name="cnic[]" value="" placeholder="cnic" /></td>';
        row += '<td><select class="form-control select2me" name="country[]"><option>Please Select</option><option selected>Pakistan</option><option>Others</option></select></td>';
        row += '<td><select name="gender[]" class="form-control"><option>Please Select</option><option selected>male</option><option>female</option></select></td>';
        row += '<td><input type="date" class="form-control" id="dob" name="dob[]" value="" placeholder="dob" /></td>';
        row += '<td><input type="date" class="form-control" id="passport_issue_date" name="passport_issue_date[]" value="" /></td>';
        row += '<td><input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date[]" value="" /></td>';
        row += '<td><input type="text" class="form-control" id="" name="city[]" value="" /></td>';
        row += '<td><input type="number" class="form-control" id="Mobile" name="mobile_no[]" value="" placeholder="Mobile No" /></td>';
        row += '<td><select name="mehram[]" class="form-control select2me"><option>Please Select</option><option>Grand Father</option><option>Father</option><option>Son</option><option>Grand Son</option><option>Brother</option><option>Nephew</option><option>Uncle</option><option>Husband</option><option>Father-in-law</option><option>Son-in-law</option><option>Stepfather (Mother\'s husband)</option><option>Stepson (Husband\'s son)</option><option>Self</option><option>Women Group</option></select></td>';
        row += '<td><input type="text" class="form-control" id="visa_no" name="visa_no[]" value="" placeholder="VISA No." /></td>';
        row += '<td><select name="visa_status[]" class="form-control"><option>Please Select</option><option selected>In office</option><option>Send to embassy</option><option>Approved and send to embasy</option><option>Return to our office</option><option>Return to agent or passenger</option></select></td>';
        row += '<td><select name="visa_type" class="form-control"><option>Please Select</option><option>Umrah</option><option>Ticket</option><option>Hajj</option><option>Other</option></select></td>';
        row += '<td><textarea name="description[]" class="form-control"></textarea></td></tr>';
        
        $('#bulk_entry_table tr:last').after(row);
    
        //console.log(row);
    });
</script>