<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" >-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="...">
<?php
// function enq_no()
// {
    	$db      = \Config\Database::connect();
								
	$enq_sql = $db->query("SELECT enquiry_no FROM marketing_enquiry ORDER BY enquiry_no ASC");
// 	echo "SELECT enquiry_no FROM marketing_enquiry ORDER BY enquiry_no DESC";
// 	$enq=tep_db_fetch_array($enq_sql);
	foreach ($enq_sql->getResult() as $enq) {
    
	
	}
	$no =$enq->enquiry_no+1;


?>

<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
<link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
<link href="assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet" />
<link href="assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />


<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


<div id="content" class="app-content">


<div class="row">

<div class="col-md-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Student Enquiry</h3>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body">
<?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success my-5">
                                <h5><?=$_SESSION['success'];?></h5>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger my-5">
                                <h5><?=$_SESSION['error'];?></h5>
                            </div>
                        <?php endif; ?>

<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('create_enquiry')?>">
<div class="form-group row">
   <div class="col-md-3"><b>Date</b> <span style="color: red;">*</span></div>
   <div class="col-md-3"><b>Enquiry No.</b> <span style="color: red;">*</span></div>
   <div class="col-md-3"><b>Section</b><span style="color: red;">*</span></div>
   <div class="col-md-3"><b>Category</b><span style="color: red;">*</span></div>
</div>
<div class="form-group row">
    <div class="col-md-3"><input type="date" name="enquiry_date" class="form-control" id="" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" required></div>
    <!--id="" value="?php echo 	$no;?>"-->
    <div class="col-md-3"><input type="text" name = "enquiry_no" id="enquiry_no" class="form-control"  readonly="readonly" required></div>
 <div class="col-md-3"><select name="section" id="section" class="form-control" required>
            <option value="">Select Section</option>
      <option value="1">Section A</option>
    <option value="2" >Section B</option>
      </select></div>
       <div class="col-md-3"><select name="category" id="category" class="form-control" required>
            <option value="" selected>Select Category</option>
            </select>
            </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3"><b>Student Name</b> <span style="color: red;">*</span></div>
    <div class="col-md-3"><b>First Name</b> <span style="color: red;">*</span></div>
    <div class="col-md-3"><b>Middle Name</b> <span style="color: red;">*</span></div>
    <div class="col-md-3"><b>Last Name</b> <span style="color: red;">*</span></div>
 </div>
 
 
 
 <div class="form-group row">
     <div class="col-md-3"><select name="gender" class="form-control" id="" required>
         <option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    <option value="Miss">Miss</option>
         
         </select>
     </div>
     <div class="col-md-3"><input type="text" name="f_name" class="form-control" id="" required></div>
     <div class="col-md-3"><input type="text" name="m_name" class="form-control" id="" required></div>
     <div class="col-md-3"><input type="text" name="l_name" class="form-control" id="" required></div>
      
 </div><br>
 <div class="form-group row">

      <div class="col-md-1" ><b>Gender: </b></div>
     <div class="col-md-3"><input type="radio" name="gender1"
            value="male" checked/>
<span class="margin">Male</span>
				<input type="radio" name="gender1"
            value="female"/>
<span class="margin">Female</span></div>
   
</div>
<br>
<div class="form-group row">
    <div class="col-md-3"><b>Program</b> <span style="color: red;">*</span></div>
    <div class="col-md-2"><b>Semester</b> <span style="color: red;">*</span></div>
    <div class="col-md-2"><b>Session</b> <span style="color: red;">*</span></div>
    <div class="col-md-2"><b>Contact No</b> <span style="color: red;">*</span></div>
    <div class="col-md-3"><b>Email</b></div>
</div>
 <div class="form-group row">
     <div class="col-md-3"><?php
			$db      = \Config\Database::connect();
			 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); 
			// $query   = $builder->get(); 
			
			?>
                                    
								
        <select id="program" name="class[]" multiple class="form-control">
