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
        
        <p><?php echo anchor('Hotel/create','Add New <i class="fa fa-plus"></i>','class="btn btn-success"'); ?></p>
        
        <?php
        if(count($hotels))
        {
        ?>
        <div class="card">
			<div class="card-header">
                <?php echo $main; ?>
				
			</div>
        <div class="card-body">
                
        <table class="table table-bordered table-striped table-condensed"  id="table_1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Desc</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        
            <tbody>
                <?php //var_dump($hotels);
                foreach($hotels as $key => $list)
                {
                    echo '<tr>';
                    echo '<td>'.$list['id'].'</td>';
                    echo '<td>'.$list['name'].'</td>';
                    echo '<td>'.$list['description'].'</td>';
                    echo '<td>'.$list['active'].'</td>';
                    
                    echo '<td>'.anchor('Hotel/edit/'.$list['id'],'Edit'). ' | ';
                    echo  anchor('Hotel/delete/'.$list['id'],' Delete','onclick="return confirm(\'Are you sure you want to delete?\')"'). '</td>';
                    echo '</tr>';
                }
                
                }
                ?>
            </tbody> 
        </table>
        </div>
        <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->
