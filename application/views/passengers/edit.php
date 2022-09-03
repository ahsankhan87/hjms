<div class="card">
    <div class="card-header">
        Edit Form
    </div>
    <div class="card-body">
    
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
<?php 
foreach($passenger as $values):
$attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype'=>"multipart/form-data");
echo validation_errors();
echo form_open('Passengers/edit',$attributes);

echo form_hidden('id',$values['id']);
?>

<!--
<div class="form-group">
  <label class="control-label col-md-2" for="cust">Customer / Party:</label>
  <div class="col-md-10">
    <?php echo form_dropdown('customer_id',$customerDDL,$values['customer_id'],'class="form-control select2me"'); ?>
  </div>
</div>
-->

<div class="form-group">
  <label class="control-label col-sm-2" for="passenger Name">First Name: <span class="text-danger">*</span></label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $values['first_name']; ?>" placeholder="passenger First Name"/>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="passenger LName">Last Name:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $values['last_name']; ?>" placeholder="passenger Last Name"/>
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="father_name">Father Name:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $values['father_name']; ?>" />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="passport_no">Passport No: <span class="text-danger">*</span></label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="passport_no" name="passport_no" value="<?php echo $values['passport_no']; ?>"placeholder="passport_no" />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="cnic">CNIC No:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="cnic" name="cnic" value="<?php echo $values['cnic']; ?>" />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="country">Nationality:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="country" name="country" value="<?php echo $values['country']; ?>"/>
  </div>
</div>

 
<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="">Gender</label>';
echo '<div class="col-sm-10">';
$option = array('0'=>'Please Select','male'=>'Male','female'=>'Female');
echo form_dropdown('gender',$option,$values['gender'],'class="form-control"') . '</div></div>';
 ?>

<div class="form-group">
  <label class="control-label col-sm-2" for="dob">Date Of Birth:</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $values['dob']; ?>" placeholder="dob" />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="passport_issue_date">Passport Issue Date:</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="passport_issue_date" name="passport_issue_date" value="<?php echo $values['passport_issue_date']; ?>" />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="passport_expiry_date">Passport Expiry Date:</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date" value="<?php echo $values['passport_expiry_date']; ?>" />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="">Place of Birth:</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="" name="city" value="<?php echo $values['city']; ?>"/>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="Mobile">Mobile No:</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="Mobile" name="mobile_no" value="<?php echo $values['mobile_no']; ?>"placeholder="Mobile No" />
  </div>
</div>

<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="Mehram">Mahram</label>';
echo '<div class="col-sm-10">';
$option = array('0'=>'Please Select','Grand Father'=>'Grand Father','Father'=>'Father','Son'=>'Son',
'Grand Son'=>'Grand Son','Brother'=>'Brother','Nephew'=>'Nephew','Uncle'=>'Uncle','Husband'=>'Husband','Father in law'=>'Father in law',
'Son-in-law'=>'Son-in-law','Stepfather (Mother\'s husband)'=>'Stepfather (Mother\'s husband)','Stepson (Husband\'s son)'=>'Stepson (Husband\'s son)',
'Self'=>'Self','Women Group'=>'Women Group');
echo form_dropdown('mehram',$option,$values['mehram'],'class="form-control"') . '</div></div>';
 ?>

<div class="form-group">
  <label class="control-label col-sm-2" for="visa_no">VISA No.</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="visa_no" name="visa_no" value="<?php echo $values['visa_no']; ?>"placeholder="VISA No." />
  </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-2" for="visa_issue_date">VISA Issue Date.</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="visa_issue_date" name="visa_issue_date" value="<?php echo $values['visa_issue_date']; ?>" />
  </div>
</div>

<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="status">Visa Status</label>';
echo '<div class="col-sm-10">';
$option = array('0'=>'Please Select','In office'=>'In office','Send to embasy'=>'Send to embasy',
'Approved and send to embasy'=>'Approved and send to embasy','Return to our office'=>'Return to our office',
'Return to agent or passenger'=>'Return to agent or passenger');
echo form_dropdown('visa_status',$option,$values['visa_status'],'class="form-control"') . '</div></div>';
 ?>
 
<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="status">Visa Type</label>';
echo '<div class="col-sm-10">';
$option = array('0'=>'Please Select','Umrah'=>'Umrah','Ticket'=>'Ticket',
'Hajj'=>'Hajj','Other'=>'Ohter');
echo form_dropdown('visa_type',$option,$values['visa_type'],'class="form-control"') . '</div></div>';
 ?>
 
<div class="form-group">
  <label class="control-label col-sm-2" for="Description">Description:</label>
  <div class="col-sm-10">
    <textarea name="description" class="form-control"><?php echo $values['description']; ?></textarea>
    
  </div>
</div>

<?php 
echo '<div class="form-group"><label class="control-label col-sm-2" for="submit"></label>';
echo '<div class="col-sm-10">';
echo form_submit('submit','Update','class="btn btn-primary"');
echo '</div></div>';
endforeach;
?>
 
</div><!-- /. card body -->
</div><!-- /. card -->
