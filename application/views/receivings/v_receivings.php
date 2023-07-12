<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                Form
            </div>
            <div class="card-body">

                <form id="sale_form" action="">
                    <div class="row">
                        <div class="col-sm-10 col-lg-10">

                            <!-- <label class="control-label col-sm-2 col-lg-2" for=""><?php echo 'select' . ' ' . 'supplier' ?>:</label> -->
                            <div class="col-sm-4 col-lg-4">
                                <!-- <select name="supplier_id" id="supplier_id" class="form-control select2"></select> -->

                                <?php echo anchor('#', 'Add New Supplier' . ' <i class="fa fa-plus"></i>', 'class="btn btn-success btn-sm" data-toggle="modal" data-target="#supplierModal"'); ?>
                                <?php echo anchor('#', 'Import data' . ' <i class="fa fa-plus"></i>', 'class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal"'); ?>
                            </div>

                            <label class="control-label col-sm-2" for="sale_date"><?php echo 'Sale' . ' ' . 'Date' ?>:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="sale_date" name="sale_date" value="<?php echo date("Y-m-d") ?>" />
                            </div>

                        </div>
                        <!-- /.col-sm-12 -->

                        <div class="col-sm-2 text-right">
                            <div id="top_net_total"></div>

                        </div>
                    </div>
                    <hr />
                    <?php $i = 1; ?>
                    <div class="row">
                        <div class="col-sm-12">

                            <table class="table table-bordered table-striped table-condensed" id="sale_table">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo 'Pessanger'; ?></th>
                                        <th><?php echo 'Visa Supplier'; ?></th>
                                        <th><?php echo 'Ticket Supplier'; ?></th>
                                        <th><?php echo 'Hotel Supplier'; ?></th>
                                        
                                        <th><?php echo 'Other' . ' ' . 'Price'; ?></th>
                                        <!-- <th><?php echo 'Amount Paid'; ?></th> -->
                                        <th><?php echo 'Description'; ?></th>

                                        <th><?php echo 'Sub Total'; ?></th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="create_table">


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" rowspan="2">
                                            <a href="#" class="btn btn-info btn-sm add_new" name="add_new"><?php echo 'add new'; ?></a>
                                            <a href="#" class="btn btn-info btn-sm clear_all" name="clear_all"><?php echo 'clear' . ' ' . 'all'; ?></a>
                                            <!-- <textarea name="description" id="description" class="form-control" placeholder="Description" cols="5" rows="6"></textarea> -->
                                        </th>
                                        <th class="text-right"><?php echo 'Sub Total'; ?></th>
                                        <th class="text-right" id="sub_total">0.00</th>
                                        <th><input type="hidden" name="sub_total" id="sub_total_txt" value=""></th>
                                    </tr>
                                    <!-- <tr>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right" id="total_discount">0.00</th>
                                        <th><input type="hidden" name="total_discount" id="total_discount_txt" value=""></th>
                                    </tr> -->
                                    <tr>
                                        <!-- <th class="text-right"><select name="tax_rate" id="tax_rate" class="form-control"></select>
                                            <input type="hidden" name="tax_acc_code" id="tax_acc_code_txt" value="">
                                            <input type="hidden" name="tax_id" id="tax_id_txt" value="">
                                        </th>
                                        <th class="text-right" id="total_tax">0.00</th>
                                        <th><input type="hidden" name="total_tax" id="total_tax_txt" value=""></th> -->
                                    </tr>
                                    <tr>
                                        <th colspan="7"><?php echo form_submit('', 'Save' . ' ' . 'and' . ' ' . 'New', 'id="new" class="btn btn-success"'); ?>
                                            <?php echo form_submit('', 'Save' . ' ' . 'and' . ' ' . 'Close', 'id="close" class="btn btn-success"'); ?></th>
                                        <th class="text-right"><?php echo 'Grand' . ' ' . 'Total'; ?></th>
                                        <th class="text-right lead" id="net_total">0.00</th>
                                        <th>
                                            <input type="hidden" name="net_total" id="net_total_txt" value="">
                                            <input type="hidden" name="purchaseType" id="purchaseType" value="<?php echo $purchaseType; ?>">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                            <p></p>

                        </div>

                    </div><!-- close main_div here -->
                </form>

            </div> <!-- class="card-body"> -->
        </div>
        <!-- /.col-sm-12 -->
    </div>
    <!-- /.row -->

    <!-- Modal -->
    <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo 'add_new' . ' ' . 'supplier'; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="supplierForm" action="">

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email"><?php echo 'full' . ' ' . 'name'; ?>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="first_name" placeholder="Enter Name" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email"><?php echo 'email'; ?>:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="phone_no"><?php echo 'phone'; ?>:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter phone no">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-3" for="website">Website:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="website" id="website" placeholder="Enter website">
                            </div>
                        </div> -->

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo 'save' . ' ' . 'changes'; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo 'close'; ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="form-horizontal" enctype="multipart/form-data" id="importForm" method="post" action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo 'Import Passengers'; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="import_file"><?php echo 'Upload excel file'; ?>:</label>
                            <div>
                                <input type="file" class="form-control import_file" name="import_file" id="import_file" required="">
                            </div>
                            <p><a href="<?php echo base_url('asset/images/kasbook-passengers-sample.csv') ?>">Download Passenger Sample file</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo 'Upload'; ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo 'close'; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            const module = '<?php echo $url1 = $this->uri->segment(2); ?>/';
            const site_url = '<?php echo site_url(); ?>';
            const path = '<?php echo base_url(); ?>';

            /////////////ADD NEW LINES
            let counter = 0; //counter is used for id of the debit / credit textbox to enable and disable 8 textboxs already used so start from 8 here
            $('.add_new').on('click', function(event) {
                event.preventDefault();
                counter++;
                // productDDL(counter);
                // accountsDDL(counter);

                var div = '<tr><td>' + counter + '</td>' +
                    //'<td width="25%"><select  class="form-control product_id" id="productid_' + counter + '" name="product_id[]"></select></td>' +
                    //'<td width="25%"><select  class="form-control account_id" id="accountid_' + counter + '" name="account_id[]"></select></td>' +
                    '<td width="20%"><input  class="form-control pnr" id="pnr_' + counter + '" name="pnr[]" /></td>' +
                    '<td width="10%">'+
                    '<select  class="form-control visa_supplier_id select2" id="visasupplierid_' + counter + '" name="visa_supplier_id[]"></select>' +
                    'Price:<input type="number" class="form-control visa_cost" id="visacost_' + counter + '" name="visa_cost[]" step="0.0001" autocomplete="off">' +
                    'Visa No.<input  class="form-control visa_no" id="visano_' + counter + '" name="visa_no[]" />' +
                    '</td>'+
                    //'<td class="text-right" width="10%"><input type="number" min="1" class="form-control qty" id="qty_' + counter + '" name="qty[]" value="1" autocomplete="off"></td>' +
                    
                    '<td width="10%">'+
                    '<select  class="form-control ticket_supplier_id select2" id="ticketsupplierid_' + counter + '" name="ticket_supplier_id[]"></select>' +
                    'Price:<input type="number" class="form-control ticket_cost" id="ticketcost_' + counter + '" name="ticket_cost[]" step="0.0001" autocomplete="off">' +
                    'Tkt No.<input type="text" class="form-control ticket_no" id="ticketno_' + counter + '" name="ticket_no[]">' +
                    'Tck Pnr:<input type="text" class="form-control ticket_pnr" id="ticketpnr_' + counter + '" name="ticket_pnr[]">' +
                    '</td>'+
                    
                    '<td width="10%">'+
                    '<select  class="form-control hotel_supplier_id select2" id="hotelsupplierid_' + counter + '" name="hotel_supplier_id[]"></select>' +
                    'Price:<input type="number" class="form-control hotel_cost" id="hotelcost_' + counter + '" name="hotel_cost[]" step="0.0001" autocomplete="off">' +
                    '</td>'+
                    
                    '<td class="text-right"><input type="number" class="form-control other_cost" id="othercost_' + counter + '" name="other_cost[]" step="0.0001" autocomplete="off"></td>' +
                    // '<td>'+
                    // '<input type="number" class="form-control amount_paid" id="amountpaid_' + counter + '" name="amount_paid[]" step="0.0001" autocomplete="off">' +
                    // '</td>'+
                    '<td class="text-right"><input type="text" class="form-control description" id="description_' + counter + '" name="description[]" value=""  ></td>' +
                    '<td class="text-right total" id="total_' + counter + '"></td>' +
                    '<td><i id="removeItem" class="fa fa-trash-o fa-1x" style="color:red;cursor:pointer">X</i></td></tr>';
                $('.create_table').append(div);

                supplierDDL(counter);
                //SELECT 2 DROPDOWN LIST   
                // $('#productid_' + counter).select2();
                // $('#accountid_' + counter).select2();
                // $('#visasupplierid_' + counter).select2();
                // $('#ticketsupplierid_' + counter).select2();
                // $('#hotelsupplierid_' + counter).select2();
                ///
                change_visa_cost();
                change_ticket_cost();
                change_hotel_cost();
                change_other_cost();



                ////// LOAD COST PRICE, UNIT PRICE, TAX WHEN PRODUCT DROPDOWN CHANGE
                $('.product_id').on('change', function(event) {
                    // event.preventDefault();
                    var curId = this.id.split("_")[1];
                    var productid = $(this).val();
                    var qty = parseFloat($('#qty_' + curId).val());
                    var discount = 0; // (parseFloat($('#discount_' + curId).val()) ? parseFloat($('#discount_' + curId).val()) : 0);
                    var tax_rate = 0;
                    var unit_price = 0;

                    $.ajax({
                        url: site_url + "pos/Items/getSelected_items/" + productid,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(data) {

                            tax_rate = (parseFloat(data[0].tax_rate) ? parseFloat(data[0].tax_rate) : 0);
                            unit_price = parseFloat(data[0].unit_price);
                            tax = unit_price * tax_rate / 100;
                            $('#unitprice_' + curId).val(data[0].unit_price);
                            $('#visacost_' + curId).val(data[0].visa_cost);
                            $('#itemtype_' + curId).val(data[0].item_type);
                            $('#taxid_' + curId).val(data[0].tax_id);
                            $('#taxrate_' + curId).val(data[0].tax_rate);
                            $('#tax_' + curId).text(tax.toFixed(2));

                            var total = (qty * unit_price ? qty * unit_price - discount : 0).toFixed(2);
                            $('#total_' + curId).text(total);

                            //console.log((tax ? tax : 0));
                            calc_gtotal();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    });


                });

            });

            $(".add_new").trigger("click"); //ADD NEW LINE WHEN PAGE LOAD BY DEFAULT

            //GET TOTAL WHEN QTY CHANGE
            function change_visa_cost() {
                $(".visa_cost").on("keyup change", function(e) {
                    var curId = this.id.split("_")[1];
                    var visa_cost = parseFloat($(this).val());
                    var ticket_cost = parseFloat(($('#ticketcost_' + curId).val() ? $('#ticketcost_' + curId).val() : 0));
                    var hotel_cost = parseFloat(($('#hotelcost_' + curId).val() ? $('#hotelcost_' + curId).val() : 0));
                    var other_cost = parseFloat(($('#othercost_' + curId).val() ? $('#othercost_' + curId).val() : 0));
                    var sub_total = (visa_cost + ticket_cost + hotel_cost + other_cost);
                    var total = (sub_total ? sub_total : 0).toFixed(2);
                    $('#total_' + curId).text(total);

                    calc_gtotal();
                });
            }

            function change_ticket_cost() {
                //GET TOTAL WHEN UNIT PRICE CHANGE
                $(".ticket_cost").on("keyup change", function(e) {
                    var curId = this.id.split("_")[1];
                    var visa_cost = parseFloat(($('#visacost_' + curId).val() ? $('#visacost_' + curId).val() : 0));
                    var ticket_cost = parseFloat($(this).val());
                    var hotel_cost = parseFloat(($('#hotelcost_' + curId).val() ? $('#hotelcost_' + curId).val() : 0));
                    var other_cost = parseFloat(($('#othercost_' + curId).val() ? $('#othercost_' + curId).val() : 0));
                    var sub_total = (visa_cost + ticket_cost + hotel_cost + other_cost);
                    var total = (sub_total ? sub_total : 0).toFixed(2);
                    $('#total_' + curId).text(total);

                    calc_gtotal();
                });
            }

            function change_hotel_cost() {
                //GET TOTAL WHEN DISCOUNT CHANGE
                $(".hotel_cost").on("keyup change", function(e) {
                    var curId = this.id.split("_")[1];
                    var visa_cost = parseFloat(($('#visacost_' + curId).val() ? $('#visacost_' + curId).val() : 0));
                    var ticket_cost = parseFloat(($('#ticketcost_' + curId).val() ? $('#ticketcost_' + curId).val() : 0));
                    var hotel_cost = parseFloat($(this).val());
                    var other_cost = parseFloat(($('#othercost_' + curId).val() ? $('#othercost_' + curId).val() : 0));
                    var sub_total = (visa_cost + ticket_cost + hotel_cost + other_cost);
                    var total = (sub_total ? sub_total : 0).toFixed(2);
                    $('#total_' + curId).text(total);

                    calc_gtotal();
                });
            }

            function change_other_cost() {
                //GET TOTAL WHEN DISCOUNT CHANGE
                $(".other_cost").on("keyup change", function(e) {
                    var curId = this.id.split("_")[1];
                    var visa_cost = parseFloat(($('#visacost_' + curId).val() ? $('#visacost_' + curId).val() : 0));
                    var ticket_cost = parseFloat(($('#ticketcost_' + curId).val() ? $('#ticketcost_' + curId).val() : 0));
                    var hotel_cost = parseFloat(($('#hotelcost_' + curId).val() ? $('#hotelcost_' + curId).val() : 0));
                    var other_cost = parseFloat($(this).val());
                    var sub_total = (visa_cost + ticket_cost + hotel_cost + other_cost);
                    var total = (sub_total ? sub_total : 0).toFixed(2);
                    $('#total_' + curId).text(total);

                    calc_gtotal();
                });
            }

            /////////////////////////////////
            $("#sale_table").on("click", "#removeItem", function() {
                $(this).closest("tr").remove();
                calc_gtotal();
            });

            ////////// CLEAR ALL TABLE
            $(".clear_all").on("click", function() {
                clearall();
            });

            function clearall() {
                counter = 0;
                calc_gtotal();
                $('#sub_total').html(parseFloat('0').toFixed(2));
                $('#total_discount').html(parseFloat('0').toFixed(2));
                $('#total_tax').html(parseFloat('0').toFixed(2));
                $('#net_total').html(parseFloat('0').toFixed(2));
                $("#sale_table > tbody").empty();
                $('#top_net_total').html('');
                $('#supplier_id').val('').trigger('change');
                $('#bank_id').val('').trigger('change');

                $(".add_new").trigger("click"); //add new line
            }

            //supplierDDL();
            ////////////////////////
            //GET supplier DROPDOWN LIST
            function supplierDDL(index = 0) {

                let supplier_ddl = '';
                $.ajax({
                    url: site_url + "Suppliers/get_activeSuppliers",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(data) {
                        //console.log(data);
                        let i = 0;
                        supplier_ddl += '<option value="0">Select Supplier</option>';

                        $.each(data, function(index, value) {

                            supplier_ddl += '<option value="' + value.id + '">' + value.name + '</option>';

                        });

                        // $('#supplier_id').html(supplier_ddl);
                        $('#visasupplierid_' + index).append(supplier_ddl);
                        $('#ticketsupplierid_' + index).append(supplier_ddl);
                        $('#hotelsupplierid_' + index).append(supplier_ddl);

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
            ///////////////////

            /////////////ADD NEW LINES END HERE

            function calc_gtotal() {
                var total = 0;
                var total_discount = 0;
                var total_tax = 0;
                var net_total = 0;

                $('.total').each(function() {
                    total += parseFloat(($(this).text() ? $(this).text() : 0));
                });

                var tax_rate = $('#tax_rate').val();
                total_tax = (tax_rate * total / 100);

                // $('.discount').each(function() {
                //     total_discount += (parseFloat($(this).val()) ? parseFloat($(this).val()) : 0);
                // });

                // net_total = (total - total_discount + total_tax ? total - total_discount + total_tax : 0);
                total_tax = (total_tax ? total_tax : 0);
                total = (total ? total : 0);
                net_total = (total ? total : 0);

                //ASSIGN VALUE TO TEXTBOXES
                $('#sub_total_txt').val(parseFloat(total));
                $('#total_discount_txt').val(parseFloat(total_discount));
                $('#total_tax_txt').val(parseFloat(total_tax));
                $('#net_total_txt').val(parseFloat(net_total));
                /////////////

                $('#top_net_total').html('Grand Total:<h2 style="margin:0">' + parseFloat(net_total).toLocaleString('en-US', 2) + '</h2>');
                $('#net_total').text(parseFloat(net_total).toLocaleString('en-US', 2));
                $('#sub_total').text(parseFloat(total).toLocaleString('en-US'));
                // $('#total_discount').text(parseFloat(total_discount).toLocaleString('en-US'));
                $('#total_tax').text(parseFloat(total_tax).toLocaleString('en-US'));
                //console.log(total_discount);
            }

            $("#sale_form").on("submit", function(e) {
                var formValues = $(this).serialize();
                console.log(formValues);
                var submit_btn = document.activeElement.id;
                // alert(formValues);
                // return false;

                var confirmSale = confirm('Are you absolutely sure you want to sale?');

                if (confirmSale) {

                    if (formValues.length > 0) {
                        $.ajax({
                            type: "POST",
                            url: site_url + "Purchases/purchase_transaction",
                            data: formValues,
                            success: function(data) {
                                if (data == '1') {
                                    toastr.success("Bill saved successfully", 'Success');
                                    if (submit_btn == 'close') {
                                        window.location.href = site_url + "Purchases/all";
                                    }
                                } else {
                                    toastr.error("Bill not saved", 'Error');
                                }
                                clearall();
                                console.log(data);
                            }
                        });
                    }
                }
                e.preventDefault();
            });


            $("#supplierForm").submit(function(event) {
                // Stop form from submitting normally
                event.preventDefault();

                /* Serialize the submitted form control values to be sent to the web server with the request */
                var formValues = $(this).serialize();

                //console.log($('#item_id').val());

                if ($('#first_name').val() == 0) {
                    toastr.error("Please enter name", 'Error!');
                } else {
                    // Send the form data using post
                    $.post(site_url + "Suppliers/create/", formValues, function(data) {
                        // Display the returned data in browser
                        //$("#result").html(data);
                        toastr.success("Data saved successfully", 'Success');
                        console.log(data);
                        $('#supplierModal').modal('toggle');
                        supplierDDL();
                        // setTimeout(function() {
                        //     location.reload();
                        // }, 2000);

                    });
                }
            });
            /////

            $("#importForm").submit(function(event) {
                // Stop form from submitting normally
                event.preventDefault();

                /* Serialize the submitted form control values to be sent to the web server with the request */
                var formData = new FormData(this);
                var files = $('.import_file')[0].files;

                if (files.length > 0) {
                    formData.append('import_file', files[0]);
                }
                // console.log(formData);

                $.ajax({
                    type: 'POST',
                    url: site_url + "Purchases/import_passengers",
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        clearall();
                        $("#removeItem").trigger("click"); // remove the first row

                        $.each(data, function(index, value) {
                            //counter++;
                            counter = index;

                            var div = '<tr><td>' + counter + '</td>' +
                                '<input type="hidden" group_code" id="group_code' + counter + '" name="group_code[]" value="' + value.group_code + '" >' +
                                '<input type="hidden" group_name" id="group_name' + counter + '" name="group_name[]" value="' + value.group_name + '" >' +
                                '<input type="hidden" pnr_code" id="pnr_code' + counter + '" name="pnr_code[]" value="' + value.pnr_code + '" >' +
                                '<input type="hidden" mofa_no" id="mofa_no' + counter + '" name="mofa_no[]" value="' + value.mofa_no + '" >' +
                                '<input type="hidden" gender" id="gender' + counter + '" name="gender[]" value="' + value.gender + '" >' +
                                '<input type="hidden" dob" id="dob' + counter + '" name="dob[]" value="' + value.dob + '" >' +
                                '<input type="hidden" country" id="country' + counter + '" name="country[]" value="' + value.country + '" >' +
                                '<input type="hidden" passport_no" id="passport_no' + counter + '" name="passport_no[]" value="' + value.passport_no + '" >' +
                                '<input type="hidden" moi_no" id="moi_no' + counter + '" name="moi_no[]" value="' + value.moi_no + '" >' +
                                '<input type="hidden" mehram" id="mehram' + counter + '" name="mehram[]" value="' + value.mehram + '" >' +
                                '<input type="hidden" relation" id="relation' + counter + '" name="relation[]" value="' + value.relation + '" >' +

                                '<td width="20%"><input  class="form-control pnr" value="' + value.first_name + '" id="pnr_' + counter + '" name="pnr[]" /></td>' +
                                '<td width="10%">'+
                                '<select  class="form-control visa_supplier_id select2" id="visasupplierid_' + counter + '" name="visa_supplier_id[]"></select>' +
                                'Price:<input type="number" class="form-control visa_cost" id="visacost_' + counter + '" name="visa_cost[]" step="0.0001" autocomplete="off">' +
                                'Visa No.<input  class="form-control visa_no" id="visano_' + counter + '" name="visa_no[]" />' +
                                '</td>'+
                                //'<td class="text-right" width="10%"><input type="number" min="1" class="form-control qty" id="qty_' + counter + '" name="qty[]" value="1" autocomplete="off"></td>' +
                                
                                '<td width="10%">'+
                                '<select  class="form-control ticket_supplier_id select2" id="ticketsupplierid_' + counter + '" name="ticket_supplier_id[]"></select>' +
                                'Price:<input type="number" class="form-control ticket_cost" id="ticketcost_' + counter + '" name="ticket_cost[]" step="0.0001" autocomplete="off">' +
                                'Tkt No.<input type="text" class="form-control ticket_no" id="ticketno_' + counter + '" name="ticket_no[]">' +
                                'Tck Pnr:<input type="text" class="form-control ticket_pnr" id="ticketpnr_' + counter + '" name="ticket_pnr[]">' +
                                '</td>'+
                                
                                '<td width="10%">'+
                                '<select  class="form-control hotel_supplier_id select2" id="hotelsupplierid_' + counter + '" name="hotel_supplier_id[]"></select>' +
                                'Price:<input type="number" class="form-control hotel_cost" id="hotelcost_' + counter + '" name="hotel_cost[]" step="0.0001" autocomplete="off">' +
                                '</td>'+
                                
                                '<td class="text-right"><input type="number" class="form-control other_cost" id="othercost_' + counter + '" name="other_cost[]" step="0.0001" autocomplete="off"></td>' +
                                // '<td>'+
                                // '<input type="number" class="form-control amount_paid" id="amountpaid_' + counter + '" name="amount_paid[]" step="0.0001" autocomplete="off">' +
                                // '</td>'+
                                '<td class="text-right"><input type="text" class="form-control description" id="description_' + counter + '" name="description[]" value=""  ></td>' +
                                '<td class="text-right total" id="total_' + counter + '"></td>' +
                                '<td><i id="removeItem" class="fa fa-trash-o fa-1x"  style="color:red;cursor:pointer">X</i></td></tr>';
                            $('.create_table').append(div);

                            supplierDDL(counter);
                            calc_gtotal();
                        });

                        change_visa_cost();
                        change_ticket_cost();
                        change_hotel_cost();
                        change_other_cost();

                       
                        console.log("success");
                        //console.log(data);
                        $('#importModal').modal('toggle');
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                        $('#importModal').modal('toggle');
                    }

                });

            });
            /////

        });
    </script>