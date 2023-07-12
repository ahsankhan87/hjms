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

        <?php foreach ($supplier as $list) : ?>

            <form action="<?php echo site_url('Suppliers/makePayment'); ?>" method="post" class="form-horizontal">

                <div class="form-body">
                    <input type="hidden" name="supplier_id"  value="<?php echo $list['id']; ?>" />
                    <input type="hidden" name="payment_type" value="cash">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Supplier Name</label>
                        <div class="col-md-4">
                            <p class="form-control-static">
                                <strong><?php echo ucwords($list['name']); ?></strong>
                            </p>

                        </div>

                        <label class="col-md-2 control-label">Payment Date</label>
                        <div class="col-md-4">
                            <p class="form-control-static">
                                <input type="date" class="form-control" name="payment_date" value="<?php echo date('Y-m-d'); ?>" />
                            </p>
                        </div>

                    </div>
                   
                    <div class="form-group">

                        <label class="col-md-2 control-label">Total Amount</label>
                        <div class="col-md-4">

                            <input type="text" class="form-control" required="" name="amount" autocomplete="off" placeholder="Enter Amount" autocomplete="off">

                        </div>

                    </div>
                    <div class="form-group">

                        <!-- <label class="col-md-2 control-label">Discount Amount</label>
                        <div class="col-md-4">

                            <input type="number" class="form-control" name="discount_amount" placeholder="Enter Discount Amount">

                        </div> -->

                        <label class="col-md-2 control-label">Comment</label>
                        <div class="col-md-4">

                            <textarea name="narration" name="comment"  class="form-control"></textarea>

                        </div>
                    </div>
                </div>


            <?php endforeach; ?>


            </table>

            <div class="form-group">
                <label class="col-md-2 control-label"></label>
                <div class="col-md-4">

                    <button type="submit" class="btn btn-info" ng-disabled="disable" onclick="return confirm('Are you sure you want to save?')">Save</button>
                    <button type="button" class="btn btn-default" onclick="window.history.back()">Back</button>

                </div>
            </div>
    </div><!-- fomr panel -->

    </form>
    <!-- END FORM-->
</div>
<!-- /.col-sm-12 -->
</div>
<!-- /.row -->