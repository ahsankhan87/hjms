 <?php 
$attributes = array('class' => 'form-horizontal','method'=>'get', 'role' => 'form','enctype'=>"multipart/form-data");
echo form_open('Vouchers/create',$attributes);

?>
<div class="modal-product">
    <table class="table table-bordered table-striped table-condensed flip-content" id="sample_2">
        <thead class="flip-content">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Passport No</th>
            <th>Party</th>
            <th>Visa No</th>
            <th>Visa Status</th>
            <th>Visa Type</th>
            <th>Desc</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        
    <?php
    $sno = 1;
    foreach($passengers as $key => $list)
    {
        
        echo '<tr valign="top">';
        echo '<td>'.form_checkbox('pax_id[]',$list['id'],false).'</td>';
        echo '<td>'.$sno++.'</td>';
        echo '<td>'.$list['id'].'</td>';
        //echo '<td><a href="'.site_url('pos/C_passengers/passengerDetail/'. $list['id']).'">'.$list['first_name'] . ' '. $list['last_name'].'</a></td>';
//        echo '<td><a href="'.site_url('pos/C_passengers/passengerDetail/'. $list['id']).'">'.$list['passport_no'].'</a></td>';
//        
        echo '<td>'.$list['first_name'] . ' '. $list['last_name'].' ';
        //Calculate infant child and adult age
        $cur_year = date("Y");
        $age_year = $cur_year-date('Y',strtotime($list['dob']));
        if($age_year <= 2)
        {
            echo '<span class="label label-sm label-warning">Infant </span>';
        }
        if($age_year > 2 && $age_year <= 12)
        {
            echo '<span class="label label-sm label-primary">Child </span>';
        }
        if($age_year > 12)
        {
            echo '<span class="label label-sm label-success">Adult </span>';
        }
        echo '</td>';
        
        echo '<td>'.$list['passport_no'].'<br />';
        echo '<small style="font-size:10px">issued '.date('d-m-Y',strtotime($list['passport_issue_date'])).'<br />';
        echo 'expiry '.date('d-m-Y',strtotime($list['passport_expiry_date'])).'</small>';
        echo '</td>';
        
        //echo '<td><a href="'.site_url('accounts/C_groups/accountDetail/'. $list['account_code']).'">'.$list['first_name'] . ' '. $list['last_name'].'</a></td>';
       // echo '<td>'.$this->M_customers->get_CustomerName($list['customer_id']) .'</td>';
        //echo '<td>'.$list['first_name'].' <a href="mailto:'.$list['email'].'"><i class="fa fa-envelope-o fa-fw"></i></a></td>';
        
        echo '<td>'.$list['visa_no'].'</td>';
        echo '<td>'.$list['visa_status'].'</td>';
        //echo '<td>'.$list['visa_type'].'</td>';
        echo '<td>'.$list['description'].'</td>';
        echo '<td>';
        //echo  anchor(site_url('up_passenger_images/upload_images/'.$list['id']),' upload Images');
        echo anchor('pos/C_passengers/edit/'.$list['id'],'<i class="fa fa-pencil-square-o fa-fw"></i>',' title="Edit"'); ?> | 
        <a href="<?php echo site_url('pos/C_passengers/delete/'.$list['id']) ?>"
         onclick="return confirm('Are you sure you want to delete?')" title="Make Inactive"><i class="fa fa-trash-o fa-fw"></i></a>
    
    <?php
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    //echo '<tfoot>
//            <tr>
//                <th colspan="6" style="text-align:right">Total:</th>
//                <th></th>
//            </tr>
//        </tfoot>';
    echo '</table>';
    
    
    ?>
    
</div>
<a href="#" onclick="call()">click</a>
<button class="btn btn-primary btn-sm">Save</button>  
    
</form>