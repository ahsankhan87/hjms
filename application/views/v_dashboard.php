<!-- Image Header 
<img class="img-fluid rounded mb-4" src="<?php echo base_url('asset/images/dashboard1.png'); ?>" alt="">
-->
    <!-- Marketing Icons Section -->
    <div class="row">
      
      <div class="col-lg-8 mb-4">
        <div class="card">
          <h4 class="card-header">Information About Vouchers</h4>
          <div class="card-body">
          
              <div id="total_vouchers">
                  <span>Total Vouchers (<strong><?php echo $this->M_vouchers->getTotalVouchers($this->session->userdata('user_id')); ?></strong>) </span>
              </div>
                        
          </div>
        </div>
        <div class="card">
          <h4 class="card-header">Information About Pilgrims</h4>
          <div class="card-body">
          
              <div id="">
                  <?php 
                  $pnr_dob = $this->M_vouchers->get_pnrs($this->session->userdata('user_id'));
                  ?>
                  <span>Total ( <strong><?php echo count($pnr_dob); ?></strong> ) </span>
                  
                  <?php

                  $infant=0;
                  $child=0;
                  $adult=0;
                      
                  foreach ($pnr_dob as $key => $value) {
                    
                      //Calculate infant child and adult age
                      $cur_year = date("Y");
                      $age_year = ($cur_year-date('Y',strtotime($value['dob'])));
                      if($age_year <= 2)
                      {
                        $infant++;
                      }
                      if($age_year > 2 && $age_year <= 12)
                      {
                        $child++;
                      }
                      if($age_year > 12)
                      {
                        $adult++;
                      }
                  }
                    
                  ?>
                  <span>Adults ( <strong><?php echo $adult ?></strong> ) </span>
                  <span>Childs ( <strong><?php echo $child ?></strong> ) </span>
                  <span>Infants ( <strong><?php echo $infant ?></strong> ) </span>
                  <span><?php //var_dump($this->M_reports->total_pnr_by_city('2020-05-05',1,1)); ?></span>
              </div>
                        
          </div>
        </div>

      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header">KSA Status</h4>
          <div class="card-body">
          <input type="date" id="report_date" name="report_date" class="form-control" value="<?php echo date("Y-m-d"); ?>" />
            <img src="<?php echo base_url('asset/images/busy.gif') ?>" id="busy" style="display: none;" />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                    </tr>
                </thead>
                <tbody id="data">
                    <tr>
                        <td>Jeddah</td>
                        <td><div id="jed-arrival-pnrs"></div></td>
                        <td><div id="jed-dep-pnrs"></div></td>
                    </tr>
                    <tr>
                        <td>Madina</td>
                        <td><div id="mad-arrival-pnrs"></div></td>
                        <td><div id="mad-dep-pnrs"></div></td>
                    </tr>
                </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
    <!-- /.row -->
<script>
$(document).ready(function(){
   
  //CALL DASHBOARD REPORT FUNCTION ON LOAD 
  fetch_dashboard_reports();

  function fetch_dashboard_reports() {
   
   var base_url = '<?php echo base_url(); ?>';
   var report_date = $('#report_date').val();
   
   //GET ARRIVAL AND DEPARTURE REPORT OF PNRs
   $.ajax({
        url: base_url+"Dashboard/total_arrival_report/"+report_date+'/',
        type: 'post',
        //data:$('#report_date').val(),
        //data:$('input[type=\'date\']'),
        dataType: 'json',
        success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data['total_pnrs_arrival'].length; i++){
                    html += '<tr>'+
                            '<td>Jeddah</td>'+
                            '<td><a href="'+base_url+'Reports/searchArrivalReport/'+report_date+'/'+report_date+'/'+'Jed/1/0">'+
                            data['total_pnrs_arrival'][i].total_arrival_city_1+'</a></td>'+
                            '<td><a href="'+base_url+'Reports/searchDepartureReport/'+report_date+'/'+report_date+'/'+'Jed/0/1">'+
                            data['total_pnrs_arrival'][i].total_departure_city_1+'</a></td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Madina</td>'+
                            '<td><a href="'+base_url+'Reports/searchArrivalReport/'+report_date+'/'+report_date+'/'+'Mad/1/0">'+
                            data['total_pnrs_arrival'][i].total_arrival_city_2+'</td>'+
                            '<td><a href="'+base_url+'Reports/searchDepartureReport/'+report_date+'/'+report_date+'/'+'Mad/0/1">'+
                            data['total_pnrs_arrival'][i].total_departure_city_2+'</td>'+
                            '</tr>';
                }
                $('#data').html(html);
                
                //CHECKIN AND CHECKOUT PNRS
                for(i=0; i<data['checkin_checkout_pnrs'].length; i++){
                    html += '<tr>'+
                            '<td>Jeddah</td>'+
                            '<td>Checkin(<a href="'+base_url+'Reports/searchArrivalReport/'+report_date+'/'+report_date+'/'+'Jed/1/0">'+
                            data['checkin_checkout_pnrs'][i].checkin_city_makkah+')</a></td>'+
                            '<td>Checkout(<a href="">'+data['checkin_checkout_pnrs'][i].checkout_city_makkah+'</a>)</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>Madina </td>'+
                            '<td>Checkin(<a href="">'+data['checkin_checkout_pnrs'][i].checkin_city_madina+'</a>)</td>'+
                            '<td>Checkout(<a href="">'+data['checkin_checkout_pnrs'][i].checkin_city_madina+'</a>)</td>'+
                            '</tr>';
                }
                $('#data').html(html);
                ////////////////////////////
                console.log(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    /////////////////////////
  }

////////
//SHOW DASHBOARD reports
$(document).on('change','#report_date',function(e){ 
         
  fetch_dashboard_reports();

});  
////////////////.SHOW DASHBOARD REPORTS
     
});    

</script>