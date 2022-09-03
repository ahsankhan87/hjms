<div class="row">
    <div class="col-sm-12">
        
<?php
        if($this->session->flashdata('message'))
        {
            echo "<div class='alert alert-success'>";
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        ?>
        <p><?php echo anchor('C_fyear/create','Create New Fyear','class="btn btn-primary"'); ?></p>
        
     <div class="card">
			<div class="card-header">
                <?php echo $main; ?>
				
			</div>
        <div class="card-body">
                   
<?php

if(count($Fyear))
{
?>
<table class="table table-bordered table-striped table-condensed"  id="table_1">
    <tr valign='top'>
        <th>ID</th>
        <th>FY Start Date</th>
        <th>FY End Date</th>
        <th>Financial Year</th>
        <th>Status</th>
        
        <th>Action</th>
    </tr>
<?php
foreach($Fyear as $key => $list)
{
    echo '<tr valign="top">';
    echo '<td>'.$list['id'].'</td>';
    echo '<td>'.date("d-m-Y",strtotime($list['fy_start_date'])).'</td>';
    echo '<td >'.date("d-m-Y",strtotime($list['fy_end_date'])). '</td>';
    echo '<td >'.$list['fy_year']. '</td>';
    echo '<td >'.$list['status']. '</td>';
    
    echo '<td>'.anchor('C_fyear/edit/'.$list['id'],'Edit'). ' | ';
    //echo  anchor('accounts/C_fyear/activateFY/'.$list['id'],' Activate'). '</td>';
    echo '<a href="'.site_url('C_fyear/activateFY/'.$list['id']).'" onclick="return confirm(\'Are you sure you want to activate?\');">Activate</a></td>';
   // echo '<td></td>';
    echo '</tr>';
    
}
echo '</table>';
}
?>
        </div>
        <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
 <!-- /.col-sm-12 -->
</div>
<!-- /.row -->