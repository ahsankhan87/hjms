<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/invoice/screen2.css" type="text/css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/invoice/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/invoice/print_layout.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/invoice/home.css">
    <style type="text/css">

        @media print {
            .hideinPrint {
                display: none;
            }


        }
         td,th{
            text-align:left !important;
        }
        .printrule {
            -webkit-print-color-adjust: exact;
            -moz-print-color-adjust: exact;
            font-size: 110%;
        }

        #tablecompinfo {
            width: 255px;
        }

        #gvAccountAccomo td, #gvAccountVisa td , #gvPaybleaccomo td{
            border: 1px solid;
        }

        #gvAccountAccomo th, #gvAccountVisa th, #gvPaybleaccomo th {
          
            border: 1px solid;
        }

        .disable-select {
          -webkit-user-select: none;  
          -moz-user-select: none;    
          -ms-user-select: none;      
          user-select: none;
        }

        .charges {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            background-color: rgb(243, 243, 243);
        }

        .packagename,HRate,ARate,C2to5Rate,C5to10Rate,IRate,.Payblepackagename,.EX_RATE_TYPE,.discount,.Exrate
        {
             display: inline-block;             
        }
          
    </style>
</head>
<body>
    <form method="post" action="#" id="form1" class="printrule">

         <div id="bfw_content">
             <a class="hideinPrint" style="float: left;"  onclick="javascript:window.print();">Print</a>
             
             <div class="container">
               
                <!-- Page Title -->
                <?php foreach($invoice as $invoice_values): ?>
                <div id="bfw_sub_page_title">
                    <div class="bfw_page_title" style="width: 900px;">
                        <div class="bfw_text" style="display: block;">
                            <div style="float: left; display: block; width: 30%;">
                                <img src="<?php echo base_url(); ?>asset/images/<?php echo $invoice_values['image'] ?>" id="imglogo" class="bfw_pngfix" alt="Logo" style="max-height:90px;">
                            </div>
                            <div style="float: left; width: 45%; text-align: center;">
                                <span id="lblCompanyName" style="display:inline-block;font-size:17pt;font-weight:bold;text-decoration:none;width:400px;"><?php echo $invoice_values['company'] ?></span>
                                
                                <span id="lblCompanyAddress" style="display:inline-block;font-size:9pt;width:400px;"><?php echo $invoice_values['address'] ?></span>
                                <span id="lblCompanyPhone" style="display:inline-block;font-size:8pt;width:400px;"><?php echo $invoice_values['contact'] ?></span>
                            </div>
                            
                            <?php $shirka = $this->M_shirkas->get_shirkas($invoice_values['shirka_id']); ?>
                            <div style="float: left; display: block; width: 25%;">
                                <div style="padding-right: 20px">
                                    <span id="lblSaudiCompany" style="display:inline-block;font-size:12pt;width:300px;">Saudi Company: <b><?php echo @$shirka[0]['name']?></b></span>
                                    <!--<span id="lblshirkaAddress" style="display:inline-block;font-size:12pt;width:250px;"></span>
                                    -->
                                </div>
                                <div style="text-align: center; float: right;">
                                    <img src="<?php echo base_url(); ?>asset/images/<?php echo @$shirka[0]['picture']?>" id="shirkalogo" width="132" style="max-height: 100px">
                                </div>
                                <span id="lblIata" style="font-size: 12pt; float: right;"></span>
                                <br/>
                                <span id="ServiceNo" style="font-size: 12pt; float: right;"></span>
                               
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Contents -->
                <div class="span-24">
                    <div id="bfw_main_content">
                        
                        <h2 class="bfw_content_title">
                            <span style="font-size: 10pt;">Voucher No.</span>
                             <span id="voucherNo"><?php echo $invoice_values['voucher_no'] ?></span>
                
                            <span style="margin-left: 480px;"></span>
                             <span id="ServiceNo"></span>
                            <span id="createDate" class="vdate" style="display:inline-block;font-size:9pt;float:right;">Date Created:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('d M Y',strtotime($invoice_values['voucher_date'])); ?> </span>
                        </h2>
                        <div class="bfw_padding">
                            <div id="print">
                                <fieldset class="bfw_noborder bfw_wide_label">
                                    <legend class="bfw_text" style="width: 100%">
                                        <div style="width: 100%-64px;">
                                            <span>General Information About Service </span>
                                            <span style="margin-left: 100px;"></span>
                                            
                                            <span id="lblGroupHead" style="font-size:11pt;"></span>
                                        </div>
                                        <div style="float: right">
                                           <!-- <div id="qrcode" style="width: 80px; height: 80px; margin-top: -50px;" title="#"><canvas width="80" height="80" style="display: none;"></canvas><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAFaElEQVR4Xu2c25LbMAxDnf//6N3xNvHQMqEDSu402apvjW1dQBAgtU4e27Z9bcV/X19/Hnk8Hqcn3c9f99G0+/h0b7uG15jqudf97XU1Dq5xB5AW+RqknVz9v510Znx6ljZOz6u9IXBP8uwUWgCGbKoCfgKQ0kHRnxiqotmmvJKA+LxKPRqLgKlm0+v+BeAzOv8EQNLElplKG4nZ8TnaaJWh1expmT7FwAXgtt0CYFs6UKlAWpddd5k1ynJittrjAvBODXRrH2IQ1YEU7Tg+Feeks1QBvEUdSMBX0+/jACQAXF0hUxm57tZ3I2Pv+6pmU4vFjwYuAK99vYvJw+7jOiOqQwXSF4c1ioFK+1xGUWeyAGxOisjYXMAuKZwx0K3jLoM9F0261dZUxKb9evXUhbob2iPp/rHmBeDZAtwDlROAFF1VhdPnVaZlrCB9VTrr6Gt0YZXCav7jNGZn4AJQK+AQgKPH3bPO1mPgrK7e7ebHeBkDF4BcYJ8AJB1RWqZc2HUwYlUMJKUSrZFcmSoBpamnQtpt8l3BJZP5FQDGPypVnYvMh3SHOpWs/lM6S3Ud6TMxXMlaeh7oMmMBuG0/KUypW01Fqv/IpHrap+SDemA3G0ieLmtfAHpdsJSIkVaOpiSdoufjddIuR0ejlhITh1o5VY5QqlE6uWVOD9C3BzBz4SowxALqZ3vXXXd1XdQ1PsqSoxdeAJ6hqjLecmHlcKR1tBjSG0e7XHaT9lE3pjBYADa56jYTB+Dxj0puAU2a50ZT9Z89F6aaVRkf7c3tpS/GuADM37J1KwirlSNXrp50UNcQ2eC6K23Y1WN3bacUdundLtIVZkrpXoA+CkDSJDeKrZ6QbtH9VJNFtx7VMiKRvJ69I+2UF9mmXLbQ+K4kxDVQOeOSw3XhA9Ds1Q43GooZ7iKUJMTN0lpIVojdFEySn+5b+tRG0eJGAc4AVAyiYl6lNAWZgEtNRDkZHSrcZSbZPO7cVRe+FUA3DarlzB2NuzsGGRWVJ8NS4WgguWB1cnLKnjlQsKlvJ82jQFxkKx6ojrhfLCFcIN20zDZbbdWUlpEru/re/bMmMY+ElthAxvARAPbeUKVoEwBVYe/dT6wlt3VKpv0e2nMb1O4rvjTYArD5os0oIK72KV0hdmRS4pYh1SyojpsW0tW26L8HkBhQBZTMh8zFMY9q0U8aSmtS2ZlqoDsZpYdbeDup7Z4Ezeo2kaVrIi5wo8WoO36MNjHDXYtb11H2XEiTHemTmbiLph7ZifbbA+h0IlXA3ALbCRQFgRhDQXK1VM1jdSILQB2mFEBXL+46L1QsiZ+7JkLGRdnhGFqcYwFY/BGh1ESqQu0Wzoo1dOrTYx6dD6qalo6paK1SA3svF7nA0n1Vof4oAHtfd60wZQfJLWId9221qBoEdw6XefK+BWD+fXO3/Lnl1Q6KdtX5Mr2ZzYa72s5WrhaAUImTYU595b/qbE6957roaAdip6b48viFyTO/mbAAfJ5IUzQVK5S2uZ8rpyW9259z7jl1DObPEVBJdiHNzM+euECNHGNlZVEPECIBHdW72ZQCSH2mCxTVbsqt2+d67KJOhESfsokqhgsZZn4C1C1f3BLCObp6awBHj60oapRepIXxeZID18UpEMTU1/NTP3+nmKWEmIB0wHHuyQAnjRtd2xSA1ShSVHsaOQrcqH6T6RzjOl/1qgozRZPMJgvMrwSwmsJuIDIJIABnKwnai7o+lcI0KbVubtGa1YRuS0ZrVNlChXpqIpR6alD6vFLnxTXs41ZAjkBT8Mj5KVuO63fWgW6aUXSj8H8EgMQ81z0pXaqscBionJsYpLKC9vpXemFXR34jgN8XuGo9d7BzOQAAAABJRU5ErkJggg==" style="display: block;"></div>
                                           -->
                                        </div>
                                    </legend>
                                </fieldset>
                
                <!-- Voucher Contents-->
                                
