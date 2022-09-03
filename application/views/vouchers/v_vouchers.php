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
<a href="<?php echo site_url('Vouchers/allVouchers'); ?>" class="btn btn-primary btn-sm">View All Vouchers</a>
<a href="<?php echo site_url('Vouchers/create'); ?>" class="btn btn-primary btn-sm">Create Voucher</a>
</p>
       
           <div class="table-responsive">
           <table class="table table-striped table-bordered table-sm" id="table_1">
            
                <thead class="thead-dark">
                    <tr>
                        <th>Sno</th>
                        <th>VNo</th>
                        <th>Total PAX</th>
                        <th>Voucher Date</th>
                        <th>KSA Arrival</th>
                        <th>KSA Return</th>
                        <th>Ziarat</th>
                        <th>Room Type</th>   
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sno=1;
                    
                    foreach($vouchers as $values): 
                    echo '<tr>';
                        //echo '<td>'.form_checkbox('p_id[]',$values['id'],false).'</td>';
                        //echo '<td>'.$sno++.'</td>';
                        echo '<td>'.$values['id'].'</td>';
                        echo '<td>'.$values['voucher_no'].'</td>';
                        echo '<td>'.$this->M_vouchers->getTotalPAX_by_voucher_id($values['id']).'</td>';
                        echo '<td>'.date('d-m-Y',strtotime($values['voucher_date'])).'</td>';
                        echo '<td>'.date('d-m-Y',strtotime($values['arrival_date_to_ksa'])).'</td>';
                        echo '<td>'.date('d-m-Y',strtotime($values['arrival_date_return'])).'</td>';
                        echo '<td>'.$values['ziarat'].'</td>';
                        echo '<td>'.$values['room_type'].'</td>';
                        echo '<td>';
                        echo '<a href="'.site_url('Vouchers/edit/'.$values['id'].'/'.$this->session->userdata('user_id')).'" class="btn btn-primary btn-sm">Edit</a>';
                        echo  anchor('Vouchers/delete_voucher_by_id/'.$values['id'].'/'.true.'/'.$this->session->userdata('user_id'),' Del','onclick="return confirm(\'Are you sure you want to delete?\')" class="btn btn-danger btn-sm"');
                        echo '<a href="'.site_url('Vouchers/invoice/'.$values['id'].'/'.$values['voucher_no']).'" class="btn btn-info btn-sm" target="_blank">Invoice</a>';
                        echo '</td>';
                    echo '</tr>';
                   endforeach; ?>
               </tbody>
            </table>
            </div>
        