<?php


// function enq_no()
// {
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
 $check = $db->query("SELECT * FROM cer_leaving WHERE student_admission_id = '$reg_no'");
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
?>
<?php

									
									 
									if(isset($_POST['update']) && $_POST['update']=='Update And Print'){
									$st_id=$student_detail['student_admission_id'];
									
									    $qry13 = $db->query("UPDATE cer_leaving SET remark='".($_POST['remark'] ?? '')."',last_instittue_attended  = '".($_POST['last_school_attended'] ?? '')."' WHERE student_admission_id = '$reg_no'");
									   // echo "UPDATE cer_leaving SET remark='".$_POST['remark']."' WHERE student_admission_id = '$reg_no'";
								$date_of_birth = date("Y-m-d", strtotime(($_POST['dob'] ?? '')));
$qry8 = $db->query("UPDATE student_admission_information SET semister ='".($_POST['semister'] ?? '')."', student_full_name_for_leaving = '".($_POST['student_name'] ?? '')."', enrollment_no='".($_POST['enrollment_no'] ?? '')."' WHERE student_admission_id = '$st_id' ");
$qry9 = $db->query("UPDATE student_admission_information SET date_of_birth  = '".$date_of_birth."' WHERE student_admission_id = '$st_id' ");
$qry10 = $db->query("UPDATE cer_leaving SET  discharge_no='".($_POST['discharge_no'] ?? '')."' WHERE student_admission_id = '$reg_no' ");
$qry11 = $db->query("UPDATE cer_leaving SET date_of_birth  = '$date_of_birth', date_of_birth_words='".($_POST['dob_words'] ?? '')."'  WHERE student_admission_id = '$reg_no' ");
 
$qry = $db->query("UPDATE student_parent_information SET m_first_name = '".($_POST['mother_name'] ?? '')."' WHERE student_admission_id = $st_id ");
$qry1 = $db->query("UPDATE student_personal_information SET caste = '".($_POST['caste_name'] ?? '')."' WHERE student_admission_id = $st_id ");
$qry2 = $db->query("UPDATE student_personal_information SET place_of_birth  = '".($_POST['place_name'] ?? '')."' WHERE student_admission_id = $st_id ");
$qry3 = $db->query("UPDATE student_personal_information SET nationality  = '".($_POST['nationality'] ?? '')."' WHERE student_admission_id = $st_id ");
// $qry4 = $db->query("UPDATE student_admission_information SET last_school_attended  = '".$_POST['last_school_attended']."' WHERE student_admission_id = ".$_POST['reg_id']." ");
$qry5 = $db->query("UPDATE student_admission_information SET date_of_admission_leavinig  = '".($_POST['date_of_addmission'] ?? '')."' WHERE student_admission_id = $st_id ");
$qry12 = $db->query("UPDATE student_admission_information SET std_admno  = '".($_POST['std_admno'] ?? '')."' WHERE student_admission_id = $st_id ");
$qry13 = $db->query("UPDATE cer_leaving SET reason_of_leaving  = '".($_POST['reason'] ?? '')."' WHERE student_admission_id = '$reg_no' ");
$qry14 = $db->query("UPDATE cer_leaving SET progress  = '".($_POST['progress'] ?? '')."',conduct='".($_POST['conduct'] ?? '')."',date_of_leaving='".($_POST['date_of_leaving'] ?? '')."'  WHERE student_admission_id = '$reg_no' ");
// $qry13 = $db->query("UPDATE cer_leaving SET remark='".$_POST['remark']."' WHERE student_admission_id = $reg_no ");
header("Location: cer_leaving_print_final?reg_no=".($_POST['reg_no'] ?? '')."&session=".$session."");
									}
									?>
									<?php
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" lang="mr">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="content-language" content="en-GB" /><title></title>
<style>
body{
	font-size:15px;
}
.top-heading{
	font-family:Old English Text MT;
	font-size:36px;
	color:#0f92a3;
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
font-family:Bodoni MT Black;
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
 
	font-size:14px;
	/*border-bottom:1px solid #000;*/
	 
}
</style>
</head>

<body >
<form name="fee_assign" action="<?php echo base_url('cert_leaving');?>?reg_no=<?= $reg_no; ?>&session=<?= $session ?>" method="post" />
<table cellspacing="0" cellpadding="0" width="100%" class="">

<tr>
		<td style="background:url(assets/img/bottom-middle.jpg)" align="center" height="450px" valign="top">				