<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>
<?php $pax_detail = $this->M_vouchers->get_pax_detail($invoice_values['id'],$invoice_values['user_id']); ?>
<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<tbody><tr>
			<th scope="col">Adults</th>
            <th scope="col">Childs</th>
            <th scope="col">Infants</th>
            <th scope="col">Arrival Date</th>
            <th scope="col">Departure Date</th>
            <th scope="col">Nights</th>
            <th scope="col">Group Name</th>
            <th scope="col">Group Code</th>
		</tr><tr>
			<?php 
            $Infant = 0;
            $Child = 0;
            $Adult = 0;
            foreach($pax_detail as $pax_values1): 
            //Calculate infant child and adult age
            $cur_year = date("Y");
            $age_year = $cur_year-date('Y',strtotime($pax_values1['dob']));
            if($age_year <= 2)
            {
                $Infant++;
            }
            if($age_year > 2 && $age_year <= 12)
            {
                $Child++;
            }
            if($age_year > 12)
            {
                $Adult++;
            }
            endforeach;
            echo '<td>'.$Adult.'</td>';
             echo '<td>'.$Child.'</td>';
              echo '<td>'.$Infant.'</td>';
            ?>
            <td><?php echo date('d M Y',strtotime($invoice_values['departure_date_to_ksa'])); ?></td>
            <td><?php echo date('d M Y',strtotime($invoice_values['departure_date_return'])); ?></td>
            <td>
            <?php $to = strtotime($invoice_values['departure_date_to_ksa']);
            $from = strtotime($invoice_values['departure_date_return']); 
            $diff = $to - $from;
            echo abs(round($diff / 86400)); ?></td>
            <td><?php echo $invoice_values['group_name']; ?></td>
            <td><?php echo $invoice_values['group_code']; ?></td>
		</tr>
	</tbody></table>
