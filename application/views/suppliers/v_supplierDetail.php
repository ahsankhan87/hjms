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
                <a href="<?php echo site_url('Suppliers/supplierPayment/' . $supplier[0]['id']) ?>" class="btn btn-success">Payment</a>
                <!-- <a href="<?php echo site_url('Suppliers/emailSupplierLedger/' . $supplier[0]['id'] . '/' . $from_date . '/' . $to_date); ?>" onclick="return confirm('Are you sure you want to email ledger?')" class="btn btn-warning">Email Ledger</a> -->

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

                <span id="print_title"><?php echo ucwords($supplier[0]['name']); ?> Transaction detail</span>

            </div>
            <div class="card-body">
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
                    $visa_total = 0.00;
                    $ticket_total = 0.00;
                    $hotel_total = 0.00;
                    $other_total = 0.00;
                    $total = 0.00;

                    //echo '<thead>';
                    echo '<tbody>';

                    if ($supplier_entries) {
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
                            echo '<td>' . $list['description'] . '</td>';
                            echo '<td>' . round($list['visa_cost'], 2) . '</td>';
                            echo '<td>' . round($list['ticket_cost'], 2) . '</td>';
                            echo '<td>' . round($list['hotel_cost'], 2) . '</td>';
                            echo '<td>' . round($list['other_cost'], 2) . '</td>';

                            $visa_total = (float) $list['visa_cost'];
                            $ticket_total = (float) $list['ticket_cost'];
                            $hotel_total = (float) $list['hotel_cost'];
                            $other_total = (float) $list['other_cost'];
                            $total = ($visa_total + $ticket_total + $hotel_total + $other_total);
                            //echo '<td>'.anchor('accounts/C_ledgers/edit/'.$list['id'],'Edit'). ' | ';
                            //echo  anchor('accounts/C_ledgers/delete/'.$list['id'],' Delete'). '</td>';
                            echo '</tr>';
                        }
                    }
                    echo '</tbody>';
                    ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th><?php echo $total; ?></th>
                        </tr>
                    </tfoot>
                </table>

            </div><!-- card body -->
        </div>
        <!-- /.card -->

    </div><!-- col-12-->
</div>
<!-- /.row -->
<div class="row justify-content-md-center">
    <div class="col-sm-6 offet-6">

        <div class="card">
            <div class="card-header">

                <span id="print_title">Payments</span>

            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped table-sm" id="table_1">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Invoice #</th>
                            <th>Amount</th>
                            <th>Narration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $payment_total = 0;
                        foreach ($supplier_payments as $key => $list) {
                            $payment_total += (float) $list['debit'];
                            echo '<tr>';
                            // echo '<td>'.$sno++.'</td>';
                            echo '<td>' . $list['date'] . '</td>';
                            echo '<td>' . $list['invoice_no'] . '</td>';
                            echo '<td>' . round($list['debit'], 2) . '</td>';
                            echo '<td>' . $list['narration'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Total Payment</th>
                            <th><?php echo $payment_total; ?></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Balance</th>
                            <th><?php echo ($total - $payment_total); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- card body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
</div>
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