<table width="100%" border="0" cellspacing="0" cellpadding="2">
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
		<td colspan="2"><table width="700" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; border:2px solid #000000; padding:10px;">
		  <tr>
		    <td colspan="2"><table width="700" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; border:2px solid #000000; padding:10px;">
		      <tr>
		        <td colspan="6"><table width="100%" align="center">
		          <tr>
		            <td colspan="2" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		              
                        
		              </table></td>
		            </tr>
                     <tr>
                <td  align="center"><img src="<?= base_url('assets/img/somya_tech_logo.png'); ?>" width="800"/></td>
              </tr>
		          
		          <tr>
		            <td width="712" align="center" class="address3">LEAVING CERTIFICATE</td>
		            <td width="66" rowspan="2" align="center" valign="top"><table border="1" style="border-collapse:collapse;">
		              </table></td>
		            </tr>
		          <tr>
		            <td align="center" class="address4">(ORIGINAL / DUPLICATE)</td>
		            </tr>
		          <tr>
		            <td colspan="2" align="center" class="address5">(No change in any entry in this Certificate shall be made except by the authority issuing it and any infringement of this requirement of is liable to involve the imposition of penality such as that of rustication.)</td>
		            </tr>
		          </table>
		          <!--    <tr>
<th width="24%" align="left" class="font12" colspan="4"><p><em>Enrolment No.______________</em></p></th>
<th width="44%" align="right" colspan="3" class="font11"><p><em>Discharge  No._______________</em></p></th>
</tr>

<tr>
<th align="left" class="font10" colspan="4"><p><em>Admission  No. :______________</em></p></th>
</tr>
            --></td>
		         </tr>
		      <tr>
		        <td colspan="6"  class="header">&nbsp;</td>
		        </tr>
		      <tr>
		       <td colspan="2">Enrolment No. </td>
		        <td width="3%">:</td>
		        <td ><input type="hidden" name="sy" size="40" value="<?PHP echo ($_GET['session'] ?? ''); ?>"><input type="text" name="enrollment_no"  value="<?php echo $student_detail['enrollment_no']; ?>"></td>
		        <td>Discharge No. </td>
		        <td> : &nbsp; <input type="text" class="letter" name="discharge_no" id="discharge_no"  value="<?= 	 $stu_lc['discharge_no']; ?>"></td>
		        </tr>
                 <form action="" method="post">
		      <tr>
		        <td colspan="2">Admission No </td>
		        <td>:</td>
		        <td colspan="2"><input type="hidden"  name="reg_no" id="reg_no"  value="<?php echo $student_detail['reg_no']; ?>" />
		        <input type="hidden"  name="reg_id" id="reg_id"  value="<?php echo $student_detail['student_admission_id']; ?>" />
		        <input type="text"  name="std_admno" id="std_admno"  value="<?php echo $student_detail['std_admno']; ?>" />
		        </td>
		        <td>&nbsp;</td>
		        </tr>
               
		      <tr>
		        <td width="4%">1) </td>
		        <td width="27%">Name Of Student in full</td>
		        <td>:</td>
		        <?php if($student_detail['student_full_name_for_leaving']!=NULL){
		            $name=$student_detail['student_full_name_for_leaving'];
		        }else{
		           $name= $student_detail['first_name'].'&nbsp; &nbsp;'.$student_detail['middle_name'].'&nbsp; &nbsp;'.$student_detail['last_name'];
		        }
		        ?>
		        <td colspan="3"><div class="letter"><input type="text" class="letter" name="student_name" id="student_name" size="75" value="<?PHP echo $name ?>" /></td>
		        </tr>
		      <tr>
		        <td>2)</td>
		        <td>Name of Mother</td>
		        <td>&nbsp;</td>
		        <td colspan="3" class="letter"><input type="text" class="letter" name="mother_name" id="mother_name" size="75" value="<?PHP echo $stud_lc['m_first_name']; ?>" /></td>
		        </tr>
		      <tr>
		        <td>3)</td>
		        <td>Race &amp; Caste  (with Sub-Caste)</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter"  name="caste_name" size="75" value="<?PHP echo $stud_p_lc['caste']; ?>"  /></td>
		        </tr>
		      <tr>
		        <td>4)</td>
		        <td>Nationality</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter"  name="nationality" size="75" value="<?PHP echo $stud_p_lc['nationality']; ?>" /></td>
		        </tr>
		      <tr>
		        <td>5)</td>
		        <td>Place of Birth</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter" size="75"  name="place_name" value="<?PHP echo $stud_p_lc['place_of_birth']; ?>" /></td>
		        </tr>
		      <tr>
		        <td>6) </td>
		        <td>Date of birth, month and year according to the Christain era both in words and figures<span style="color:red;">(Date Format: Year-Month-date)</span></td>
		        <td>&nbsp;</td>
		        
					 <td colspan="3" class="letter">
		            <?PHP 
		            if(strtotime($student_detail['date_of_birth'])!='0000-00-00')
		            {
		               ?>
		                <input type="text" class="letter" size="75"  name="dob" value="<?PHP echo $student_detail['date_of_birth'] ?>" placeholder="0000-00-00 "/>
		                <?php
		              
		            }
		            else
		            { ?>
		             <input type="text" class="letter" size="75"  name="dob" value="<?PHP echo $student_detail['date_of_birth'] ?>" placeholder="0000-00-00 "/>  
		           <?php }
		            ?>
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
		        <td colspan="3" width="50">
		        <?php
								$s_id = $student_detail['last_school_attended'];
									 $query8 = $db->query("SELECT * FROM last_school_attended WHERE s_id='$s_id'")->getRow(); 
									// $query   = $builder->get(); 
									
									?>
