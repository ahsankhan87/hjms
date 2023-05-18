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
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        ?>

        <p><?php echo anchor('Shirka/create', 'Add New <i class="fa fa-plus"></i>', 'class="btn btn-success"'); ?></p>

        <?php
        if (count($shirkas)) {
        ?>
            <div class="card">
                <div class="card-header">
                    <?php echo $main; ?>

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped table-condensed" id="table_1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Desc</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php //var_dump($shirkas);
                        foreach ($shirkas as $key => $list) {
                            echo '<tr>';
                            echo '<td>' . $list['id'] . '</td>';
                            echo '<td><img src="' . base_url('asset/images/' . $list['picture']) . '" class="img-fluid"  width="50" height="50"/></td>';
                            echo '<td>' . $list['name'] . '</td>';
                            echo '<td>' . $list['description'] . '</td>';
                            echo '<td>' . $list['active'] . '</td>';

                            echo '<td>' . anchor('Shirka/edit/' . $list['id'], 'Edit') . ' | ';
                            echo  anchor('Shirka/delete/' . $list['id'], ' Delete', 'onclick="return confirm(\'Are you sure you want to delete?\')"') . '</td>';
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