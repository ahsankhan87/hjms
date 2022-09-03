<div class="row">
    <div class="col-sm-12">
        <div class="card">
			<div class="card-header">
				User Password Change
			</div>
			<div class="card-body">
            
				<!-- BEGIN FORM-->
				<?php 
                    $attributes = array('class' => 'horizontal-form','enctype'=>"multipart/form-data");
                    echo validation_errors();
                    echo form_open('Users/change_password',$attributes);
                    foreach($users as $user):
                    echo form_hidden("id",$user['id']);
                    ?>
					<div class="form-body">
						<h3 class="form-section"></h3>
                        
                        
                        <div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" value=""  required="" />
								</div>
							</div>
							<!--/span-->
                            <div class="col-md-6">
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirm_password" value="" class="form-control" required="" />
								</div>
							</div>
							<!--/span-->
							
						</div>
						<!--/row-->
                        
                        
                        
					</div>
					<div class="form-actions right">
                        <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Confirm Change</button>                    
						<button type="button" onclick="window.history.back()" class="btn btn-default">Back</button>
						
					</div>
				<?php 
                endforeach;
                echo form_close(); ?>
				<!-- END FORM-->
			</div>
		</div>

    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->