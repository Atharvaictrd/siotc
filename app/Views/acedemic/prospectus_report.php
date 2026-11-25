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


<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Prospectus Sale report</h3>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('prospectus_report'); ?>">
<div class="form-group row">
   <div class="col-xl-6 "><b>
Student Name</b></div>
   <div class="col-xl-6"><b>Prospectus No.</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-6 ">
    <select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off" >
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM prospect_sales ORDER BY 	prospect_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->prospect_no.'">'.$row1->student_gender." . ".$row1->student_first_name." ".$row1->student_last_name.'</option>';
                                                  }
                                                  ?>
                                              </select>  </div>                              
    <div class="col-xl-6"><input type="text" name = "prospect_no" class="form-control" id="prospect_no"></div>
    </div>
  <br>
<div class="form-group row">
   <div class="col-xl-6"><b>From Date</b></div>
   <div class="col-xl-6"><b>To Date</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-6"><input type="date" name="f_date" class="form-control" id="f_date"></div>
    <div class="col-xl-6"><input type="date" name = "t_date" class="form-control" id="t_date"></div>
    
</div>
<br>

<div><h4>Advance Search</h4></div>
<div class="form-group row">
   <div class="col-xl-3"><b>Category</b></div>
   <div class="col-xl-3"><b>Program</b></div>
      <div class="col-xl-3"><b>Semester</b></div>
   <div class="col-xl-3"><b>Percentage</b></div>

</div>
<div class="form-group row">
       <div class="col-xl-3" ><select name="category" id="category" class="form-control" >
        <option value="">Click Here To Select...</option>
    <option value="OPEN">OPEN</option>
    <option value="OBC">OBC</option>
    <option value="SC">SC</option>
    <option value="ST">ST</option>
    <option value="NT">NT</option>
    <option value="SBC">SBC</option>
    <option value="VJ">VJ</option>
    <option value="TFWS">TFWS</option>
    <option value="SC">SC</option>
    </select></div>
   <div class="col-xl-3" ><?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="class1"  class="form-control" id="class">
            
            <option value="">-----SELECT-----</option>
            	<?php  foreach ($query3->getResult() as $row3) {
    

?>
            <option value="<?php echo $row3->class_id;?>"><?php echo $row3->class;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3" > <select name="semister"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php  $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); foreach ($query2->getResult() as $row2) {
    

?>
            <option value="<?php echo $row2->program_sem;?>"><?php echo $row2->program_sem;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><select class="form-control" name="percentage" id="percentage">
        <option>Click Here...</option>
        <option value="60 to 65">60 to 65</option>
        <option value="65 to 70">65 to 70</option>
        <option value="70 to 80">70 to 80</option>
        <option value="80 above">80 above</option>
        <option value="below 60">below 60</option>
    </select></div>
</div>
<br>
<div class="form-group row">
   <div class="col-xl-6 "><b>
Last School Attended</b></div>
   <!--<div class="col-xl-6"><b>Address</b></div>-->

</div>
<div class="form-group row">
    <div class="col-xl-6 ">

                                    
								
        <select name="last_school_attended"  class="form-control" id="last_school_attended">
            
            <option value="">-----SELECT-----</option>
            	<?php $query4 = $db->query("SELECT * FROM last_school_attended ORDER BY s_id ");  foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->school_name;?>"><?php echo $row4->school_name;?></option>
            <?php } ?></select>
         </div>                               
    <!--<div class="col-xl-6"><textarea type="text" name = "address" class="form-control" id="address" style="height:35px;"></textarea></div>-->
    </div>
  <br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-primary col-xl-4">Search</button>
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


<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" id="heading_title">Prospectus Sale report</h4>
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
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Prospectus No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Medium</th>
<th class="text-nowrap">Percentage</th>
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Amount</th>
<th class="text-nowrap">Delete</th>
</tr>
</thead>
<tbody>

<?php 
$s=count($source);
$i=1;
$count = 0;

                                    foreach ($source  as $fees_collection) {
                                        $count++;
                                       
								
	$sql = $db->query("SELECT * FROM student_admission_information WHERE prospectus_no ='".$fees_collection['prospect_no']."'");
	foreach ($sql->getResult() as $st_row) {
   $_POST['mar_name'] = ($_POST['mar_name'] ?? '') ? $_POST['mar_name'] : ($st_row->mar_name ?? '');
	    
	}
?>
                            <tr bgcolor="<?php echo($count%2==0)?'#ffffff':'#ffffff';?>">
                                <?php if($fees_collection['prospect_no']==$st_row->prospectus_no){ ?>
                            <td><span style="color:red;font-size:12px;">Already Admission Taken!</span></td>
                             <?php }else{ ?>
                             
                              <td><a class="btn btn-sm btn-warning" href="<?= base_url('student_admission/new_admission') ?>?id=<?php echo $fees_collection['prospect_no'];?>">Admission</a></td>
                             <?php } ?>
                              <td ><?php echo $i;?></td>
                              <td ><?php echo $fees_collection['prospect_no'];?></td>
                              <td style="white-space:nowrap;"><span style="white-space:nowrap;text-transform:uppercase;"><?php echo $fees_collection['student_gender'].'.'.$fees_collection['student_first_name'].' '.$fees_collection['student_middle_name'].' '.$fees_collection['student_last_name']?></span></td>
                              <?php  $query6 = $db->query("SELECT * FROM class WHERE class_id='".$fees_collection['class']."' "); foreach ($query6->getResult() as $row6) {  }?>
                              <td style="white-space:nowrap;"><?php echo $row6->class; ?></td>
                              <td style="white-space:nowrap;"><?php echo $fees_collection['semister'];?></td>
                              <td style="white-space:nowrap;"><?php echo $fees_collection['contact_no']?></td>
                              <td><?php echo $fees_collection['category']?></td>
                               <td  style="white-space:nowrap;"><?php echo $fees_collection['medium']?></td>
                              <td><?php echo $fees_collection['percentage'];?></td>
                              <td><?php echo $fees_collection['date'];?></td>
                                <td ><?php echo $fees_collection['amount'];?></td>
                               <td style="white-space:nowrap;">
                                   <!--<a href="id=<?php echo $fees_collection['prospect_id'];?>" ><i class="fa fa-pen-to-square" style="color:blue;font-size:20px;"></i></a> / -->
                               <a href="delete_prospect_report?id=<?php echo $fees_collection['prospect_id'];?>" onclick="return confirm('Are you sure you want to reset this data?');"><i class="fa fa-trash-can" style="color:red;font-size:20px;"></i></a></td>
                            </tr>
   <?php	$i++;  } ?>
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



<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>
<script>


    function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;
 $('#prospect_no').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}


</script>
<?= $this->endSection() ?>

