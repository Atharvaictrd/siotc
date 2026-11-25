<?php
if(!empty($_GET['reg_no'])){
    	$db      = \Config\Database::connect();
					$reg_no=($_GET['reg_no'] ?? '');	
					$session=($_GET['session'] ?? '');
	$enq_sql = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		$data['source'] = $enq_sql->getResultArray();
// echo "SELECT 	reg_no FROM student_admission_information ORDER BY reg_no ASC";
// 	$enq=tep_db_fetch_array($enq_sql);
	foreach($data['source'] as $student_detail){
   
	
	}
 $student_detail['reg_no'];
$id=$student_detail['student_admission_id'];
//  "SELECT * FROM cer_leaving WHERE student_admission_id = '$id'";
 $check = $db->query("SELECT * FROM cer_leaving WHERE student_admission_id='$reg_no'");
 $datas['sources'] = $check->getResultArray();

     foreach ($datas['sources'] as $stu_lc) {
         
     }
     
     $check1 = $db->query("SELECT f_first_name,m_first_name from student_parent_information WHERE student_admission_id = '".$student_detail['student_admission_id']."'");
 $datap['sourcep'] = $check1->getResultArray();

     foreach ($datap['sourcep'] as $stud_lc) {
         
     }
     $check2 = $db->query("SELECT place_of_birth,religion,nationality,caste from student_personal_information WHERE student_admission_id = '".$student_detail['student_admission_id']."'");
 $dataps['sourceps'] = $check2->getResultArray();

     foreach ($dataps['sourceps'] as $stud_p_lc) {
         
     }
// 
								// echo	"SELECT * FROM last_school_attended WHERE s_id='".$student_detail['last_school_attended']."' ";
									 $query8 = $db->query("SELECT * FROM last_school_attended WHERE s_id='".$student_detail['last_school_attended']."' "); 
									// $query   = $builder->get();
									
								
    foreach ($query8->getResult() as $row8) {
    
}
$class = $db->query("SELECT * FROM class WHERE class_id='".$student_detail['program']."' "); 
									// $query   = $builder->get(); 
									foreach ($class->getResult() as $class3) { }
}
function displaywords($number){
    $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
    $digits = array('', '', 'hundred', 'thousand', 'lakh', 'crore');

    $number = explode(".", $number);
    $result = array("","");
    $j =0;
    foreach($number as $val){
        // loop each part of number, right and left of dot
        for($i=0;$i<strlen($val);$i++){
            // look at each part of the number separately  [1] [5] [4] [2]  and  [5] [8]

            $numberpart = str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT); // make 1 => 1000, 5 => 500, 4 => 40 etc.
            if($numberpart <= 20){ // if it's below 20 the number should be one word
                $numberpart = 1*substr($val, $i,2); // use two digits as the word
                $i++; // increment i since we used two digits
                $result[$j] .= $words[$numberpart] ." ";
            }else{
                //echo $numberpart . "<br>\n"; //debug
                if($numberpart > 90){  // more than 90 and it needs a $digit.
                    $result[$j] .= $words[$val[$i]] . " " . $digits[strlen($numberpart)-1] . " "; 
                }else if($numberpart != 0){ // don't print zero
                    $result[$j] .= $words[str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT)] ." ";
                }
            }
        }
        $j++;
    }
    if(trim($result[0]) != "") echo ucwords($result[0]);
    if($result[1] != "") echo $result[1] ;
    // echo " Only";
}

$ins=2001;

// echo displaywords($ins);
?>
<div id="leaving">
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" lang="mr">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="content-language" content="en-GB" /></title>
<style>
body{
	font-size:15px;
}
.top-heading{
	font-family:Old English Text MT;
	font-size:36px;
	color:#B61A03;
	padding:5px;
	margin:0px;
}

