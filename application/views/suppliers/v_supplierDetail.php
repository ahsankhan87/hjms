<div class="row hidden-print">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="card">

            <div class="card-body">
                <form class="form-inline" method="post" action="<?php echo site_url('Suppliers/supplierDetail/' . $supplier[0]['id']) ?>" role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail2">From Date</label>
                        <input type="date" class="form-control" name="from_date" value="<?php echo date('Y-m-d'); ?>" placeholder="From Date">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">To Date</label>
                        <input type="date" class="form-control" name="to_date" value="<?php echo date('Y-m-d'); ?>" placeholder="To Date">
                    </div>

                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT-->
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
        <div class="card">
            <div class="card-header">

                <span id="print_title"><?php echo ucwords($supplier[0]['name']); ?></span>

            </div>
            <div class="card-body">
                <!--BEGIN TABS-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab">Transaction List</a>
                    </li>
                    <!--	<li>
						<a href="#tab_1_2" data-toggle="tab">Detail Transaction List</a>
					</li>
					-->
                    <li>
                        <a href="#tab_1_3" data-toggle="tab">Supplier Details</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <p>
                            <a href="<?php echo site_url('Suppliers/supplierPayment/' . $supplier[0]['id']) ?>" class="btn btn-success">Payment</a>
                            <!-- <a href="<?php echo site_url('Suppliers/emailSupplierLedger/' . $supplier[0]['id'] . '/' . $from_date . '/' . $to_date); ?>" onclick="return confirm('Are you sure you want to email ledger?')" class="btn btn-warning">Email Ledger</a> -->
                        </p>

                        <table class="table table-bordered table-striped table-sm" id="table_1">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice #</th>
                                    <th>Passenger</th>
                                    <th>Passport</th>
                                    <th>PNR</th>
                                    <th>Ticket No.</th>
                                    <th>Visa No.</th>
                                    <th>Narration</th>
                                    <th>Ticket Cost</th>
                                    <th>Visa Cost</th>
                                    <th>Hotel Cost</th>
                                    <th>Other Cost</th>
                                </tr>
                            </thead>

                            <?php
                            //initialize
                            $sno = 1;
                            $dr_amount = 0.00;
                            $cr_amount = 0.00;
                            $balance = 0.00;

                            //echo '<thead>';
                            echo '<tbody>';

                            if ($supplier_entries) {      
                                echo '<pre>';
                                var_dump($supplier_entries);
                                echo '</pre>';
                                
                                foreach ($supplier_entries as $key => $list) {
                                    echo '<tr>';
                                    // echo '<td>'.$sno++.'</td>';
                                    echo '<td>' . $list['date'] . '</td>';
                                    echo '<td>';
                                    // $inv_prefix = substr($list['invoice_no'], 0, 1);
                                    // if ($inv_prefix === 'R') {
                                    //     echo '<a href="' . site_url('trans/C_receivings/receipt/' . $list['invoice_no']) . '" title="Print Invoice" >' . $list['invoice_no'] . '</a>';
                                    // } else {
                                    //     echo $list['invoice_no'];
                                    // }
                                    echo $list['invoice_no'];

                                    echo '</td>';
                                        $passenger =  $this->M_passengers->get_passengers($list['item_id']);
                                    echo '<td>';
                                            echo $passenger[0]['first_name'];
                                    echo '</td>';
                                    echo '<td>';
                                        echo $passenger[0]['passport_no'];
                                    
                                    echo '<td>';
                                        echo $passenger[0]['pnr_code'];
                                    echo '</td>';
                                    echo '<td>';
                                        echo $list['ticket_no'];
                                    echo '</td>';
                                    echo '<td>';
                                        echo $list['visa_no'];
                                    echo '</td>';
                                    echo '<td>' . $list['narration'] . '</td>';
                                    echo '<td>' . round($list['credit'], 2) . '</td>';
                                    echo '<td>' . round($list['credit'], 2) . '</td>';
                                    echo '<td>' . round($list['credit'], 2) . '</td>';
                                    echo '<td>' . round($list['credit'], 2) . '</td>';
                                    
                                    //echo '<td>'.anchor('accounts/C_ledgers/edit/'.$list['id'],'Edit'). ' | ';
                                    //echo  anchor('accounts/C_ledgers/delete/'.$list['id'],' Delete'). '</td>';
                                    echo '</tr>';
                                }
                            }
                            echo '</tbody>';
                            
                            ?>
                        </table>
                    </div>

                    <div class="tab-pane" id="tab_1_2">

                    </div>

                    <div class="tab-pane" id="tab_1_3">

                        <!-- BEGIN FORM-->
                        <form class="form-horizontal" role="form">
                            <?php foreach ($supplier as $values) : ?>
                                <div class="form-body">
                                    <h2 class="margin-bottom-20"> View Supplier Info - <?php echo $values['name']; ?></h2>
                                    <h3 class="form-section">Person Info</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Full Name:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">
                                                        <?php echo $values['name']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">
                                                        <?php echo $values['email']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Contact No:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">
                                                        <?php echo $values['contact_no']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">
                                                        <?php echo $values['status']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->

                                    <h3 class="form-section">Address</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Address:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">
                                                        <?php echo $values['address']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                                </div>

                        </form>
                        <!-- END FORM-->
                    </div><!-- END TAB-->
                </div>
            </div><!-- End Portlet -->
        </div>
        <!-- /.col-sm-12 -->
    </div>
    <!-- /.row -->

    <!-- Modal -->
    <div id="paymentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <?php foreach ($supplier as $key => $list) : ?>
                        <!-- BEGIN FORM-->
                        <form action="<?php echo site_url('pos/Suppliers/makePayment'); ?>" method="post" class="form-horizontal">
                            <div class="form-body">
                                <input type="hidden" name="supplier_id" value="<?php echo $list['id']; ?>" />

                                <div class="form-group last">
                                    <label class="col-md-3 control-label">Supplier Name</label>
                                    <div class="col-md-4">
                                        <p class="form-control-static">
                                            <?php echo $list['name']; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-3" for="">Payment Type</label>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            <label class="control-label" for="cash">Cash: </label><input type="radio" checked="" id="cash" name="payment_type" value="cash" class="form-control" />
                                            <label class="control-label" for="bank">Cheque: </label><input type="radio" id="bank" name="payment_type" value="bank" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="bank_accounts" style="display: none;">

                                    <label class="control-label col-sm-3" for="">Bank Accounts</label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('bank_id', $activeBanks, '', 'id="bank_id" class="form-control"') ?>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Amount</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="amount" placeholder="Enter Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Discount Amount</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="discount_amount" placeholder="Enter Discount Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Comment</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <textarea name="narration" name="comment" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END FORM-->
                        <?php endforeach; ?>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Pay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

                </form>
                <!-- END FORM-->
            </div>

        </div>
    </div>