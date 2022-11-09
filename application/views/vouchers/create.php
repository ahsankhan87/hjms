<div class="">
  <div class="row">
    <div class="col-sm-12">
      <?php
      $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data");
      echo form_open('Vouchers/create', $attributes);

      ?>
      <div class="form-row">
        <div class="col-sm-2">
          <label>Voucher Date</label>

        </div>
        <div class="col-sm-2">
          <input type="date" class="form-control" name="voucher_date" required="" value="<?php echo Date('Y-m-d'); ?>" />
        </div>

        <div class="col-sm-2">
          <label>Voucher No</label>

        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="voucher_no" id="new_voucher_no" required="" value="<?php echo $new_invoice_no; ?>" />
          <img src="<?php echo base_url('asset/images/busy.gif') ?>" id="busy_check" style="display: none;" />
          <div class="text-danger small" id="error">Already taken</div>
          <div class="text-success small" id="msg">Available</div>
        </div>

        <div class="col-sm-2">
          <label>Shirka</label>

        </div>
        <div class="col-sm-2">
          <?php echo form_dropdown('shirka_id', $shirkasDDL, set_value('shirka_id'), 'class="form-control"'); ?>
        </div>

        <div class="col-sm-2">
          <label>Group Name</label>

        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="group_name" value="<?php echo set_value('group_name'); ?>" />
        </div>

        <div class="col-sm-2">
          <label>Group Code</label>

        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="group_code" value="<?php echo set_value('group_code'); ?>" />
        </div>

      </div>


      <div class="form-row">
        <div class="col">
          <a href="#" class="pax_popup" class="btn btn-primary btn-sm">Select Passengers</a>
          <img src="<?php echo base_url('asset/images/busy.gif') ?>" id="busy" style="display: none;" />
        </div>

      </div>
      <div class="form-row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-striped table-sm" id="table_">
              <thead class="thead-dark">
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Passport No</th>
                  <th>Age</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="pax_data">

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <hr />

      <h5>Flight Information</h5>
      <div class="form-row">
        <div class="col-12">
          <label></label>
          <h6>Flight to KSA</h6>
        </div>
        <div class="col">
          <label>Sector</label>
          <select name="sector1_to_ksa" class="form-control form-control-sm">
            <option value="AUH">AUH</option>
            <option value="BAH">BAH</option>
            <option value="CAI">CAI</option>
            <option value="CDG">CDG</option>
            <option value="CMB">CMB</option>
            <option value="DMM">DMM</option>
            <option value="DOH">DOH</option>
            <option value="DXB">DXB</option>
            <option selected="selected" value="ISB">ISB</option>
            <option value="IST">IST</option>
            <option value="JED">JED</option>
            <option value="JFK">JFK</option>
            <option value="JNB">JNB</option>
            <option value="KHI">KHI</option>
            <option value="KWI">KWI</option>
            <option value="LHE">LHE</option>
            <option value="LHR">LHR</option>
            <option value="LYP">LYP</option>
            <option value="MAA">MAA</option>
            <option value="MCT">MCT</option>
            <option value="MED">MED</option>
            <option value="MUX">MUX</option>
            <option value="PEW">PEW</option>
            <option value="RKT">RKT</option>
            <option value="RUH">RUH</option>
            <option value="SHJ">SHJ</option>
            <option value="SKT">SKT</option>

          </select>
        </div>-
        <div class="col">
          <label>To</label>
          <select name="sector2_to_ksa" class="form-control form-control-sm">
            <option selected="selected" value="Jeddah Airport">JED</option>
            <option value="Madina Airport">MED</option>

          </select>
        </div>
        <div class="col">
          <label>Flight</label>
          <select name="flight1_to_ksa" class="form-control form-control-sm">
            <option value="6S">6S</option>
            <option value="BA">BA</option>
            <option value="EG">EG</option>
            <option value="EK">EK</option>
            <option value="EY">EY</option>
            <option value="ER">ER</option>
            <option value="FR">FR</option>
            <option value="FZ">FZ</option>
            <option value="G9">G9</option>
            <option value="GF">GF</option>
            <option value="J9">J9</option>
            <option value="KU">KU</option>
            <option value="NL">NL</option>
            <option value="OV">OV</option>
            <option value="PA">PA</option>
            <option value="PK">PK</option>
            <option value="QR">QR</option>
            <option value="RT">RT</option>
            <option selected="selected" value="SV">SV</option>
            <option value="TK">TK</option>
            <option value="UL">UL</option>
            <option value="WY">WY</option>
            <option value="XY">XY</option>

          </select>
        </div>-
        <div class="col">
          <label>To</label>
          <input type="text" name="flight2_to_ksa" class="form-control form-control-sm" value="<?php echo set_value('flight2_to_ksa'); ?>" placeholder="">
        </div>
        <div class="col">
          <label>Departure Date</label>
          <input type="date" name="departure_date_to_ksa" id="departure_date_to_ksa" value="<?php echo set_value('departure_date_to_ksa'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label>Time</label>
          <input type="time" name="departure_time_to_ksa" value="<?php echo set_value('departure_time_to_ksa'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label>Arrival Date</label>
          <input type="date" name="arrival_date_to_ksa" value="<?php echo set_value('arrival_date_to_ksa'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label>Time</label>
          <input type="time" name="arrival_time_to_ksa" value="<?php echo set_value('arrival_time_to_ksa'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col-2">
          <label>PNR</label>
          <input type="text" name="pnr_to_ksa" value="<?php echo set_value('pnr_to_ksa'); ?>" class="form-control form-control-sm" placeholder="PNR">
        </div>
      </div>

      <div class="form-row">

        <div class="col-12">
          <h6>Return Flight</h6>
        </div>
        <div class="col">
          <select name="sector1_return" class="form-control form-control-sm">
            <option selected="selected" value="Jeddah Airport">JED</option>
            <option value="Madina Airport">MED</option>

          </select>
        </div>-
        <div class="col">
          <select name="sector2_return" class="form-control form-control-sm">
            <option value="AUH">AUH</option>
            <option value="BAH">BAH</option>
            <option value="CAI">CAI</option>
            <option value="CDG">CDG</option>
            <option value="CMB">CMB</option>
            <option value="DMM">DMM</option>
            <option value="DOH">DOH</option>
            <option value="DXB">DXB</option>
            <option selected="selected" value="ISB">ISB</option>
            <option value="IST">IST</option>
            <option value="JED">JED</option>
            <option value="JFK">JFK</option>
            <option value="JNB">JNB</option>
            <option value="KHI">KHI</option>
            <option value="KWI">KWI</option>
            <option value="LHE">LHE</option>
            <option value="LHR">LHR</option>
            <option value="LYP">LYP</option>
            <option value="MAA">MAA</option>
            <option value="MCT">MCT</option>
            <option value="MED">MED</option>
            <option value="MUX">MUX</option>
            <option value="PEW">PEW</option>
            <option value="RKT">RKT</option>
            <option value="RUH">RUH</option>
            <option value="SHJ">SHJ</option>
            <option value="SKT">SKT</option>
          </select>
        </div>

        <div class="col">
          <select name="flight1_return" class="form-control form-control-sm">
            <option value="6S">6S</option>
            <option value="BA">BA</option>
            <option value="EG">EG</option>
            <option value="EK">EK</option>
            <option value="EY">EY</option>
            <option value="ER">ER</option>
            <option value="FR">FR</option>
            <option value="FZ">FZ</option>
            <option value="G9">G9</option>
            <option value="GF">GF</option>
            <option value="J9">J9</option>
            <option value="KU">KU</option>
            <option value="NL">NL</option>
            <option value="OV">OV</option>
            <option value="PA">PA</option>
            <option value="PK">PK</option>
            <option value="QR">QR</option>
            <option value="RT">RT</option>
            <option selected="selected" value="SV">SV</option>
            <option value="TK">TK</option>
            <option value="UL">UL</option>
            <option value="WY">WY</option>
            <option value="XY">XY</option>
          </select>
        </div>-
        <div class="col">
          <input name="flight2_return" type="text" value="<?php echo set_value('flight2_return'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="date" name="departure_date_return" value="<?php echo set_value('departure_date_return'); ?>" id="departure_date_return" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="time" name="departure_time_return" value="<?php echo set_value('departure_time_return'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="date" name="arrival_date_return" value="<?php echo set_value('arrival_date_return'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="time" name="arrival_time_return" value="<?php echo set_value('arrival_time_return'); ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col-2">
          <input type="text" name="pnr_return" value="<?php echo set_value('pnr_return'); ?>" class="form-control form-control-sm" placeholder="PNR">
        </div>
      </div>

      <hr />

      <h5>Package Detail</h5>

      <div class="form-row">
        <div class="col">
          <label>City</label>
          <?php echo form_dropdown('city[]', $city, 1, 'class="form-control form-control-sm"'); ?>
        </div>
        <div class="col">
          <label>Nights</label>
          <input type="number" name="pck_nights[]" id="pkg_night_1" value="<?php echo set_value('pkg_night_1'); ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Checkin</label>
          <input type="date" name="pkg_checkin[]" id="pkg_checkin_1" value="<?php echo set_value('pkg_checkin_1'); ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Checkout</label>
          <input type="date" name="pkg_checkout[]" id="pkg_checkout_1" value="<?php echo set_value('pkg_checkout_1'); ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Hotel</label>
          <?php echo form_dropdown('hotel_id[]', $hotels, '', 'class="form-control form-control-sm select2"'); ?>
        </div>
        <div class="col">
          <label>Room Type</label>
          <?php $data = array(
            'Sharing' => 'Sharing', 'Single Bed' => 'Single Bed', 'Double Bed' => 'Double Bed',
            'Triple Bed' => 'Triple Bed', 'Quad Bed' => 'Quad Bed', 'Five Bed' => 'Five Bed'
          );
          echo form_dropdown('room_type[]', $data, '', 'class="form-control form-control-sm"'); ?>
        </div>

      </div>
      <div class="form-row">
        <div class="col">
          <?php echo form_dropdown('city[]', $city, 2, 'class="form-control form-control-sm"'); ?>
        </div>
        <div class="col">
          <input type="number" name="pck_nights[]"  value="<?php echo set_value('pkg_night_2[]'); ?>" id="pkg_night_2" class="form-control form-control-sm">
        </div>
        <div class="col">
          <input type="date" name="pkg_checkin[]"  value="<?php echo set_value('pkg_checkin_2[]'); ?>" id="pkg_checkin_2" class="form-control form-control-sm">
        </div>
        <div class="col">
          <input type="date" name="pkg_checkout[]"  value="<?php echo set_value('pkg_checkout_2[]'); ?>" id="pkg_checkout_2" class="form-control form-control-sm">
        </div>
        <div class="col">
          <?php echo form_dropdown('hotel_id[]', $hotels,'', 'class="form-control form-control-sm select2"'); ?>
        </div>
        <div class="col">
          <?php $data = array(
            'Sharing' => 'Sharing', 'Single Bed' => 'Single Bed', 'Double Bed' => 'Double Bed',
            'Triple Bed' => 'Triple Bed', 'Quad Bed' => 'Quad Bed', 'Five Bed' => 'Five Bed'
          );
          echo form_dropdown('room_type[]', $data, '', 'class="form-control form-control-sm"'); ?>
        </div>

      </div>
      <div class="form-row">
        <div class="col">
          <?php echo form_dropdown('city[]', $city, 1, 'class="form-control form-control-sm"'); ?>
        </div>
        <div class="col">
          <input type="number" name="pck_nights[]" value="<?php echo set_value('pkg_night_3[]'); ?>" id="pkg_night_3" class="form-control form-control-sm">
        </div>
        <div class="col">
          <input type="date" name="pkg_checkin[]" value="<?php echo set_value('pkg_checkin_3[]'); ?>" id="pkg_checkin_3" class="form-control form-control-sm">
        </div>
        <div class="col">
          <input type="date" name="pkg_checkout[]" value="<?php echo set_value('pkg_checkout_3[]'); ?>" id="pkg_checkout_3" class="form-control form-control-sm">
        </div>
        <div class="col">
          <?php echo form_dropdown('hotel_id[]', $hotels, '', 'class="form-control form-control-sm select2"'); ?>
        </div>
        <div class="col">
          <?php $data = array(
            'Sharing' => 'Sharing', 'Single Bed' => 'Single Bed', 'Double Bed' => 'Double Bed',
            'Triple Bed' => 'Triple Bed', 'Quad Bed' => 'Quad Bed', 'Five Bed' => 'Five Bed'
          );
          echo form_dropdown('room_type[]', $data, '', 'class="form-control form-control-sm"'); ?>
        </div>

      </div>

      <div class="form-row">
        <div class="col">
          <label>Total Nights</label>
        </div>
        <div class="col">

          <input type="number" name="total_nights" id="total_nights" class="form-control form-control-sm">
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>

      </div>
      <hr />

      <div class="form-row">
        <div class="col-10">
          <legend>Transportation Type</legend>&nbsp;
          <?php foreach ($trans_type as $values_type) : ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transportation_type_id" <?php echo ($values_type['id'] == 1 ? 'checked' : ''); ?> id="type<?php echo $values_type['id'] ?>" value="<?php echo $values_type['id'] ?>">
              <label class="form-check-label" for="type<?php echo $values_type['id'] ?>"><?php echo $values_type['name'] ?></label>
            </div>
          <?php endforeach; ?>
        </div>
        <label>Qty</label>
        <div class="col">
          <input type="number" name="transport_qty" value="<?php echo set_value('transport_qty'); ?>"  class="form-control form-control-sm" />
        </div>
      </div>

      <div class="form-row">

        <legend>Transportation Trip</legend>
        <?php foreach ($trans_trip as $values_trip) : ?>
          <div class="col-12 col-sm-3">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transportation_trip_id" id="trip<?php echo $values_trip['id'] ?>" <?php echo ($values_trip['id'] == 5 ? 'checked' : ''); ?> value="<?php echo $values_trip['id'] ?>">
              <label class="form-check-label" for="trip<?php echo $values_trip['id'] ?>"><?php echo $values_trip['name'] ?></label>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <hr />


      <div class="form-row">
        <div class="col">
          <legend>Ziarat</legend>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat1" value="none" checked="">
            <label class="form-check-label" for="ziarat1">None</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat2" value="Makkah">
            <label class="form-check-label" for="ziarat2">Makkah Ziarat</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat3" value="Madina">
            <label class="form-check-label" for="ziarat3">Madina Ziarat</label>
          </div>
        </div>
        <div class="col">
          <legend>Remarks</legend>
          <textarea name="remarks" class="form-control form-control-sm"><?php echo set_value('remarks');?></textarea>
        </div>
      </div>

      <div class="form-row">

        <div class="col-12">
          <label></label>
          <h5>Makkah Office</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="makkah_contact_person" value="Niamat kiyani" id="makkah_contact_person" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="makkah_contact" value="+966 53 908 1421" id="makkah_contact" class="form-control form-control-sm">
        </div>
      </div>

      <div class="form-row">

        <div class="col-12">
          <label></label>
          <h5>Madina Office</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="madina_contact_person" value="M Irfan" id="madina_contact_person" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="madina_contact" value="00966568553058" id="madina_contact" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-row">

        <div class="col-12">
          <label></label>
          <h5>Transportation</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="transport_contact_person" id="transport_contact_person" value="Sajid Nawaz" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="transport_contact" id="transport_contact" value="00966591195335" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-row">

        <div class="col-12">
          <label></label>
          <h5><?php echo $this->session->userdata('company'); ?></h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="kt_contact_person" id="kt_contact_person" value="<?php echo $this->session->userdata('company'); ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="kt_contact" id="kt_contact" value="091-2582558-03333679040" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </div>
      </div>
      </form>

      <!--Quickview Product Start -->
      <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <input type="text" id="searchInput" onkeyup="searchPaxPopup()" placeholder="Search for names.." title="Type in a name">

                <table class="table table-striped" id="popupPaxTable">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="select-all" id="select-all" /></th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Passport No</th>
                      <th>Age</th>

                    </tr>
                  </thead>
                  <tbody id="show_pax_data">

                  </tbody>
                </table>
                <button id="button-pax-popup" class="btn btn-primary btn-sm">Select</button>
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" aria-label="Close">Cancel</button>
              </div>
            </div>
            <style>
              * {
                box-sizing: border-box;
              }

              #searchInput {
                background-image: url('<?php echo base_url(); ?>asset/images/searchicon.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
                width: 100%;
                font-size: 14px;
                padding: 5px 10px 5px 40px;
                border: 1px solid #ddd;
                margin-bottom: 5px;
              }

              #popupPaxTable {
                border-collapse: collapse;
                width: 100%;
                border: 1px solid #ddd;
                font-size: 12px;
              }

              #popupPaxTable th,
              #popupPaxTable td {
                text-align: left;
                padding: 2px;
              }

              #popupPaxTable tr {
                border-bottom: 1px solid #ddd;
              }

              #popupPaxTable tr.header,
              #popupPaxTable tr:hover {
                background-color: #f1f1f1;
              }
            </style>
            <script>
              $(document).ready(function() {
                $("#searchInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#popupPaxTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                });
              });

              //////////////////////////
              //SEARCH PASSENGER ON POPUP
              //function searchPaxPopup() {
              //              var input, filter, table, tr, td, i, txtValue;
              //              input = document.getElementById("searchInput");
              //              filter = input.value.toUpperCase();
              //              table = document.getElementById("popupPaxTable");
              //              tr = table.getElementsByTagName("tr");
              //              for (i = 0; i < tr.length; i++) {
              //                td = tr[i].getElementsByTagName("td")[2];
              //                if (td) {
              //                  txtValue = td.textContent || td.innerText;
              //                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
              //                    tr[i].style.display = "";
              //                  } else {
              //                    tr[i].style.display = "none";
              //                  }
              //                }       
              //              }
              //            }
            </script>
          </div>
        </div>
      </div>
      <!--End of Quickview Product-->
    </div>
  </div>
</div><!-- /.container -->
<script>
  $(document).ready(function() {

    var base_url = '<?php echo base_url(); ?>';

    $('#new_voucher_no').keyup(function() {
      $('#busy_check').css('display', 'block');
      checkAvailability($('#new_voucher_no').val());

    });

    checkAvailability($('#new_voucher_no').val());

    function checkAvailability(voucher_no) {
      $("#msg").hide();
      $("#error").hide();

      jQuery.ajax({
        url: base_url + "Vouchers/checkVoucherNoAvailability",
        data: 'voucher_no=' + voucher_no,
        type: "POST",
        success: function(data) {
          if (data != 1) {
            $("#msg").show();
            $('#new_voucher_no').css('border', '1px solid #28a745');

          } else {
            $("#error").show();
            $('#new_voucher_no').css('border', '1px solid #dc3545');
            $('#new_voucher_no').prop('required', true);

          }
          $('#busy_check').css('display', 'none');
          //console.log(data);
        },
        error: function() {}
      });
    }

    //VIEW / SHOW ALL PAX ON POPUP  
    $('.pax_popup').click(function() {

      $('#busy').css('display', 'block');

      //var product_id = $(this).attr("id");  
      $.ajax({
        url: base_url + "Vouchers/pax_popup",
        async: true,
        dataType: 'json',
        success: function(data) {

          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<tr >' +
              '<td><input type="checkbox" name="pax_id[]" value="' + data[i].id + '" /></td>' +
              '<td>' + data[i].id + '</td>' +
              '<td>' + data[i].first_name + '</td>' +
              '<td>' + data[i].passport_no + '</td>';

            if (data[i].age <= 2) {
              html += '<td><span class="label label-sm label-warning">Infant</span></td>';
            } else if (data[i].age > 2 && data[i].age <= 12) {
              html += '<td><span class="label label-sm label-primary">Child</span></td>';
            } else if (data[i].age > 12) {
              html += '<td><span class="label label-sm label-success">Adult</span></td>';
            }

            html += '</tr>';
          }
          $('#show_pax_data').html(html);
          $('#productModal').modal("show");
          $('#busy').css('display', 'none');

          //WHEN CLICK ON TABLE ROW CHECKBOX WOULD BE CHECKED
          $('#show_pax_data tr').click(function(event) {
            if (event.target.type !== 'checkbox') {
              $(':checkbox', this).trigger('click');
            }
          });
          ///////////////

          // Listen for click on toggle checkbox
          $('#select-all').click(function(event) {
            if (this.checked) {
              // Iterate each checkbox
              $(':checkbox').each(function() {
                this.checked = true;
              });
            } else {
              $(':checkbox').each(function() {
                this.checked = false;
              });
            }
          });
          ////////////////////
        }
      });
    });


    //GET TO-DEPARTURE DATE AND APPLY HERE   
    $("#pkg_night_1").on("change", function() {
      var date = new Date($("#departure_date_to_ksa").val()),
        days = parseInt($("#pkg_night_1").val(), 10);

      if (!isNaN(date.getTime())) {
        date.setDate(date.getDate() + days); //ADD DAYS TO DEPARTURE DATE

        $("#pkg_checkin_1").val($("#departure_date_to_ksa").val());
        $("#pkg_checkout_1").val(date.toInputFormat());
      } else {
        alert("Please Select Departure Date");
      }

      //COUNT TOTAL NIGHTS 
      $("#total_nights").val(parseInt($("#pkg_night_1").val(), 10));
    });
    ////////
    $("#pkg_night_2").on("change", function() {
      var date = new Date($("#pkg_checkout_1").val()),
        days = parseInt($("#pkg_night_2").val(), 10);

      if (!isNaN(date.getTime())) {
        date.setDate(date.getDate() + days); //ADD DAYS TO DEPARTURE DATE

        $("#pkg_checkin_2").val($("#pkg_checkout_1").val());
        $("#pkg_checkout_2").val(date.toInputFormat());
      } else {
        alert("Please Select first Checkout Date");
      }

      //COUNT TOTAL NIGHTS 
      $("#total_nights").val((parseInt($("#pkg_night_1").val(), 10) + parseInt($("#pkg_night_2").val(), 10)));
    });

    ////////
    $("#pkg_night_3").on("change", function() {
      var date = new Date($("#pkg_checkout_2").val()),
        days = parseInt($("#pkg_night_3").val(), 10);

      if (!isNaN(date.getTime())) {
        date.setDate(date.getDate() + days); //ADD DAYS TO DEPARTURE DATE

        $("#pkg_checkin_3").val($("#pkg_checkout_2").val());
        $("#pkg_checkout_3").val(date.toInputFormat());
      } else {
        alert("Please Select first Checkout Date");
      }

      //COUNT TOTAL NIGHTS 
      $("#total_nights").val((parseInt($("#pkg_night_1").val(), 10) + parseInt($("#pkg_night_2").val(), 10) + parseInt($("#pkg_night_3").val(), 10)));
    });


    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
      var yyyy = this.getFullYear().toString();
      var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
      var dd = this.getDate().toString();
      return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
    };


  });

  //SHOW SELECTED PAX ON INVOICE FORM 
  $(document).delegate('#button-pax-popup', 'click', function() {

    var base_url = '<?php echo base_url(); ?>';

    $.ajax({
      url: base_url + "Vouchers/pax_popup_post",
      type: 'post',
      data: $('#show_pax_data input[type=\'checkbox\']:checked'),
      dataType: 'json',
      beforeSend: function() {
        $('#button-pax-pop').button('loading');
      },
      success: function(data) {
        var html = '';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<input type="hidden" name="pax_id[]" required="" value="' + data[i].id + '" />' +
            '<td>' + data[i].id + '</td>' +
            '<td>' + data[i].first_name + '</td>' +
            '<td>' + data[i].passport_no + '</td>';

          if (data[i].age <= 2) {
            html += '<td><span class="label label-sm label-warning">Infant</span></td>';
          } else if (data[i].age > 2 && data[i].age <= 12) {
            html += '<td><span class="label label-sm label-primary">Child</span></td>';
          } else if (data[i].age > 12) {
            html += '<td><span class="label label-sm label-success">Adult</span></td>';
          }


          html += '<td><button class="btn btn-danger btn-sm btn-delete">Del</button></td>';

          html += '</tr>';

        }
        $('#pax_data').html(html);

        $('#productModal').modal("hide");
        console.log(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        $('#productModal').modal("hide");
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });

    //DELETE FROM THE CURRENT TABLE   
    $("body").on("click", ".btn-delete", function() {
      $(this).parents("tr").remove();
    });

  });
</script>