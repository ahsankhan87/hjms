<div class="row">
    <div class="col-sm-12">
    <?php
    if($this->session->flashdata('message'))
    {
        echo "<div class='alert alert-success'>";
        echo $this->session->flashdata('message');
        echo '</div>';
    }
    if($this->session->flashdata('error'))
    {
        echo "<div class='alert alert-danger'>";
        echo $this->session->flashdata('error');
        echo '</div>';
    }
    ?>
    <p>
    <?php echo anchor('Passengers/create','Add New <i class="fa fa-plus"></i>','class="btn btn-success"'); ?>
    <?php //echo anchor('Passengers/combine_create','Create with entry','class="btn btn-success"'); ?>
    <?php //echo anchor('Passengers/bulk_create','Bulk Create <i class="fa fa-plus"></i>','class="btn btn-success"'); ?>
    <?php echo anchor('Passengers/passengerImport','Import Passengers','class="btn btn-success"'); ?>
    
    </p>
    
    <?php
    if(count($passengers))
    {
    ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm" id="table_1">
        <thead class="thead-dark">
        <tr>
            <th><input type="checkbox" name="" /></th>
            <th>S.No</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Passport No</th>
            <th>Visa No</th>
            <th>Visa Status</th>
            <th>Visa Type</th>
            <th>Voucher No.</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
    <?php
    $sno = 1;
    foreach($passengers as $key => $list)
    {
        echo '<tr valign="top">';
        echo '<td>'.form_checkbox('p_id[]',$list['id'],false).'</td>';
        echo '<td>'.$sno++.'</td>';
        //echo '<td>'.$list['id'].'</td>';
        //echo '<td><a href="'.site_url('pos/C_passengers/passengerDetail/'. $list['id']).'">'.$list['first_name'] . ' '. $list['last_name'].'</a></td>';
//        echo '<td><a href="'.site_url('pos/C_passengers/passengerDetail/'. $list['id']).'">'.$list['passport_no'].'</a></td>';
//        
        echo '<td>'.trim($list['first_name']) . ' '. trim($list['last_name']).' ';
        //Calculate infant child and adult age
        $cur_year = date("Y");
        $age_year = ($cur_year-date('Y',strtotime($list['dob'])));
        if($age_year <= 2)
        {
            echo '<span class="label label-sm label-warning"><strong>(Infant)</strong> </span>';
        }
        if($age_year > 2 && $age_year <= 12)
        {
            echo '<span class="label label-sm label-primary"><strong>(Child)</strong> </span>';
        }
        if($age_year > 12)
        {
            echo '<span class="label label-sm label-success"><strong>(Adult)</strong> </span>';
        }
        echo '</td>';
        
        echo '<td>'.date('d-m-Y',strtotime($list['dob'])).'</td>';
        echo '<td>'.$list['passport_no'];
        //if($list['passport_issue_date'] != null)
//        {
//            echo '<br />';
//            echo '<small style="font-size:10px">';
//            echo 'issued '.date('d-m-Y',strtotime($list['passport_issue_date']));
//            echo '</small>';
//        }
//        if($list['passport_expiry_date'] != null)
//        {
//            echo '<br />';
//            echo '<small style="font-size:10px">';
//            echo 'expiry '.date('d-m-Y',strtotime($list['passport_expiry_date']));
//            echo '</small>';
//        
//        }
        echo '</td>';
        
        //echo '<td><a href="'.site_url('accounts/C_groups/accountDetail/'. $list['account_code']).'">'.$list['first_name'] . ' '. $list['last_name'].'</a></td>';
        //echo '<td>';
        //$this->M_customers->get_CustomerName($list['customer_id']) .
        //echo '</td>';
        //echo '<td>'.$list['first_name'].' <a href="mailto:'.$list['email'].'"><i class="fa fa-envelope-o fa-fw"></i></a></td>';
        
        echo '<td>'.$list['visa_no'].'</td>';
        echo '<td>'.$list['visa_status'].'</td>';
        echo '<td>'.$list['visa_type'].'</td>';
        $voucher = $this->M_passengers->get_passengerVoucherNo($list['id']);
        echo '<td>';
        //echo var_dump($voucher);   
        if(count((array)$voucher) > 0)
        {
            echo '<a href="'.site_url('Vouchers/invoice/'.@$voucher[0]['voucher_id'].'/'.@$voucher[0]['voucher_no']).'" target="_blank">'.@$voucher[0]['voucher_no'].'</a>';
        }
        echo '</td>';
        echo '<td>';
        //echo  anchor(site_url('up_passenger_images/upload_images/'.$list['id']),' upload Images');
        echo anchor('Passengers/edit/'.$list['id'],'<i class="fa fa-pencil-square-o fa-fw">Edit</i>',' title="Edit"'); ?> | 
        <a href="<?php echo site_url('Passengers/delete/'.$list['id']) ?>"
         onclick="return confirm('Are you sure you want to delete?')" title="Make Inactive"><i class="fa fa-trash-o fa-fw">Delete</i></a>
    
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
    
    }
    ?>
    </div>
    <!-- /.col-sm-12 -->

    </div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->