.address{
	font-family:Arial Black;
	font-size:24px;
	padding:5px auto;
	margin:0px;
}
.address2{
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:16px;
}
.header{
	border-bottom:3px solid red;
}
.address3{
/*font-family:Bodoni MT Black;*/
font-weight:600;
font-size:36px;
color:black;
}
.address4{
font-family:Cambria (Headings);
font-size:16px;
color:#B61A03;
font-weight:bold;	
}
.address5{
font-family:Cambria (Headings);
font-size:12px;
padding:5px auto;
margin:0px; 	
}
.header2{
border-bottom:3px solid red;
padding:5px auto;
margin:0px; 	
}
.address6{
font-family:Calibri;
font-size:18px;
font-weight:bold;	
}
.address7{
font-family:Calibri (Body);
font-size:18px;
font-weight:bold;	
color:#B61A03;
}
.header4{
border-bottom:3px solid red;
padding:5px auto;
margin:0px; 	
}
.header3{
font-family:Calibri (Body);
font-size:18px;
font-weight:bold;
}
.font12{
font-family:Calibri (Body);
font-size:15px;
font-weight:bold;
}
.font11{
font-family:Calibri (Body);
font-size:15px;
font-weight:bold;
}
.font10{
font-family:Calibri (Body);
font-size:15px;
font-weight:bold;
}
.address9{
font-size:16px;
font-family:Cambria (Headings);
}
.address10{
font-size:16px;
font-family:Cambria (Headings);
}
.dcno{
	font-size:16px;
	color:red;
}
.letter{
	 
	font-size:13px;
	border-bottom:1px solid #000;
 text-transform: uppercase;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut(5000);
})
</script>
<style>
.loader {
	position: absolute;
	left: 0px;
	top: 60px;
	
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/loading.gif) 70% 50% no-repeat rgb(249,249,249);
}
</style>

</head>
<div class="loader"></div>
<!--<div id="leaving">-->
<body >

    
<form name="fee_assign" action="" method="post" />
<table cellspacing="0" cellpadding="0" width="100%" class="">

<tr>
	<td style="background:url(assets/img/bottom-middle.jpg)" align="center" height="450px" valign="top">					