<?php foreach ($query3->getResult() as $row3) { ?>
<option value="<?= $row3->class_id ?>">
<?= $row3->class ?>
</option>
<?php } ?>
</select>
    </div>
     <div class="col-md-2"><?php
									$db      = \Config\Database::connect();
									 $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="semister"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) { 

if($row2->program_sem == 'Sem I' || $row2->program_sem == 'DIR II Year'){
?>
<option value="<?php echo $row2->program_sem;?>">
<?php echo $row2->program_sem;?>
</option>
<?php } } ?></select></div>
     <div class="col-md-2"><select name="session" onchange="javascript:form_submit();"  id="dropdownYear1" class=" form-control" >
          <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
         </select></div>
     <div class="col-md-2">
<input type="text" name="contact_no" class="form-control">
</div>

<div class="col-md-3">
<input type="email" name="email" class="form-control">
</div>
 </div>
 <br>
 <div class="form-group row">
     <div class="col-md-4"><b>Address</b> </div>
     <div class="col-md-4"><b>Last School / College Attended</b></div>
     <div class="col-md-4"><b>Landmark</b></div>
  </div>
  <div class="form-group row">
      <div class="col-md-4"><textarea type="text" name="address" class="form-control" id=""></textarea></div>
      <div class="col-md-4">
                                <?php
                                
                                     $query8 = $db->query("SELECT * FROM last_school_attended ORDER BY s_id "); 
                                    // $query   = $builder->get(); 
                                    
                                    ?><select name="last_school_attended" id="last_school_attended" class="form-control chosen-select" >
           <?php foreach ($query8->getResult() as $row8) {
    

?>
            <option value="<?php echo $row8->s_id;?>"><?php echo $row8->school_name;?></option>
            <?php } ?>
    </select></div>
      <div class="col-md-4">
          	<?php
									$db      = \Config\Database::connect();
									 $query = $db->query("SELECT * FROM adress_keywords ORDER BY id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
			<textarea type="text" name="landmark" class="form-control" id=""></textarea>					
<!--        <select name="landmark"  class="default-select2 form-control" id="landmark">-->
            
<!--            <option value="">-----SELECT-----</option>-->
<!--            	?php foreach ($query->getResult() as $row) {-->
    

<!--?>-->
<!--            <option value="?php echo $row->adress_key;?>">?php echo $row->adress_key;?></option>-->
<!--            ?php } ?>-->
<!--            </select>-->
            
  </div><br>
  <div class="form-group row">
     <div class="col-md-4"><b>Percentage</b> </div>
     <div class="col-md-4"><b>Medium</b></div>
     <div class="col-md-4"><b>Reference With</b></div>
  </div>
  <style>
      .input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    white-space: nowrap;
    vertical-align: middle;
    display: table-cell;
}
  </style>
  <div class="form-group row">
      <div class="col-md-4"><div class="input-group suffix">    <input type="text" name="percentage" class="form-control" id="" ><span class="input-group-addon ">%</span></div></div>
      
      <div class="col-md-4"><select name="medium" class="form-control"><option value=""  selected="">--Medium--</option><option value="Hindi">Hindi</option><option value="English">English</option><option value="Marathi">Marathi</option><option value="Semi-English">Semi-English</option></select></div>
 
      <div class="col-md-4"><?php
									$db      = \Config\Database::connect();
									 $query1 = $db->query("SELECT * FROM reference_details ORDER BY refer_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="reference_details"  class="default-select2 form-control" id="reference">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query1->getResult() as $row1) {
    

?>
            <option value="<?php echo $row1->reference;?>"><?php echo $row1->reference;?></option>
            <?php } ?>
            </select></div>
  </div><br><br><br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn btn-primary">Cancel</button>
</div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>


<div class="col-md-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Student Enquiry List</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
<th class="text-nowrap">Action</th>
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Enquiry No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Email</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Percentage</th>
<th class="text-nowrap">Medium</th>
<th class="text-nowrap">Reference</th>

