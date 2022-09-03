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
echo form_open('pos/C_passengers/combine_create',$attributes);

?>
<h3>Account Entry</h3>

<div class="form-group">
  <label class="control-label col-md-2" for="cust">Transaction Date:</label>
  <div class="col-md-4">
    <input type="date" class="form-control" name="sale_date" value="<?php echo date('Y-m-d') ?>"  />
  </div>
  
</div>

<div class="form-group">
  <label class="control-label col-md-2" for="cust">Customer / Party:</label>
  <div class="col-md-4">
    <?php echo form_dropdown('customer_id',$customerDDL,'','class="form-control select2me"'); ?>
  </div>
  
  <label class="control-label col-md-2" for="supplier">Supplier:</label>
  <div class="col-md-4">
    <?php echo form_dropdown('supplier_id',$supplierDDL,'','class="form-control select2me"'); ?>
  </div>
  
</div>
<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">Customer VISA Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="cust_visa_cost" value="<?php echo set_value('cust_visa_cost') ?>"  />
  </div>
  
  <label class="control-label col-sm-2" for="first_name">Supplier VISA Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="sup_visa_cost" value="<?php echo set_value('sup_visa_cost') ?>"  />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">Customer Ticket Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="cust_ticket_cost" value="<?php echo set_value('cust_ticket_cost') ?>"  />
  </div>
  
  <label class="control-label col-sm-2" for="first_name">Supplier Ticket Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="sup_ticket_cost" value="<?php echo set_value('sup_ticket_cost') ?>"  />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">Customer Hotel Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="cust_hotel_cost" value="<?php echo set_value('cust_hotel_cost') ?>"  />
  </div>
  
  <label class="control-label col-sm-2" for="first_name">Supplier Hotel Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="sup_hotel_cost" value="<?php echo set_value('sup_hotel_cost') ?>"  />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">Customer Other Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="cust_other_cost" value="<?php echo set_value('cust_other_cost') ?>"  />
  </div>
  
  <label class="control-label col-sm-2" for="first_name">Supplier Other Cost:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" name="sup_other_cost" value="<?php echo set_value('sup_other_cost') ?>"  />
  </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2" for="first_name">Trans Type:</label>
    <div class="radio-list col-sm-4">
		<label class="radio-inline">
		<div class="radio" id="uniform-optionsRadios4"> 
        <input type="radio" name="cust_saleType" id="optionsRadios4" value="cash" > </div> Cash </label>
		
        <label class="radio-inline">
		<div class="radio" id="uniform-optionsRadios5">
        <input type="radio" name="cust_saleType" id="optionsRadios5" value="credit" checked="" ></div> Credit </label>
	
    </div>
    
    <label class="control-label col-sm-2" for="first_name">Trans Type:</label>
    <div class="radio-list col-sm-4">
		<label class="radio-inline">
		<div class="radio" id="uniform-optionsRadios4"> 
        <input type="radio" name="purchaseType" id="optionsRadios4" value="cash" > </div> Cash </label>
		
        <label class="radio-inline">
		<div class="radio" id="uniform-optionsRadios5">
        <input type="radio" name="purchaseType"  id="optionsRadios5" value="credit" checked="" ></div> Credit </label>
	
    </div>
    
</div>  

<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">Customer Narration:</label>
  <div class="col-sm-4">
    <textarea name="cust_description" rows="4" class="form-control" placeholder="Comments" cols="5"><?php echo set_value('cust_description') ?></textarea> 

  </div>
  
  <label class="control-label col-sm-2" for="first_name">Supplier Narration:</label>
  <div class="col-sm-4">
    <textarea name="sup_description" rows="4" class="form-control" placeholder="Comments" cols="5"><?php echo set_value('sup_description') ?></textarea> 

  </div>
</div>

      
<hr />
<h3>Passenger Detail</h3>