<table width="100%" border="0" cellspacing="0" cellpadding="2" >
 <tr>
 	<td><?php
		  if(!empty($error)){ 
		?>

		<div class="error">
        <?php 
				echo "<b>Alert</b><br>";
				foreach($error as $key => $val)
				{
					echo "<li>".$val."</li>";
				}
			?>
      </div>
		<?php
			}else         
         if(($_GET['action'] ?? '') == 'success'){ ?>
          		<div class="success"><strong>Success</strong><li>Insert Record Successfully.</li></div>
			<?php }
         
         if(($_GET['action'] ?? '') == 'udp'){ ?>
          		<div class="success"><strong>Success</strong><li>Update Record Successfully.</li></div>
			<?php }
			 ?></td>
 </tr>
  <tr>
    <td>&nbsp;</td>
      </tr>
      
     <tr>
        <td>		</td>
		</tr>
		<?php 
		if (!empty($student_detail['reg_no'])){
		
		?>
		<tr>
		<td colspan="2"><table width="800" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; height:1040px;margin-top: -35px;">
		  <tr>
		    <td colspan="2"><table width="800" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; height:1040px;  margin-top: 0px;">
		      <tr>
		        <td colspan="6" style="height:1px; border-bottom: 3px solid red;"><table width="100%" align="center">
		          <tr>
		            <td colspan="2" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		              <!--<tr>-->
		              <!--  <td width="65%" align="center"><span style="color:#000000;font-size:14px;">Maharashtra Shikshan Prasarak Mandal's</span><br><span class="top-heading">Somayya Diploma in Pharmacy (D Pharm)</span></td>-->
		              <!--  </tr>-->
                        
		              </table></td>
		            </tr>
                     <tr>
                <td  align="center"><img src="<?= base_url('assets/img/somya_tech_logo.png')?>" width="800"/></td>
                
              </tr>
		          <!--<tr>-->
		          <!--  <td colspan="2" align="center"><div class="address2"> CHANDRAPUR (M. S.)-->
		          <!--    <div style="float:right;" class="address9">MSBTE-32585</div>-->
		          <!--    </div></td>-->
		          <!--  </tr>-->
		          <!--<tr>-->
		          <!--  <td colspan="2" align="center"><div class="address2">Wadgaon Ward, Chandrapur-->
		          <!--    <div style="float:right;" class="address10">DTE-4691</div>-->
		          <!--    </div></td>-->
		          <!--  </tr>-->
		            <!--<tr>-->
		            <!--<td colspan="2" align="center"><div class="address2">-->
		            <!--  <div style="float:right;" class="address10">PCI -7315</div>-->
		            <!--  </div></td>-->
		            <!--</tr>-->
		          <tr>
		            <td width="712" align="center" class="address3" style="">LEAVING CERTIFICATE</td>
		            <td width="66" rowspan="2" align="center" valign="top"><table border="1" style="border-collapse:collapse;">
		              </table></td>
		            </tr>
		          <tr>
		            <td align="center" class="address4">(ORIGINAL / DUPLICATE)</td>
		            </tr>
		          <tr >
		            <td colspan="2" align="center" class="address5 ">(No change in any entry in this Certificate shall be made except by the authority issuing it and any infringement of this requirement of is liable to involve the imposition of penality such as that of rustication.)</td>
		            </tr>
		        <!--      <tr >-->
		        <!--<td colspan="6" class="header" >&nbsp;</td>-->
		        <!--</tr>-->
		          </table>
		         </td>
		         
		        
		     
		      <tr>
		        <td colspan="2">Enrolment No. </td>
		        <td width="3%">:</td>
		        <td ><?PHP echo $student_detail['enrollment_no']; ?></td>
		        <td>Discharge No. </td>
		        <td class="dcno"><?PHP echo $stu_lc['discharge_no']; ?></td>
		        </tr>
		       <tr>
		        <td colspan="2">Admission No </td>
		        <td>:</td>
		        <td colspan="2"><?PHP echo $student_detail['std_admno']; ?></td>
		        <td>&nbsp;</td>
		        </tr> 
		      <tr>
		        <td width="4%">1) </td>
		        <td width="35%">Name Of Student in full</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP if($student_detail['student_full_name_for_leaving'] == ''){ echo '<strong>'.$student_detail['first_name'].'&nbsp; &nbsp;'.$stud_lc['middle_name'].'&nbsp; &nbsp;'.$student_detail['last_name'].'</strong>';   }else { echo '<strong>'.$student_detail['student_full_name_for_leaving'].'</strong>'; } ?></div></td>
		        </tr>
		      <tr>
		        <td>2)</td>
		        <td>Name of Mother</td>
		      <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stud_lc['m_first_name']; ?></div></td>
		        </tr>
		      <tr>
		        <td>3)</td>
		        <td>Race &amp; Caste  (with Sub-Caste)</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stud_p_lc['caste'] ; ?></div></td>
		        </tr>
		      <tr>
		        <td>4)</td>
		        <td>Nationality</td>
		        <td>:</td>
		        <td colspan="3" ><div class="letter"><?PHP echo $stud_p_lc['nationality']; ?></div></td>
		        </tr>
		      <tr>
		        <td>5)</td>
		        <td>Place of Birth</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stud_p_lc['place_of_birth']; ?></div></td>
		        </tr>
		      <tr>
		        <td>6) </td>
		        <td>Date of birth, month and year according to the Christain era both in words and figures</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?php echo date('d/m/Y',strtotime($student_detail['date_of_birth'])); ?> </div>
						<?php  