</tr>
</thead>
<tbody>

  <?php 
//   echo "SELECT enquiry_no FROM marketing_enquiry ORDER BY enquiry_no DESC";
$session = $_POST['session'] ?? $_SESSION['session_year'];
$enq_sql1 = $db->query("SELECT * FROM marketing_enquiry 
WHERE session='$session'
ORDER BY enquiry_no DESC");
	  $count = 0;
	 
	      	foreach ($enq_sql1->getResult() as $fees_collection) {
// echo $fees_collection->l_name;
		$count++;
// 	$class = $db->query("SELECT * FROM class WHERE class_id='".$fees_collection->class."' "); 
//                                     // $query   = $builder->get(); 
//                                     foreach ($class->getResult() as $class3) { }
                            $class_ids = explode(',', $fees_collection->class);
                                
                            $class = $db->query(
                            "SELECT class FROM class WHERE class_id IN (".implode(',', $class_ids).")"
                            )->getResult();
                            
                            $program_names = [];
                            
                            foreach($class as $c){
                                $program_names[] = $c->class;
                            }
                            
                            $class3 = implode(', ', $program_names);
?>
                            <tr bgcolor="<?php echo($count%2==0)?'#ffffff':'#ffffff';?>">
                              <td style="white-space:nowrap;">
                                  <!--<a href="id=<?php echo $fees_collection->enquiry_no;?>" ><i class="fa fa-pen-to-square" style="color:blue;font-size:20px;"></i></a> / -->
                              <a href="<?php echo base_url('delete_enquiry/'.$fees_collection->enquiry_no); ?>" onclick="return confirm('Are you sure you want to reset this data?');"><i class="fa fa-trash-can" style="color:red;font-size:20px;"></i></a></td>
                              <td ><?php echo $fees_collection->enquiry_date;?></td>
                              <td ><?php echo $fees_collection->enquiry_no;?></td>
                              <td style="white-space:nowrap;"><span style="white-space:nowrap;text-transform:uppercase;"><?php echo $fees_collection->gender.'.'.$fees_collection->f_name.' '.$fees_collection->m_name.' '.$fees_collection->l_name?></span></td>
                              <td style="white-space:nowrap;"><?php echo $class3; ?></td>
                              <td style="white-space:nowrap;"><?php echo $fees_collection->semister;?></td>
                              <td style="white-space:nowrap;"><?php echo $fees_collection->contact_no?></td>
                              <td><?php echo $fees_collection->email;?></td>
                              <td><?php echo $fees_collection->category?></td>
                              <td><?php echo $fees_collection->percentage;?></td>
                              <td><?php echo $fees_collection->medium;?></td>
                               <td><?php echo $fees_collection->reference_details;?></td>
                            </tr>
                            <?php	  } ?>
                       
                            

</tbody>
</table>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

</div>

</div>

</body>

<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/select2/dist/js/select2.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/js/app.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/vendor.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->



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



<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer></script>

<script src="assets/plugins/moment/min/moment.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/tag-it/js/tag-it.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/clipboard/dist/clipboard.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/select-picker/dist/picker.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/js/demo/form-plugins.demo.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/@highlightjs/cdn-assets/highlight.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/js/demo/render.highlight.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script>
$(document).ready(function () {
    $('#program').select2({
        placeholder: "Select Program",
        width: '100%'
    });
});
</script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
  $('#dropdownYear1').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
</script>

<script>
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function select_student_detail(id){
//reg_no
getObject('enquiry_no').value = id.value;
}
</script>


<script>
function refreshEnquiryNo() {
    $.get("<?= base_url('Home/getNextEnquiryNo'); ?>", function(data) {
        $("#enquiry_no").val(data);
        // console.log("Next Enquiry No: " + data);
    });
}

// Page load pe ek baar call karo
refreshEnquiryNo();

// Ab har 1 second me auto refresh karega
setInterval(refreshEnquiryNo, 1000);
</script>
<?= $this->endSection() ?>

