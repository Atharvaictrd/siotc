<body onload="window.print();">
<div class="row" id="leaving">
    
<div class="col-xl-12">
    <div class="panel panel-inverse" >
        <?php
          $db      = \Config\Database::connect();
        // echo "SELECT * FROM student_admission_information  Where reg_no='".$_POST['stu_reg']."'";
            	 $query3 = $db->query("SELECT * FROM student_admission_information  Where reg_no='".($_GET['reg_no'] ?? '')."'"); 
            	foreach ($query3->getResult() as $row3) {}
            	?>
            	<form method="post">
    <div class="panel-body" id="mydiv">
        <center>
      <table width="680" border="0" cellspacing="0" cellpadding="10" style="border:3px solid #000; font-size:12px;" class="normal-text " >
          <tbody><tr>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="address8">
              <tbody style="border-bottom:double;">
             
              <tr >
                <td style="border-bottom:1px solid black;padding-bottom:5px;">  <img src="<?= base_url('assets/img/somya_tech_logo.png')?>"  width="100%"></td>
               
              </tr>
         
             
            </tbody></table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="address9">
            <tbody><tr>
  <td width="84%" align="left"><span class="address">Ref. No.   &nbsp;&nbsp;<?= $row3->reg_no ;?><span style="float:right;" class="address9">Date:-  <?= date('d-m-Y');?></span></span></td></tr>
            </tbody></table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="address9">
                <tbody><tr>
                  <td height="38" colspan="2" class="address3"><div align="center">
                    <h3><b><i>Bonafide Certificate</i></b></h3>
                    </div></td>
                </tr>
                	 <?php
        $class = $db->query("SELECT * FROM class WHERE class_id='$row3->program' "); 
                                    // $query   = $builder->get(); 
                                    foreach ($class->getResult() as $class3) { }
?>
                <tr>
                  <td align="justify"  ><p style="text-align: justify;padding:5px;line-height:1.5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>&nbsp;&nbsp;&nbsp;This is to  certify that Mast./Ku.</em>&nbsp;<strong style="text-transform:capitalize;"><span class="letter"><?= $row3->first_name.' '.$row3->middle_name.' '.$row3->last_name;?></span></strong><em>&nbsp; is  a student of this College and studying in&nbsp;</em><strong><span class="letter"><?= $class3->class;?></strong><em> for the session</em> <span class="letter"><strong><?= $_row3->session_year;?></strong></span><em> His/Her date of</em><em> birth from the college record is</em><strong> <span class="letter" ><?= date('d-m-Y', strtotime($row3->date_of_birth));?></span></strong> <em>This is issued on request of parents  / Students's.</em></p> <p><strong></strong></p></td>
                </tr>
                <tr>
                  <td height="28" align="left"><p></p></td>
                </tr>
                <tr>
                  <td height="28" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr>
                      <td><span class="address4" style="padding:25px 55px;"><strong>Clerk</strong></span></td>
                      <td align="right"><span class="address5" style="padding:25px 55px;"><strong>Principal</strong></span></td>
                      </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    </tbody></table></td>
                </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></center>
    </div>
    
</form>
</div>
</div>
</div>
<!-- <div class="form-group row">-->
<!--<label class="col-lg-4 col-form-label form-label">&nbsp;</label>-->
<!--<div class="col-lg-6">-->
<!--<input type="submit" class="btn btn-warning col-xl-4" name="bon_save" id="bon_save" value="Save"> -->
<!--<input type="button" value="Print" class=" btn btn-primary col-xl-4 " onclick="Printtc()" /> -->
<!--</div>-->
<!--</div>-->
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut(5000);
})
 function Printtc() {    
       var divToPrint = document.getElementById('leaving');
       var popupWin = window.open('', '', 'width=870,height=450');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
</script>
</body>