</div>

<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>

<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<caption>
			Flight To KSA
		</caption><tbody>
        <tr>
			<th scope="col">Airport</th>
            <th scope="col">Sector</th>
            <th scope="col">Flight No</th>
            <th scope="col">Dep Date</th>
            <th scope="col">Dep Time</th>
            <th scope="col">Arrival Date</th>
            <th scope="col">Arrival Time</th>
            <th scope="col">PNR</th>
		</tr><tr>
			<td>Jeddah Airport</td>
            <td><?php echo $invoice_values['sector1_to_ksa'].'-'.$invoice_values['sector2_to_ksa']; ?></td>
            <td><?php echo $invoice_values['flight1_to_ksa'].'-'.$invoice_values['flight2_to_ksa']; ?></td>
            <td><?php echo date('d M Y',strtotime($invoice_values['departure_date_to_ksa'])); ?></td>
            <td><?php echo date('H:i:s',strtotime($invoice_values['departure_time_to_ksa'])); ?></td></td>
            <td><?php echo date('d M Y',strtotime($invoice_values['arrival_date_to_ksa'])); ?></td> </td>
            <td><?php echo date('H:i:s',strtotime($invoice_values['arrival_time_to_ksa'])); ?></td></td>
            <td><?php echo $invoice_values['pnr_to_ksa'] ?></td></td>
		</tr>
	</tbody></table>
</div>

<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>