<!--									<select name="last_school_attended" id="last_school_attended" style="width:100%;">-->
<!--       	?php foreach ($query8->getResult() as $row8) {-->
    

<!--?>-->
<!--            <option value="<?php echo $row8->s_id;?>" <?php if($student_detail['last_school_attended'] == $row8->s_id){ echo "selected"; } ?>><?php echo $row8->school_name;?></option>-->
<!--            ?php } ?>-->

            <?php
            $last_school_attended = $stu_lc['last_instittue_attended'];
            if($last_school_attended == ''){
                $school_name = $query8->school_name;
            }else{
               $school_name = $last_school_attended;
            }
            ?>
            <input type="text" class="letter" size="75"  name="last_school_attended" value="<?PHP echo $school_name; ?>" />
            
            </td>
		        </tr>
		      <tr>
		        <td>8) </td>
		        <td> Date of Admission</td>
		        <td>:</td><?php $date_admission = date("d/m/Y", strtotime($student_detail['date_of_admission_leavinig'])); ?>
		        <td colspan="3" class="letter"><input type="text" class="letter" id="date_of_addmission"  name="date_of_addmission" size="75" value="<?PHP echo $date_admission; ?>" /></td>
		        </tr>
		      <tr>
		        <td>9)</td>
		        <td>Progress</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter"  name="progress" size="40" value="<?PHP echo $stu_lc['progress']; ?>" ></td>
		        </tr>
		      <tr>
		        <td>10)</td>
		        <td>Conduct</td>
		        <td>&nbsp;</td>
		        <td colspan="3" class="letter"><input type="text" class="letter"  name="conduct" size="40" value="<?PHP echo $stu_lc['conduct']; ?>" ></td>
		        </tr>
		      <tr>
		        <td>11) </td>
		        <td>Date of leaving Institute</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter"  name="date_of_leaving" size="40" value="<?PHP 
		        echo $stu_lc['date_of_leaving']; ?>"></div>
                <?php echo '</br>'; ?></td>
		        </tr>
		      <tr>
		        <td>12) </td>
		        <td>Standard in which studying and Since when</td>
		        <td>&nbsp;</td>
		        <td colspan="2"><input type="text" class="letter"  name="class_name" size="30" value="<?PHP echo $class3->class; ?>" readonly/></td>
		        <td>
		          
            <input type="text" class="letter"  name="semister" size="30" value="<?PHP echo $student_detail['semister']; ?>"/>
            </td>
		        </tr>
		      <tr>
		        <td>13) </td>
		        <td>Reason of leaving Institute</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" name="reason" class="letter" size="75" value="<?PHP echo $stu_lc['reason_of_leaving']; ?>" /></td>
		        </tr>
		      <tr>
		        <td>14)</td>
		        <td>Remarks</td>
		        <td>:</td>
		        <td colspan="3" class="letter"><input type="text" class="letter" size="75" name="remark"  value="<?PHP echo $stu_lc['remark']; ?>" /></td>
		        </tr>
		      <tr>
		        <td class="header2" colspan="6"></td>
		        </tr>
		      <tr>
		        <td colspan="6"  class="header4">&nbsp;</td>
		        </tr>
		      <tr>
		        <td colspan="6" align="center" class="address6">Certified that the above information is in accordance with the College Register.</td>
		        </tr>
		      <tr>
		        <td colspan="3" class="address7">&nbsp;</td>
		        <td width="30%" class="address7">&nbsp;</td>
		        <td width="16%" class="address7">&nbsp;</td>
		        <td class="address7">&nbsp;</td>
		        </tr>
		      <tr>
		        <td colspan="3" class="address7">&nbsp;</td>
		        <td class="address7">&nbsp;</td>
		        <td class="address7">&nbsp;</td>
		        <td class="address7">&nbsp;</td>
		        </tr>
		      <tr>
		        <td colspan="3" class="address7">Date :</td>
		      <td class="address7">Clerk &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked by</td>
		        <td class="address7" align="center"> </td>
		        <td class="address7">Principal</td>
		        </tr>
		      </table></td>
		    </tr>
		</table></td>
		</tr>
		
			
		<?php
		
		}
		?>
       </table></form>						</td>
</tr>

<tr>
	<td height="19">&nbsp;</td>
</tr>
</table>
<center><input type="submit" name="update" id="update" class="print" value="Update And Print" /> </center>

			</form>
		</td>
	</tr>
	</table>


</body>
</html>