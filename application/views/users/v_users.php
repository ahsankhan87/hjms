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
    
    <?php
    if(count($users))
    {
    ?>
    
            
    <table class="table table-bordered table-striped table-condensed flip-content" id="table_1">
        <thead class="flip-content">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Role</th>
            <th>Active</th>
            <th>Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
    <?php
    foreach($users as $key => $list)
    {
        echo '<tr>';
        echo '<td>'.$list['id'].'</td>';
        echo '<td>'.$list['username'].'</td>';
        echo '<td>'.$list['name'].'</td>';
        echo '<td>'.$list['user_level'].'</td>';
        echo '<td>'.$list['active'].'</td>';
        echo '<td>';
        //echo '<a href="'. site_url('Users/editUser/'.$list['id']) .'" title="Edit"><i class="fa fa-pencil fa-fw">Edit</i></a>';
        if($list['user_level'] !== '1'){
          
        echo ' | <a href="'. site_url('Users/delete/'.$list['id']) .'" title="Make Inactive" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="fa fa-trash-o fa-fw">Delete</i></a>';
            
        
        echo ' | <a href="'. site_url('Users/activate/'.$list['id']) .'" title="activate" onclick="return confirm(\'Are you sure you want to activate?\')"><i class="fa fa-trash-o fa-fw">Activate</i></a>';
        }
        echo '</td>';
        echo '<td>';
        echo '<a href="'. site_url('Users/change_password/'.$list['id'].'/'.$list['username']) .'" title="Edit">Change Password</a>';
        echo '</td>';
        
        echo '</tr>';
    }
    echo '</tbody></table>';
    
    }
    ?>
    </div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->
