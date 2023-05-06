<div class="row">
    <div class="col-sm-12">
        <?php
        if ($this->session->flashdata('message')) {
            echo "<div class='alert alert-success'>";
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        if ($this->session->flashdata('error')) {
            echo "<div class='alert alert-danger'>";
            echo $this->session->flashdata('error');
            echo '</div>';
        }
        ?>
        <p>
            <?php echo anchor('Suppliers/create', 'Add New <i class="fa fa-plus"></i>', 'class="btn btn-success"'); ?>
            <?php //echo anchor('Suppliers/combine_create','Create with entry','class="btn btn-success"'); 
            ?>
            <?php //echo anchor('Suppliers/bulk_create','Bulk Create <i class="fa fa-plus"></i>','class="btn btn-success"'); 
            ?>
            <?php echo anchor('Suppliers/passengerImport', 'Import Suppliers', 'class="btn btn-success"'); ?>

        </p>

        <?php
        if (count($suppliers)) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="table_1">
                    <thead class="thead-dark">
                        <tr>
                            <th><input type="checkbox" name="" /></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 1;
                        foreach ($suppliers as $key => $list) {
                            echo '<tr valign="top">';
                            echo '<td>' . form_checkbox('p_id[]', $list['id'], false) . '</td>';
                            echo '<td>' . $list['id'] . '</td>';
                            //echo '<td>'.$list['id'].'</td>';
                            //echo '<td><a href="'.site_url('pos/C_Suppliers/passengerDetail/'. $list['id']).'">'.$list['first_name'] . ' '. $list['last_name'].'</a></td>';
                            //        echo '<td><a href="'.site_url('pos/C_Suppliers/passengerDetail/'. $list['id']).'">'.$list['passport_no'].'</a></td>';
                            //        
                            echo '<td>' . trim($list['name']);
                            echo '<td>' . $list['contact_no'] . '</td>';
                            echo '<td>' . $list['email'] . '</td>';
                            echo '<td>' . $list['address'] . '</td>';
                            echo '<td>';
                            //echo  anchor(site_url('up_passenger_images/upload_images/'.$list['id']),' upload Images');
                            echo anchor('Suppliers/edit/' . $list['id'], '<i class="fa fa-pencil-square-o fa-fw">Edit</i>', ' title="Edit"'); ?> |
                            <a href="<?php echo site_url('Suppliers/delete/' . $list['id']) ?>" onclick="return confirm('Are you sure you want to delete?')" title="Make Inactive"><i class="fa fa-trash-o fa-fw">Delete</i></a>

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