<div class="form-group">
  <label class="control-label col-sm-2" for="first_name">First Name:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name') ?>" required=""placeholder="First Name" />
  </div>
  
  <label class="control-label col-sm-2" for="last_name">Last Name:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name') ?>" placeholder="Last Name" />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="father_name">Father Name:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo set_value('father_name') ?>" required=""placeholder="Father Name"  />
  </div>
  
  <label class="control-label col-sm-2" for="passport_no">Passport No:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="passport_no" name="passport_no" value="<?php echo set_value('passport_no') ?>"placeholder="passport_no" />
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2" for="cnic">CNIC No:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="cnic" name="cnic" value="<?php echo set_value('cnic') ?>"placeholder="cnic" />
  </div>
  
  <?php 
 
    echo '<label class="control-label col-sm-2" for="">Nationality</label>';
    echo '<div class="col-sm-4">';
    $option = array('0'=>'Please Select','Pakistan'=>'Pakistan','Others'=>'Others');
    echo form_dropdown('country',$option,'Pakistan','class="form-control select2me"') . '</div>';
 ?>
</div>


 
 
<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="">Gender</label>';
echo '<div class="col-sm-4">';
$option = array('0'=>'Please Select','male'=>'Male','female'=>'Female');
echo form_dropdown('gender',$option,'male','class="form-control"') . '</div>';
 ?>
  <label class="control-label col-sm-2" for="dob">Date Of Birth:</label>
      <div class="col-sm-4">
        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob') ?>" placeholder="dob" />
        </div>
</div>


<div class="form-group">

  <label class="control-label col-sm-2" for="passport_issue_date">Passport Issue Date:</label>
  <div class="col-sm-4">
    <input type="date" class="form-control" id="passport_issue_date" name="passport_issue_date" value="<?php echo set_value('passport_issue_date') ?>" />
  </div>
  <label class="control-label col-sm-2" for="passport_expiry_date">Passport Expiry Date:</label>
  <div class="col-sm-4">
    <input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date" value="<?php echo set_value('passport_expiry_date') ?>" />
  </div>
  
</div>

<div class="form-group">

  <label class="control-label col-sm-2" for="">Place of Birth:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="" name="city" value="<?php echo set_value('city') ?>"value="<?php echo set_value('city') ?>" />
  </div>
  <label class="control-label col-sm-2" for="Mobile">Mobile No:</label>
  <div class="col-sm-4">
    <input type="number" class="form-control" id="Mobile" name="mobile_no" value="<?php echo set_value('mobile_no') ?>"placeholder="Mobile No" />
  </div>
  
</div>

<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="Mehram">Mahram</label>';
echo '<div class="col-sm-4">';
$option = array('0'=>'Please Select','Grand Father'=>'Grand Father','Father'=>'Father','Son'=>'Son',
'Grand Son'=>'Grand Son','Brother'=>'Brother','Nephew'=>'Nephew','Uncle'=>'Uncle','Husband'=>'Husband','Father in law'=>'Father in law',
'Son-in-law'=>'Son-in-law','Stepfather (Mother\'s husband)'=>'Stepfather (Mother\'s husband)','Stepson (Husband\'s son)'=>'Stepson (Husband\'s son)',
'Self'=>'Self','Women Group'=>'Women Group');
echo form_dropdown('mehram',$option,'','class="form-control"') . '</div>';
 ?>
  <label class="control-label col-sm-2" for="visa_no">VISA No.</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="visa_no" name="visa_no" value="<?php echo set_value('visa_no') ?>"placeholder="VISA No." />
  </div>
  
</div>

<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="status">Visa Status</label>';
echo '<div class="col-sm-4">';
$option = array('0'=>'Please Select','In office'=>'In office','Send to embasy'=>'Send to embasy',
'Approved and send to embasy'=>'Approved and send to embasy','Return to our office'=>'Return to our office',
'Return to agent or passenger'=>'Return to agent or passenger');
echo form_dropdown('visa_status',$option,'','class="form-control"') . '</div>';

echo '<label class="control-label col-sm-2" for="status">Visa Type</label>';
echo '<div class="col-sm-4">';
$option = array('0'=>'Please Select','Umrah'=>'Umrah','Ticket'=>'Ticket',
'Hajj'=>'Hajj','Other'=>'Ohter');
echo form_dropdown('visa_type',$option,'','class="form-control"') . '</div></div>';
 ?>
 
<div class="form-group">
  <label class="control-label col-sm-2" for="Description">Description:</label>
  <div class="col-sm-4">
    <textarea name="description" class="form-control"></textarea>
    
  </div>
</div>

<?php 
 
echo '<div class="form-group"><label class="control-label col-sm-2" for="submit"></label>';
echo '<div class="col-sm-4">';
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