<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<caption>
			Return Fight From KSA
		</caption><tbody> <tr>
			<th scope="col">Airport</th>
            <th scope="col">Sector</th>
            <th scope="col">Flight No</th>
            <th scope="col">Dep Date</th>
            <th scope="col">Dep Time</th>
            <th scope="col">Arrival Date</th>
            <th scope="col">Arrival Time</th>
            <th scope="col">PNR</th>
		</tr><tr>
			<td>Jeddah Airport</td>
            <td><?php echo $invoice_values['sector1_return'].'-'.$invoice_values['sector2_return']; ?></td>
            <td><?php echo $invoice_values['flight1_return'].'-'.$invoice_values['flight2_return']; ?></td>
            <td><?php echo date('d M Y',strtotime($invoice_values['departure_date_return'])); ?></td>
            <td><?php echo date('H:i:s',strtotime($invoice_values['departure_time_return'])); ?></td></td>
            <td><?php echo date('d M Y',strtotime($invoice_values['arrival_date_return'])); ?></td> </td>
            <td><?php echo date('H:i:s',strtotime($invoice_values['arrival_time_return'])); ?></td></td>
            <td><?php echo $invoice_values['pnr_return'] ?></td></td>
		</tr>
	</tbody></table>
</div>

<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>

<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<caption>
			Accommodation Detail
		</caption><tbody><tr class="centeraligh">
			<th scope="col">PACKAGE</th><th scope="col">City</th><th scope="col">Hotel</th><th scope="col">Check-In</th><th scope="col">Check-Out</th><th scope="col">NIGHTS</th><th scope="col">Room Type</th>
		</tr>
        <?php $pkg_detail = $this->M_vouchers->get_pkg_detail($invoice_values['id'],$invoice_values['user_id']); 
        foreach($pkg_detail as $pkg_values): 
        echo '<tr>';
			echo '<td>'.$pkg_values['package_id'].'</td>';
            echo '<td>'.$pkg_values['city'].'</td>';
            echo '<td>'.$pkg_values['hotel'].'</td>';
            echo '<td>'.date('d M Y',strtotime($pkg_values['checkin'])).'</td>';
            echo '<td>'.date('d M Y',strtotime($pkg_values['checkout'])).'</td>';
            echo '<td>'.$pkg_values['nights'].'</td>';
            echo '<td>'.$pkg_values['room_type'].'</td>';
		echo '</tr>';
         endforeach; ?>
        
	</tbody></table>
</div>
<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>

<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<caption>
			Transportation Detail
		</caption><tbody>
        <tr>
			<th scope="col">Transport Trip</th>
            <th scope="col">Transport By</th>
            <th scope="col">QTY</th>
            <th scope="col">TRANS_BRN</th>
            <th scope="col">Ziarat</th>
		</tr><tr>
        <?php echo '<td>'.$invoice_values['trip'].'</td>';
            echo '<td>'.$invoice_values['type'].'</td>';
            echo '<td>'.$invoice_values['transport_qty'].'</td>';
            echo '<td></td>';
            echo '<td>'.$invoice_values['ziarat'].'</td>';
            
        ?>
		</tr>
	</tbody></table>
</div>

<div>
    <div id="paxdiv1" style="width:100%;float:left;">
        
<style>
    .gridview caption {
        font-weight: bold;
        font-size: 12pt;
        padding-right: 10px;
        background: none;
        padding-top: 10px;
    }
</style>

<div>
	<table class="gridview bfw_text" cellspacing="0" cellpadding="4" id="gridView1" style="border-collapse:collapse;">
		<caption>
			Mutamer's (Pilgrims) Detail
		</caption><tbody><tr>
			<th scope="col">PILGRIM NAME</th><th scope="col">PASSPORT NO</th><th scope="col">DOB</th><th scope="col">AGE_GROUP</th><th scope="col">ChildWitoutBed</th><th scope="col">VisaNo</th><th scope="col">IssueDate</th>
		</tr>
        <?php  
        foreach($pax_detail as $pax_values): 
        echo '<tr>';
			echo '<td>'.$pax_values['first_name'].' '.$pax_values['last_name'].'</td>';
            echo '<td>'.$pax_values['passport_no'].'</td>';
            echo '<td>'.date('d M Y',strtotime($pax_values['dob'])).'</td>';
            echo '<td>';
            //Calculate infant child and adult age
            $cur_year = date("Y");
            $age_year = $cur_year-date('Y',strtotime($pax_values['dob']));
            if($age_year <= 2)
            {
                echo 'Infant';
            }
            if($age_year > 2 && $age_year <= 12)
            {
                echo 'Child';
            }
            if($age_year > 12)
            {
                echo 'Adult';
            }
            echo '</td>';
            echo '<td></td>';
            echo '<td>'.$pax_values['visa_no'].'</td>';
            //echo '<td>'.date('d M Y',strtotime($pax_values['visa_issue_date'])).'</td>';
            echo '<td></td>';
		 echo '</tr>';
         endforeach; ?>
       
	</tbody></table>
