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
<div class="card">
			<div class="card-header">
                Search
			</div>
        <div class="card-body">
            <form class="form-inline" method="post" action="<?php echo site_url('Reports/searchArrivalReport'); ?>">
              <label for="from">From Date:</label>
              <input type="date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="from">
              <label for="to">To Date:</label>
              <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="to">
              <input type="hidden" name="isArrival" value="1" />
              <input type="hidden" name="isDeparture" value="0" />
              <label for="to">City:</label>
                  <select name="city_keyword" class="form-control">
                    <option value="">Select City</option>
                    <option value="Jed">Jeddah</option>
                    <option value="Mad">Madina</option>
                  </select>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</div>
<div class="card">
			<div class="card-header">
                <?php echo $main; ?>
				
			</div>
        <div class="card-body">
           <table class="table table-striped table-condensed" id="table_1">
            
            <thead>
                <tr>
                    <th>VNo</th>
                    <th>Passengers</th>
                    <th>Passport No</th>
                    <th>Age</th>   
                    <th>KSA Arrival</th>
                    <th>KSA Return</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrival_reports as $values): 
                echo '<tr>';
                    echo '<td><a href="'.site_url('Vouchers/invoice/'.$values['voucher_id']).'" target="_blank">'.$values['voucher_no'].'</a></td>';
                    echo '<td>'.$values['first_name'] . ' '. $values['last_name'].'</td>';
                    echo '<td>'.$values['passport_no'].'</td>';
                    echo '<td>'.$values['age'].'</td>';
                    echo '<td>'.date('d-m-Y',strtotime($values['arrival_date_to_ksa'])).' '.$values['arrival_time_to_ksa'].'</td>';
                    echo '<td>'.date('d-m-Y',strtotime($values['arrival_date_return'])).' '.$values['arrival_time_return'].'</td>';
                    //echo '<td>'.$values['ziarat'].'</td>';
                    //echo '<td>'.$values['remarks'].'</td>';
                    
                echo '</tr>';
               endforeach; ?>
           </tbody>
        </table>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->