if (!empty($student_detail['date_of_birth'])) {

    $new_birth_date = explode('-', $student_detail['date_of_birth']);
    $year  = (int)$new_birth_date[2];
    $month = (int)$new_birth_date[1];
    $day   = (int)$new_birth_date[0];

    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');

    // ✅ Number to words logic directly
    $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
    ?>
    <br>(<?= ucfirst($f->format($year)); ?>
    <?= $monthName; ?> 
    
    <?= ucfirst($f->format($day)); ?> 
    )
<?php } ?>
					 </td>
		        </tr>
		      <tr>
		        <td>7)</td>
		        <td>Last Institute attended</td>
		        <td>:</td>
		        
		        <?php
            $last_school_attended = $stu_lc['last_instittue_attended'];
            if($last_school_attended == ''){
                $school_name = $row8->school_name;
            }else{
               $school_name = $last_school_attended;
            }
            ?>
		        <td colspan="3"><div class="letter"><?PHP echo $school_name; ?></div></td>
		        </tr>
		      <tr>
		        <td>8) </td>
		        <td> Date of Admission</td>
		        <td>:</td>
		        <td colspan="3" ><div class="letter"><?PHP  echo $student_detail['date_of_admission_leavinig']; ?></div></td>
		        </tr>
		      <tr>
		        <td>9)</td>
		        <td>Progress</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stu_lc['progress']; ?></div></td>
		        </tr>
		      <tr>
		        <td>10)</td>
		        <td>Conduct</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stu_lc['conduct']; ?></div></td>
		        </tr>
		      <tr>
		        <td>11) </td>
		        <td>Date of leaving Institute</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP 
		        echo date('d/m/Y',strtotime($stu_lc['date_of_leaving'])); ?></div>
                     <?php echo '</br>'; $day = substr($stu_lc['date_of_leaving'], 8);
					  $month = substr($stu_lc['date_of_leaving'], 6);
					    $yea = date('Y',$stu_lc['date_of_leaving']);
					 $y = intval($yea / 100);
		       // echo $stu_lc['date_of_leaving']; ?></div></td>
		        </tr>
		      <tr>
		        <td>12) </td>
		        <td>Standard in which studying and Since when</td>
		       <td>:</td>
		        <?php  
		        if($student_detail['semister']=='DIR II Year'){
		            $sem='DIR II Year';
		        }else{
		            $sem='First Year';
		        }
		        
		        ?>
		        <td colspan="3"><div class="letter"><?PHP echo $class3->class.' '.$student_detail['semister']; ?></div></td>
		        </tr>
		      <tr>
		        <td>13) </td>
		        <td>Reason of leaving Institute</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter"><?PHP echo $stu_lc['reason_of_leaving']; ?></div></td>
		        </tr>
		      <tr>
		        <td>14)</td>
		        <td>Remarks</td>
		        <td>:</td>
		        <td colspan="3"><div class="letter" style="line-height:1.5;"><?PHP echo $stu_lc['remark']; ?></div></td>
		        </tr>
		      <tr>
		        <td class="header2" colspan="6"></td>
		        </tr>
		  <!--  <tr>
		        <td colspan="6"  class="header4">&nbsp;</td>
		        </tr>
		      <tr>-->
		        <td colspan="6" align="center" class="address6">Certified that the above information is in accordance with the College Register.</td>
		        </tr>
		      <tr>
		        <td colspan="3" class="address7">&nbsp;</td>
		        <td width="30%" class="address7">&nbsp;</td>
		        <td width="16%" class="address7">&nbsp;</td>
		        <td class="address7">&nbsp;</td>
		        </tr>
		      
		      <tr>
		          <td colspan="6">
		          <table>
		        <td class="address7" style="width:199px">Date :</td>
		      <td class="address7" style="width:199px">Clerk </td>
		        <td class="address7" style="width:199px">Checked by </td>
		        <td class="address7" style="width:199px;text-align:center;">Principal</td>
		        <table>
		          </td>  
		            
		        </tr>
		      </table></td>
		    </tr>
		</table></td>
		</tr>
		
			
		<?php
		}
		?>
      </table>					</td>
</tr>

<tr>
	<!--<td height="19">&nbsp;</td>-->
</tr>
</table>
		</td>
	</tr>
	</table>

</td>
</tr>
</form>	
</table>
</body>
<!--</div>-->

</html>
</div>
<center><input type="button" name="print" value="Print Again" onClick="Printtc()" class="print"  /></center>
 <script type="text/javascript">  
        // function Printtc() {  
        //     var tcContents = document.getElementById("leaving").innerHTML;  
        //     var printWindow = window.open();  
        //     printWindow.document.write('<html><head><title></title>');  
        //     printWindow.document.write('<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"><body >');  
        //     printWindow.document.write(tcContents);  
        //     printWindow.document.write('</body></html>');  
        //     printWindow.document.close();  
        //     printWindow.print();  
        // }  
        
    function Printtc() {    
       var divToPrint = document.getElementById('leaving');
       var popupWin = window.open('', '', 'width=870,height=450');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 

    </script> 

<script type="text/javascript">  
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer

 if ($num < 0)
  return "negative".$this->convertTri(-$num, 0);

 if ($num == 0)
  return "zero";

 return 'Rs. '.$this->convertTri($num, 0).' only.';
}

    //  function Printtc() {  
    //      alert('1');
    //   var divToPrint = document.getElementById('leaving');
    //   var popupWin = window.open('', '', 'width=870,height=450');
    //   popupWin.document.open();
    //   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    //     popupWin.document.close();
    //         }
            
    // function Printtc() {    
    //   var divToPrint = document.getElementById('leaving');
    //   var popupWin = window.open('', '', 'width=870,height=450');
    //   popupWin.document.open();
    //   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    //     popupWin.document.close();
    //         }
 

    </script> 