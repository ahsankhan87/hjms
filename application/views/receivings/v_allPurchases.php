<div class="row">
    <div class="col-sm-12">
        <?php
        if ($this->session->flashdata('message')) {
            echo "<div class='alert alert-success fade in'>";
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        if ($this->session->flashdata('error')) {
            echo "<div class='alert alert-danger fade in'>";
            echo $this->session->flashdata('error');
            echo '</div>';
        }
        ?>
        
        <?php if($purchaseType == "cash")
        {
            echo anchor('Purchases/index/'.$purchaseType, 'new'.' ' . 'transaction', 'class="btn btn-success" id="sample_editable_1_new"'); 
        
        }else{
            echo anchor('Purchases/index/'.$purchaseType, 'new'.' ' . 'transaction', 'class="btn btn-success" id="sample_editable_1_new"'); 
        
        }
        ?>

        <div class="card">
            <div class="card-header">
                <?php echo $title; ?>
            </div>
            <div class="card-body">

            <table class="table table-bordered table-striped table-condensed" id="table_1">
                    <thead class="thead-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Inv #</th>
                            <th><?php echo 'date'; ?></th>
                            <!-- <th><?php echo 'supplier'; ?> Inv #</th>-->
                            <th><?php echo 'supplier'; ?></th>
                            <!-- <th><?php echo 'account'; ?></th> -->
                            <th class="text-right"><?php echo 'amount'; ?></th>
                            <!-- <th class="text-right"><?php echo 'taxes'; ?></th> -->
                            <!-- <th class="text-right"><?php echo 'grand' . ' ' . 'total'; ?></th> -->
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 1;
                        foreach($receivings as $key => $list)
                        {
                            $total = ($list['total_amount']+$list['total_tax']);
                            $paid = ($list['paid']);

                            echo '<tr>';
                            //echo '<td>'.form_checkbox('p_id[]',$list['id'],false).'</td>';
                            //echo '<td><a href="'.site_url('trans/C_receivings/receipt/'.$list['invoice_no']).'">'.$list['invoice_no'].'</a></td>';
                            echo '<td>'.$sno++.'</td>';
                            echo '<td>'.$list['invoice_no'].'</td>';
                            echo '<td>'.date('d-m-Y',strtotime($list['receiving_date'])).'</td>';
                            //echo '<td><img src="'.base_url('images/supplier-images/thumbs/'.$list['supplier_image']).'" width="40" height="40"/></td>';
                            $supplier_name = $this->M_suppliers->get_supplierName($list['supplier_id']);
                            echo '<td>'.@$supplier_name.'</td>';
                            //    echo '<td>'.$list['supplier_invoice_no'].'</td>';
                            //    echo '<td>'.@$this->M_employees->get_empName($list['employee_id']).'</td>';
                            echo '<td class="text-right">'. number_format($total,2). '</td>';
                            
                           
                            echo '<td class="text-right">';
                             echo '<a href="'.site_url().'Purchases/delete/' . $list['invoice_no'] .'" onclick="return confirm(\'Are you sure you want to permanent delete? All entries will be deleted permanently\')"; title="Permanent Delete"><i class=\'fa fa-trash-o fa-fw\'>Delete</i></a>';
                            echo '</td>';
                            echo '</tr>';
                        } 
                                   
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th><th></th>
                            <th></th><th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    <!-- /.col-sm-12 -->
</div>
<!-- /.row -->