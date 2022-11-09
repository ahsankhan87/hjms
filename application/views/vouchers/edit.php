<div class="card">
  <div class="card-header">
    <?php echo $main; ?>

  </div>
  <div class="card-body">
    <?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data");
    echo form_open('Vouchers/edit', $attributes);
    //var_dump($invoice);

    foreach ($invoice as $invoice_values) :
      echo form_hidden('voucher_id', $invoice_values['id']);
      echo form_hidden('user_id', $invoice_values['user_id']);

      echo form_hidden('date_created', $invoice_values['date_created']);

    ?>
      <div class="form-row">
        <div class="col-sm-1">
          <label>Voucher Date</label>

        </div>
        <div class="col-sm-3">
          <input type="date" class="form-control" name="voucher_date" required="" value="<?php echo $invoice_values['voucher_date'] ?>" />
        </div>
        <div class="col-sm-1">
          <label>Voucher No</label>

        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="voucher_no" required="" value="<?php echo $invoice_values['voucher_no'] ?>" />
        </div>

        <div class="col-sm-1">
          <label>Shirka</label>

        </div>
        <div class="col-sm-3">
          <?php echo form_dropdown('shirka_id', $shirkasDDL, $invoice_values['shirka_id'], 'class="form-control"'); ?>
        </div>

        <div class="col-sm-1">
          <label>Group Name</label>

        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="group_name" value="<?php echo $invoice_values['group_name']; ?>" />
        </div>

        <div class="col-sm-1">
          <label>Group Code</label>

        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="group_code" value="<?php echo $invoice_values['group_code']; ?>" />
        </div>

      </div>

      <h5>Flight Information</h5>
      <div class="form-row">
        <h6>Flight to KSA</h6>
        <div class="col">
          <label>Sector</label>
          <select name="sector1_to_ksa" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'AUH' ? 'selected="selected"' : '') ?> value="AUH">AUH</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'BAH' ? 'selected="selected"' : '') ?> value="BAH">BAH</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'CAI' ? 'selected="selected"' : '') ?> value="CAI">CAI</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'CDG' ? 'selected="selected"' : '') ?> value="CDG">CDG</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'CMB' ? 'selected="selected"' : '') ?> value="CMB">CMB</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'DMM' ? 'selected="selected"' : '') ?> value="DMM">DMM</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'DOH' ? 'selected="selected"' : '') ?> value="DOH">DOH</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'DXB' ? 'selected="selected"' : '') ?> value="DXB">DXB</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'ISB' ? 'selected="selected"' : '') ?> value="ISB">ISB</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'IST' ? 'selected="selected"' : '') ?> value="IST">IST</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'JED' ? 'selected="selected"' : '') ?> value="JED">JED</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'JFK' ? 'selected="selected"' : '') ?> value="JFK">JFK</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'JNB' ? 'selected="selected"' : '') ?> value="JNB">JNB</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'KHI' ? 'selected="selected"' : '') ?> value="KHI">KHI</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'KWI' ? 'selected="selected"' : '') ?> value="KWI">KWI</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'LHE' ? 'selected="selected"' : '') ?> value="LHE">LHE</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'LHR' ? 'selected="selected"' : '') ?> value="LHR">LHR</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'LYP' ? 'selected="selected"' : '') ?> value="LYP">LYP</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'MAA' ? 'selected="selected"' : '') ?> value="MAA">MAA</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'MCT' ? 'selected="selected"' : '') ?> value="MCT">MCT</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'MED' ? 'selected="selected"' : '') ?> value="MED">MED</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'MUX' ? 'selected="selected"' : '') ?> value="MUX">MUX</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'PEW' ? 'selected="selected"' : '') ?> value="PEW">PEW</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'RKT' ? 'selected="selected"' : '') ?> value="RKT">RKT</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'RUH' ? 'selected="selected"' : '') ?> value="RUH">RUH</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'SHJ' ? 'selected="selected"' : '') ?> value="SHJ">SHJ</option>
            <option <?php echo ($invoice_values['sector1_to_ksa'] == 'SKT' ? 'selected="selected"' : '') ?> value="SKT">SKT</option>

          </select>
        </div>-
        <div class="col">
          <label></label>
          <select name="sector2_to_ksa" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['sector2_to_ksa'] == 'Jeddah Airport' ? 'selected="selected"' : '') ?> value="Jeddah Airport">JED</option>
            <option <?php echo ($invoice_values['sector2_to_ksa'] == 'Madina Airport' ? 'selected="selected"' : '') ?> value="Madina Airport">MAD</option>

          </select>
        </div>
        <div class="col">
          <label>Flight</label>
          <select name="flight1_to_ksa" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['flight1_to_ksa'] == '6S' ? 'selected="selected"' : '') ?> value="6S">6S</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'BA' ? 'selected="selected"' : '') ?> value="BA">BA</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'EG' ? 'selected="selected"' : '') ?> value="EG">EG</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'EK' ? 'selected="selected"' : '') ?> value="EK">EK</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'EY' ? 'selected="selected"' : '') ?> value="EY">EY</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'ER' ? 'selected="selected"' : '') ?> value="ER">ER</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'FR' ? 'selected="selected"' : '') ?> value="FR">FR</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'FZ' ? 'selected="selected"' : '') ?> value="FZ">FZ</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'G9' ? 'selected="selected"' : '') ?> value="G9">G9</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'GF' ? 'selected="selected"' : '') ?> value="GF">GF</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'J9' ? 'selected="selected"' : '') ?> value="J9">J9</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'KU' ? 'selected="selected"' : '') ?> value="KU">KU</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'NL' ? 'selected="selected"' : '') ?> value="NL">NL</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'OV' ? 'selected="selected"' : '') ?> value="OV">OV</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'PA' ? 'selected="selected"' : '') ?> value="PA">PA</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'PK' ? 'selected="selected"' : '') ?> value="PK">PK</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'QR' ? 'selected="selected"' : '') ?> value="QR">QR</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'RT' ? 'selected="selected"' : '') ?> value="RT">RT</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'SV' ? 'selected="selected"' : '') ?> value="SV">SV</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'TK' ? 'selected="selected"' : '') ?> value="TK">TK</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'UL' ? 'selected="selected"' : '') ?> value="UL">UL</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'WY' ? 'selected="selected"' : '') ?> value="WY">WY</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'XY' ? 'selected="selected"' : '') ?> value="XY">XY</option>

          </select>
        </div>-
        <div class="col">
          <label></label>
          <input type="text" name="flight2_to_ksa" value="<?php echo $invoice_values['flight2_to_ksa']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label>Departure Date &amp; Time</label>
          <input type="date" name="departure_date_to_ksa" value="<?php echo $invoice_values['departure_date_to_ksa']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label></label>
          <input type="time" name="departure_time_to_ksa" value="<?php echo $invoice_values['departure_time_to_ksa']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label>Arrival Date &amp; Time</label>
          <input type="date" name="arrival_date_to_ksa" value="<?php echo $invoice_values['arrival_date_to_ksa']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label></label>
          <input type="time" name="arrival_time_to_ksa" value="<?php echo $invoice_values['arrival_time_to_ksa']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <label></label>
          <input type="text" name="pnr_to_ksa" value="<?php echo $invoice_values['pnr_to_ksa']; ?>" class="form-control form-control-sm" placeholder="PNR">
        </div>
      </div>

      <div class="form-row">
        <h6>Return Flight</h6>
        <div class="col">
          <select name="sector1_return" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['sector1_return'] == 'Jeddah Airport' ? 'selected="selected"' : '') ?> value="Jeddah Airport">JED</option>
            <option <?php echo ($invoice_values['sector1_return'] == 'Madina Airport' ? 'selected="selected"' : '') ?> value="Madina Airport">MED</option>

          </select>
        </div>-
        <div class="col">
          <select name="sector2_return" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['sector2_return'] == 'AUH' ? 'selected="selected"' : '') ?> value="AUH">AUH</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'BAH' ? 'selected="selected"' : '') ?> value="BAH">BAH</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'CAI' ? 'selected="selected"' : '') ?> value="CAI">CAI</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'CDG' ? 'selected="selected"' : '') ?> value="CDG">CDG</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'CMB' ? 'selected="selected"' : '') ?> value="CMB">CMB</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'DMM' ? 'selected="selected"' : '') ?> value="DMM">DMM</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'DOH' ? 'selected="selected"' : '') ?> value="DOH">DOH</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'DXB' ? 'selected="selected"' : '') ?> value="DXB">DXB</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'ISB' ? 'selected="selected"' : '') ?> value="ISB">ISB</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'IST' ? 'selected="selected"' : '') ?> value="IST">IST</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'JED' ? 'selected="selected"' : '') ?> value="JED">JED</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'JFK' ? 'selected="selected"' : '') ?> value="JFK">JFK</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'JNB' ? 'selected="selected"' : '') ?> value="JNB">JNB</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'KHI' ? 'selected="selected"' : '') ?> value="KHI">KHI</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'KWI' ? 'selected="selected"' : '') ?> value="KWI">KWI</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'LHE' ? 'selected="selected"' : '') ?> value="LHE">LHE</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'LHR' ? 'selected="selected"' : '') ?> value="LHR">LHR</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'LYP' ? 'selected="selected"' : '') ?> value="LYP">LYP</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'MAA' ? 'selected="selected"' : '') ?> value="MAA">MAA</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'MCT' ? 'selected="selected"' : '') ?> value="MCT">MCT</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'MED' ? 'selected="selected"' : '') ?> value="MED">MED</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'MUX' ? 'selected="selected"' : '') ?> value="MUX">MUX</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'PEW' ? 'selected="selected"' : '') ?> value="PEW">PEW</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'RKT' ? 'selected="selected"' : '') ?> value="RKT">RKT</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'RUH' ? 'selected="selected"' : '') ?> value="RUH">RUH</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'SHJ' ? 'selected="selected"' : '') ?> value="SHJ">SHJ</option>
            <option <?php echo ($invoice_values['sector2_return'] == 'SKT' ? 'selected="selected"' : '') ?> value="SKT">SKT</option>

          </select>
        </div>

        <div class="col">
          <select name="flight1_return" class="form-control form-control-sm">
            <option <?php echo ($invoice_values['flight1_return'] == '6S' ? 'selected="selected"' : '') ?> value="6S">6S</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'BA' ? 'selected="selected"' : '') ?> value="BA">BA</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'EG' ? 'selected="selected"' : '') ?> value="EG">EG</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'EK' ? 'selected="selected"' : '') ?> value="EK">EK</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'EY' ? 'selected="selected"' : '') ?> value="EY">EY</option>
            <option <?php echo ($invoice_values['flight1_to_ksa'] == 'ER' ? 'selected="selected"' : '') ?> value="ER">ER</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'FR' ? 'selected="selected"' : '') ?> value="FR">FR</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'FZ' ? 'selected="selected"' : '') ?> value="FZ">FZ</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'G9' ? 'selected="selected"' : '') ?> value="G9">G9</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'GF' ? 'selected="selected"' : '') ?> value="GF">GF</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'J9' ? 'selected="selected"' : '') ?> value="J9">J9</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'KU' ? 'selected="selected"' : '') ?> value="KU">KU</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'NL' ? 'selected="selected"' : '') ?> value="NL">NL</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'OV' ? 'selected="selected"' : '') ?> value="OV">OV</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'PA' ? 'selected="selected"' : '') ?> value="PA">PA</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'PK' ? 'selected="selected"' : '') ?> value="PK">PK</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'QR' ? 'selected="selected"' : '') ?> value="QR">QR</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'RT' ? 'selected="selected"' : '') ?> value="RT">RT</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'SV' ? 'selected="selected"' : '') ?> value="SV">SV</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'TK' ? 'selected="selected"' : '') ?> value="TK">TK</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'UL' ? 'selected="selected"' : '') ?> value="UL">UL</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'WY' ? 'selected="selected"' : '') ?> value="WY">WY</option>
            <option <?php echo ($invoice_values['flight1_return'] == 'XY' ? 'selected="selected"' : '') ?> value="XY">XY</option>

          </select>
        </div>-
        <div class="col">
          <input name="flight2_return" type="text" value="<?php echo $invoice_values['flight2_return']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="date" name="departure_date_return" value="<?php echo $invoice_values['departure_date_return']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="time" name="departure_time_return" value="<?php echo $invoice_values['departure_time_return']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="date" name="arrival_date_return" value="<?php echo $invoice_values['arrival_date_return']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="time" name="arrival_time_return" value="<?php echo $invoice_values['arrival_time_return']; ?>" class="form-control form-control-sm" placeholder="">
        </div>
        <div class="col">
          <input type="text" name="pnr_return" value="<?php echo $invoice_values['pnr_return']; ?>" class="form-control form-control-sm" placeholder="PNR">
        </div>
      </div>

      <hr />

      <div class="form-row">
        <div class="col">
          <a href="#" class="pax_popup" class="btn btn-primary btn-sm">Select Passengers</a>
          <img src="<?php echo base_url('asset/images/busy.gif') ?>" id="busy" style="display: none;" />
        </div>

      </div>
      <div class="form-row">
        <div class="col">
          <div class="">
            <table class="table table-striped" id="mydata">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Passport No.</th>
                  <th>Age</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="pax_data">

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <hr />

      <div class="form-row">
        <div class="col-10">
          <legend>Transportation Type</legend>&nbsp;
          <?php foreach ($trans_type as $values_type) : ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transportation_type_id" <?php echo ($values_type['id'] == $invoice_values['transportation_type_id'] ? 'checked' : ''); ?> id="type<?php echo $values_type['id'] ?>" value="<?php echo $values_type['id'] ?>">
              <label class="form-check-label" for="type<?php echo $values_type['id'] ?>"><?php echo $values_type['name'] ?></label>
            </div>
          <?php endforeach; ?>
        </div>
        <label>Qty</label>
        <div class="col">
          <input type="number" name="transport_qty" value="<?php echo $invoice_values['transport_qty'] ?>" class="form-control form-control-sm" />
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <legend>Transportation Trip</legend>
          <?php foreach ($trans_trip as $values_trip) : ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transportation_trip_id" id="trip<?php echo $values_trip['id'] ?>" <?php echo ($values_trip['id'] == $invoice_values['transportation_trip_id'] ? 'checked' : ''); ?> value="<?php echo $values_trip['id'] ?>">
              <label class="form-check-label" for="trip<?php echo $values_trip['id'] ?>"><?php echo $values_trip['name'] ?></label>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <hr />

      <h5>Package Detail</h5>
      <?php foreach ($pckg_voucher as $pckg_voucher_values) : ?>
        <div class="form-row">
          <div class="col">
            <label>City</label>
            <?php echo form_dropdown('city[]', $city, $pckg_voucher_values['city_id'], 'class="form-control form-control-sm"'); ?>
          </div>
          <div class="col">
            <label>Nights</label>
            <input type="number" name="pck_nights[]" value="<?php echo $pckg_voucher_values['nights'] ?>" class="form-control form-control-sm" placeholder="Nights">
          </div>
          <div class="col">
            <label>Checkin</label>
            <input type="date" name="pkg_checkin[]" value="<?php echo $pckg_voucher_values['checkin'] ?>" class="form-control form-control-sm" placeholder="">
          </div>
          <div class="col">
            <label>Checkout</label>
            <input type="date" name="pkg_checkout[]" value="<?php echo $pckg_voucher_values['checkout'] ?>" class="form-control form-control-sm" placeholder="">
          </div>
          <div class="col">
            <label>Hotel</label>
            <?php echo form_dropdown('hotel_id[]', $hotels, $pckg_voucher_values['hotel_id'], 'class="form-control form-control-sm"'); ?>
          </div>
          <div class="col">
            <label>Room Type</label>
            <?php $data = array(
              'Sharing' => 'Sharing', 'Single Bed' => 'Single Bed', 'Double Bed' => 'Double Bed',
              'Triple Bed' => 'Triple Bed', 'Quad Bed' => 'Quad Bed', 'Five Bed' => 'Five Bed'
            );
            echo form_dropdown('room_type[]', $data, $pckg_voucher_values['room_type'], 'class="form-control form-control-sm"'); ?>
          </div>

        </div>
      <?php endforeach; ?>

      <hr />

      <div class="form-row">
        <div class="col">
          <legend>Ziarat</legend>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat1" value="none" <?php echo ($invoice_values['ziarat'] == 'none' ? 'checked=""' : '') ?>>
            <label class="form-check-label" for="ziarat1">None</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat2" value="Makkah" <?php echo ($invoice_values['ziarat'] == 'Makkah' ? 'checked=""' : '') ?>>
            <label class="form-check-label" for="ziarat2">Makkah Ziarat</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="ziarat" id="ziarat3" value="Madina" <?php echo ($invoice_values['ziarat'] == 'Madina' ? 'checked=""' : '') ?>>
            <label class="form-check-label" for="ziarat3">Madina Ziarat</label>
          </div>
        </div>
        <div class="col">
          <legend>Remarks</legend>
          <textarea name="remarks" class="form-control form-control-sm"><?php echo $invoice_values['remarks'] ?></textarea>
        </div>
      </div>

      <div class="form-row">

        <div class="col">
          <label></label>
          <h5>Makkah Office</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="makkah_contact_person" value="<?php echo $invoice_values['makkah_contact_person'] ?>" id="makkah_contact_person" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="makkah_contact" id="makkah_contact" value="<?php echo $invoice_values['makkah_contact'] ?>" class="form-control form-control-sm">
        </div>
      </div>

      <div class="form-row">

        <div class="col">
          <label></label>
          <h5>Madina Office</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="madina_contact_person" value="<?php echo $invoice_values['madina_contact_person'] ?>" id="madina_contact_person" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="madina_contact" id="madina_contact" value="<?php echo $invoice_values['madina_contact'] ?>" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-row">

        <div class="col">
          <label></label>
          <h5>Transportation</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="transport_contact_person" id="transport_contact_person" value="<?php echo $invoice_values['transport_contact_person'] ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="transport_contact" id="transport_contact" value="<?php echo $invoice_values['transport_contact'] ?>" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-row">

        <div class="col">
          <label></label>
          <h5>Karwan-e-Taif</h5>

        </div>
        <div class="col">
          <label>Contact Person Name</label>
          <input type="text" name="kt_contact_person" id="kt_contact_person" value="<?php echo $invoice_values['kt_contact_person'] ?>" class="form-control form-control-sm">
        </div>
        <div class="col">
          <label>Contact No.</label>
          <input type="text" name="kt_contact" id="kt_contact" value="<?php echo $invoice_values['kt_contact'] ?>" class="form-control form-control-sm">
        </div>

      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
      </div>
    <?php endforeach; ?>
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
              <table class="table table-striped" id="popupPaxTable">
                <thead>
                  <tr>
                    <th><input type="checkbox" name="select-all" id="select-all" /></th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Passport No.</th>
                    <th>Age</th>

                  </tr>
                </thead>
                <tbody id="show_pax_data">

                </tbody>
              </table>
              <button id="button-pax-popup" class="btn btn-primary btn-sm">Select</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End of Quickview Product-->
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

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

    var base_url = '<?php echo base_url(); ?>';
    var voucher_id = '<?php echo $invoice_values['id']; ?>';
    var user_id = '<?php echo $invoice_values['user_id']; ?>';

    //SHOW THE PAX WHEN THE PAGE LOAD BY DEFAULT
    $.ajax({
      url: base_url + "Vouchers/voucher_pax_popup/" + voucher_id + '/' + user_id,
      type: 'get',
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<tr data-name="' + data[i].id + '">' +
            '<input type="hidden" name="pax_id[]" value="' + data[i].id + '" />' +
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
          html += '<td><button class="btn btn-danger btn-xs btn-delete">Delete</button></td>';

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
      $('#busy').css('display', 'block');

      //REMOVE INVOICED FILED FROM PASSENGER TABLE
      var pnr_id = $(this).parents("tr").attr('data-name');
      $.post(base_url + "Vouchers/rmvInvoicedPnr", {
        id: pnr_id
      }, function(result) {
        $("span").html(result);
        console.log(result);
      });
      //////

      $(this).parents("tr").remove();
      $('#busy').css('display', 'none');

    });


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
            html += '<tr>' +
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
          html += '<tr data-name="' + data[i].id + '">' +
            '<input type="hidden" name="pax_id[]" value="' + data[i].id + '" />' +
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

          html += '<td><button class="btn btn-danger btn-xs btn-delete">Delete</button></td>';

          html += '</tr>';
        }
        $('#pax_data').append(html);

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