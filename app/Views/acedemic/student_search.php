<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />


<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


<div id="content" class="app-content">
<style>
  .tab {
    display: none;
  }
  .tab.active {
    display: block;
  }
  #program_chosen{
      width: 100% !important;
  }
   #semister_chosen{
      width: 100% !important;
  }
  #area_chosen{
      width: 100% !important;
  }
  #category_chosen{
      width: 100% !important;
  }
  #dropdownYear_chosen{
      width: 100% !important;
  }
</style>

<div class="row">

<div class="col-xl-12">
<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error') ?>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Student Search</h3>
</div>


<div class="panel-body">
<div class="tabs">
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab1')">Student Id</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab2')">Name </a>
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab3')"> Program</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab4')">Semester </a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab5')"> Phone</a>
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab6')"> Address</a>
    <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab7')">Category </a>
     <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab8')"> Enrollment No</a>
    <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab9')">Session </a>
</div>
<br><br>
<form id="wizardForm" method="post" action="<?= base_url('student_search')?>">
      <div id="tab1" class="tab active">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-2"> <b>Registration No.</b></div>
                  <div class="col-xl-6"> 
                  <input type="text" class="form-control" name="reg_no">
                  </div>
          </div>
      </div>
      
      <div id="tab2" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-1"><b>Name</b></div>
                  <div class="col-xl-3"> <input type="text" class="form-control" name="first_name" id="" placeholder="First Name.."></div>
                   <div class="col-xl-3"> <input type="text" class="form-control" name="middle_name" id="" placeholder="Middle Name.."></div>
                    <div class="col-xl-3"> <input type="text" class="form-control" name="last_name" id="" placeholder="Last Name.."></div>
             
          </div>
      </div>
      
      <div id="tab3" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-1"><b>Program</b></div>
                  <div class="col-xl-3"> 
                   <select name="program" id="program" class="form-control chosen-select" >
        <option value="">--program--</option>
     <?php
            $db      = \Config\Database::connect();
				 $query4 = $db->query("SELECT * FROM class"); 
				
			 foreach ($query4->getResult() as $row4) {
            ?>
        
    <option value="<?=$row4->class;?>" ><?=$row4->class;?></option>
    <?php
			 }
    ?>
    </select>
                  </div>
                   <div class="col-xl-1 offset-xl-1"><b>Semester</b></div>
                    <div class="col-xl-3"> 
                    <select name="psemister" id="semister" class="form-control chosen-select" >
            <option value="">--semester--</option>
            <?php
				 $query1 = $db->query("SELECT * FROM program_sem"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->program_sem?>"><?=$row1->program_sem?></option>
    <?php
			 }
    ?>
   
    </select>
                    </div>
             
          </div>
      </div>
      
      <div id="tab4" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-3"><b>Semester</b></div>
                  <div class="col-xl-3"> 
                   <select name="semister" id="semister" class="form-control chosen-select" >
            <option value="">--semester--</option>
            <?php
				 $query1 = $db->query("SELECT * FROM program_sem"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->program_sem?>"><?=$row1->program_sem?></option>
    <?php
			 }
    ?>
   
    </select>
                  </div>
      </div>
      </div>
       <div id="tab5" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-3"><b>Phone</b></div>
                  <div class="col-xl-3"> <input type="text" name="phone_no" class="form-control" maxlength="10"></div>
      </div>
      </div>
      
        <div id="tab6" class="tab ">
          <div class="form-group row">
              <div class="col-xl-3"><b>Landmark</b></div>
              <div class="col-xl-3"><b>Area</b></div>
                  <div class="col-xl-3"><b>City</b></div>
      </div>
       <div class="form-group row">
           <div class="col-xl-3"><input type="text" class="form-control" name="landmark" id=""></div>
              <div class="col-xl-3"><select class="form-control chosen-select" name="area" id="area">
                      <option>--Select Landmark--</option>
                      <?php
				 $query1 = $db->query("SELECT * FROM adress_keywords"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->adress_key?>"><?=$row1->adress_key?></option>
    <?php
			 }
    ?>
                  </select></div>
                  <div class="col-xl-3"><input type="text" class="form-control" name=""id=""></div>
      </div>
      <div class="form-group row">
                   <div class="col-xl-3"><b>Pin Code</b></div>
                   <div class="col-xl-3"><b>State</b></div>
      </div>
      <div class="form-group row">
                   <div class="col-xl-3"><input type="text" class="form-control" name="pincode" id=""></div>
                   <div class="col-xl-3"><input type="text" class="form-control" name="state" id=""></div>
      </div>
      </div>
      
      <div id="tab7" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-3"><b>Category</b></div>
                  <div class="col-xl-3"> <select class="form-control chosen-select" name="category" id="category">
                      <option>select</option>
                      <?php
				 $query1 = $db->query("SELECT * FROM student_category"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->category?>"><?=$row1->category?></option>
    <?php
			 }
    ?>
                  </select></div>
      </div>
      </div>
      
       <div id="tab8" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-2"> <b>Enrollment No.</b></div>
                  <div class="col-xl-6"> <input type="text" class="form-control" name="enrollment_no" id=""></div>
             
          </div>
      </div>
      <div id="tab9" class="tab ">
          <div class="form-group row">
              <div class="col-xl-1 offset-xl-3"><b>Session</b></div>
                  <div class="col-xl-3"> <select class="form-control chosen-select" name="session" id="dropdownYear">
    <option value="">Select session</option>
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
</select></div>
      </div>
      </div>
      
      
    