</div>

    </div>
    
</div>
&nbsp;
 <table style="border: 1px solid; margin:-10px 3px 1px 0px ;min-height: 22px;" class="remarks">
     <tbody><tr>
         <td style="color: white; width: 100px;" class="remarks_inner">
             <span style="font-weight: bold; font-size: 11pt">Remarks:</span>
         </td>
         <td style="float: left; font-size: 11pt; padding-left:5px;">
             <span id="lblRemarks" class="bfw_text" style="font-weight:bold;">
             <?php echo $invoice_values['remarks']; ?>
             </span>
         </td>
     </tr>
 </tbody></table>

<div id="DIV_InstructionStaff" style="display: block; font-size: 14px; font: bold;">
    
<style type="text/css">
    .rightHandText Td
    {
        font-weight: bold;
        direction: rtl;
        text-align: right;
        font-size: 13px;
    }
</style>
<div class="rightHandText" style="padding-right:10px;">
    <table class="bfw_text rightHandText" frame="void" width="800">
        <tbody><tr>
            <td>
                <img id="imgInstruction" style="max-width:930px;" src="<?php echo base_url(); ?>asset/css/invoice/images/instruction11.png">
            </td>
        </tr>
    </tbody></table>
</div>

    
<style type="text/css">
    .style2
    {
        width: 100px;
        padding:0px;
        margin:0px;
    }

    .bfw_text th, td, caption {
        padding: 0px;
        margin: 0px;
    }
</style>

<table class="bfw_text" style="font-size:9pt;">
   
    <tbody>
    <tr>
        <td class="style2">
            <b><span id="lblMakkahOffice">Makkah Office :</span></b>
        </td>
        <td>
           <span id="lblMakkahstaff1"><b><?php echo $invoice_values['makkah_contact_person']."     Phone No.".$invoice_values['makkah_contact']; ?></b></span>
        </td>
      <!--
        <td>
            <span id="lblMakkahstaff2"><b>Name:ALHAMDOLELAH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ph:1234567890</b></span>
        </td>
        -->
    
        <td class="style2">
           <b><span id="lblMadinaOffice">Madina Office &nbsp;:</span></b>
        </td>
        <td>
            <span id="lblMadinastaff1"><b><?php echo $invoice_values['madina_contact_person']."     Phone No.".$invoice_values['madina_contact']; ?></b></span>
        </td>
        <!--
        <td>
            <span id="lblMadinastaff2"><b>Name:BILAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ph:1234567890</b></span>
        </td>
        -->
    </tr>
    <tr>
        <td colspan="3"><span id="hotelcontact" style="font-weight:bold;"></span></td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight:bold;">
        <span id="txtEmergencyContact"><?php echo $invoice_values['kt_contact_person']."     Phone No:".$invoice_values['kt_contact']; ?></span>
        </td>
        
        <td class="style2">
           <b><span id="lblMadinaOffice">Transport Contact&nbsp;:</span></b>
        </td>
        
        <td>
            <span id="lblMadinastaff1"><b><?php echo $invoice_values['transport_contact_person']."     Phone No.".$invoice_values['transport_contact']; ?></b></span>
        </td>
    </tr>
     
</tbody></table>



</div>

                            </div><!-- /. end print -->
                        </div>
                        <!-- #bfw_main_content ends -->
                        <div id="bfw_main_content_footer">
                            <!-- for rounded bottom background -->
                        </div>
                    </div>
                    <!-- .span-18 ends -->
                </div>
                <!-- .container ends -->
                <?php endforeach; ?>
            </div>
            <!-- #bfw_content ends -->

         </div>

       
    </form>

</body></html>