</div>

    <div class="form-group row">
              <div class="col-xl-4 offset-xl-2"><b>From Date</b></div>
                  <div class="col-xl-4"><b>To Date</b></div>
      </div>
      <div class="form-group row">
              <div class="col-xl-4 offset-xl-2"><input type="date" class="form-control" name="f_date" id="f_date"></div>
                  <div class="col-xl-4"><input type="date" class="form-control" name="t_date" id="t_date"></div>
      </div><br>
      <div class="form-group row mb-4">
              <div class="col-xl-4 offset-xl-2"><button ype="submit" class="btn btn-warning">Show</button></div>
               <!--<div class="col-xl-4 "><button ype="reset" class="btn btn-warning"> Show All</button></div>-->
               
      </div>
</form>



</div>

</div>



</div>


<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading" id="heading_title">
    Student Admission list
<!--<input type="radio" name="asc_des">  &nbsp;Ascending  &nbsp;&nbsp;&nbsp;<input type="radio" name="asc_des">  &nbsp;Descending-->

</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>


<th class="text-nowrap">Sr No.</th>
<th class="text-nowrap">Student Id</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Sem</th>
<th class="text-nowrap">Class</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Tel no</th>
<th class="text-nowrap">Admission Date</th>
<th class="text-nowrap">Year</th>
<th class="text-nowrap">Action</th>
</tr>
</thead>
<tbody>
<?php
$s=count($source);
$i=1;

                                    foreach ($source  as $row) :
                                        ?>
<tr style="cursor: pointer;" onmouseover="this.style.backgroundColor='#ffffdd'; this.style.color='#0000ff'"
onmouseout="this.style.backgroundColor=''; this.style.color=''" onselectr="this.style.backgroundColor='red'"
class="odd gradeX clickable-row" data-href='<?=base_url();?>student_admission_form/<?=$row['student_admission_id'];?>'>

<td><?= $i++; ?></td>

<td><?= $row['reg_no']; ?></td>
<td> <?= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></td>
<td><?= $row['semister']; ?></td>
<?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class  WHERE class_id='".$row['program']."' "); 
									// $query   = $builder->get(); 
									
								 foreach ($query3->getResult() as $row3) {
    
}
?>
                                    
<td><?= $row3->class; ?></td>
<td><?= $row['category']; ?></td>
<?php $query1= $db->query("SELECT * FROM prospect_sales WHERE prospect_no='".$row['prospectus_no']."'");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 foreach ($query1->getResult() as $query1_row) {
     
 }
 ?>
<td><?= $query1_row->contact_no; ?></td>
<td><?= date('d-m-Y', strtotime($row['date_of_admission'])); ?> </td>
<td><?= $row['session_year']; ?></td>
<td>
    
              <a title="Remove" href="<?=base_url();?>delete_student_list/<?=$row['student_admission_id'];?>"  
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              >
              <img src="<?=base_url();?>public/record_drop.png" height="12" width="12">
              </a>
              </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>


</div>

</div>

</div>

</div>
<script>
  var currentTab = 0;
  showTab(currentTab);

  function showTab(n) {
    var tabs = document.getElementsByClassName("tab");
    tabs[n].classList.add("active");
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (tabs.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // Show only the current tab
    for (var i = 0; i < tabs.length; i++) {
      if (i !== n) {
        tabs[i].classList.remove("active");
      }
    }
  }

  function nextStep() {
    var tabs = document.getElementsByClassName("tab");
    if (currentTab >= tabs.length - 1) {
      document.getElementById("wizardForm").submit();
      return false;
    }
    if (!validateForm()) return false;
    currentTab++;
    showTab(currentTab);
  }

  function prevStep() {
    if (currentTab <= 0) {
      return false;
    }
    currentTab--;
    showTab(currentTab);
  }

  function validateForm() {
    var tabs = document.getElementsByClassName("tab");
    var inputs = tabs[currentTab].getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value == "") {
        alert("Please fill in all fields.");
        return false;
      }
    }
    return true;
  }

  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
    currentTab = Array.prototype.indexOf.call(document.getElementsByClassName("tab"), document.getElementById(tabName));
  }
</script>


<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>


<script src="assets/js/vendor.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/app.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>


<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/pdfmake/build/pdfmake.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/pdfmake/build/vfs_fonts.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/jszip/dist/jszip.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/demo/table-manage-buttons.demo.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/@highlightjs/cdn-assets/highlight.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/demo/render.highlight.js" type="6d06734b60a66024f3330210-text/javascript"></script>

<!--for session select-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--end for session select-->


<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>
<script>
    function search_student(str,method)
{

var url="<?= base_url('search_enquiry_name') ?>";
url=url+"?q="+str+"&method="+method;
url=url+"&sid="+Math.random();

    // Internet Explorer
   try { prodreq1 = new ActiveXObject("Msxml2.XMLHTTP"); }
   catch(e) {
      try { prodreq1 = new ActiveXObject("Microsoft.XMLHTTP"); }
      catch(oc) { prodreq1 = null; }
   }
   
      // Mozailla/Safari
   if (!prodreq1 && typeof XMLHttpRequest != "undefined") { prodreq1 = new XMLHttpRequest(); }
   // Call the processChange() function when the page has loaded

   if (prodreq1 != null) {
      prodreq1.onreadystatechange = function(){
	   
		  if(prodreq1.readyState ==4 && prodreq1.status == 200)
		  {	
		   final_text=prodreq1.responseText ;
		  document.getElementById("student_list").innerHTML=final_text;
		  }
		  
		  }
		   prodreq1.open("GET", url, true);
      prodreq1.send(null);
		  }
		  

}



function select_student_detail(id){
//reg_no
getObject('enquiry_no').value = id.value;
}

function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;

  getObject('enquiry_no').value = x.value;
}

</script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 10;
  for (var i = 0; i < 11; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

</script>

<script>
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
<?= $this->endSection() ?>

