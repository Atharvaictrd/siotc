<?= $this->extend('layout/tempmain') ?>

<?= $this->section('content') ?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" >-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="...">
<?php
	$db      = \Config\Database::connect();
	$enq_sql = $db->query("SELECT id FROM employees ORDER BY emp_id ASC");
	foreach ($enq_sql->getResult() as $enq) {}
    $emp_id = "EMP".(1000+($enq->id+1));
?>
<style>
    .form-group{
    margin-bottom: 15px;
    }
    .bg-danger1{
            background-color: #f2dede;
    }
</style>
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
    <?php if(session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
      
      <?php if(session()->has('error')): ?>
          <div class="alert alert-danger alert-dismissible">
              <?= session('error') ?>
          </div>
      <?php endif; ?>
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" id="heading_title">Employee List  <div id="refresh_every_sec"><input type="text" id="enquiry_no"></div></h4>
<div class="panel-heading-btn">

<div class="box-tools pull-right">
            <button type="button" class="btn btn-primary"  id="add_new_emp">Add New Employee</button>
          </div>
</div>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
	<th>SNO.</th>
	<th>EMP ID</th>
	<th>NAME</th>
	<th>EMAIL</th>
	<th>MOBILE</th>
	<th>DOB</th>
	<th>JOINING</th>
	<th>DESIGNATION</th>
	<th width="6%">ACTION</th>
</tr>
</thead>
<tbody>
				    <?php
			        
			        $qry = $db->query("SELECT * FROM `employees` ORDER BY id DESC");
                    $sn = 1;
                    foreach ($qry->getResult() as $row) {
                        $formattedDate = date('d/M/Y', strtotime($row->doj));
				    ?>
				    <tr>
						<td><?=$sn++;?></td>
				        <td><?=$row->emp_id;?></td>
						<td><?=$row->name;?></td>
						<td><?=$row->email;?></td>
						<td><?=$row->mobile;?></td>
						<td><?=$row->dob;?></td>
						<td><?=$formattedDate;?></td>
						<td><?=$row->designation;?></td>
					    <td class=" dt-center">
					        <button class="btn btn-warning btn-xs manageSalary" title="Generate Salary Slip!" data-id="<?=$row->emp_id;?>" data-name="<?=$row->name;?>"><i class="fa fa-money"></i></button> 
					        <!--<button class="btn btn-primary btn-xs addSalary" title="Hello World!"><i class="fa fa-gratipay"></i></button> -->
					        <button class="btn btn-success btn-xs editEmp" title="Edit!" data-id="<?=$row->id;?>" data-name="<?=$row->name;?>"><i class="fa fa-edit"></i></button> 
					        <a title="Remove" href="<?=base_url();?>delete_emp/<?=$row->id;?>"  
	  		                onclick="if (confirm('Are you sure You want to delete?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
	  		                class="btn btn-danger btn-xs">
					        <i class="fa fa-trash"></i></a>
					    </td>
				    </tr>
				    <?php
                    }
				    ?>
				</tbody>
</table>

 <!--modal start-->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Add Employee Details</h4><button type="button" class="btn btn-danger btn-sm close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
           <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?=base_url();?>add_new_employee" enctype="multipart/form-data">
           <!--<form method="post" role="form" data-toggle="validator" id="edit-emp-form">-->
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="emp_code">Emp. ID</label>
										<div class="form-control" style="background-color: #d2d6de4f;"><?=$emp_id;?></div>
										<input type="hidden" name="emp_id" value="<?=$emp_id;?>" />
									</div>
									<div class="col-sm-8">
										<label for="full_name">Full Name <span style="color:red">*</span></label>
										<input type="text" class="form-control" name="full_name"  placeholder="Enter Employees full name" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								    <div class="col-sm-4">
										<label for="basic_salary">Basic Salary <span style="color:red">*</span></label>
										<input type="text" class="form-control" name="basic_salary"  required />
									</div>
									<div class="col-sm-4">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email"   />
									</div>
									<div class="col-sm-4">
										<label for="mobile">Mobile</label>
										<input type="text" class="form-control" name="mobile" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="joining_date">Emp. DOJ</label>
										<input type="date" class="form-control" name="joining_date"  />
									</div>
									<div class="col-sm-4">
										<label for="dob">Emp. DOB (DD/MM/YYYY)</label>
										<input type="text" class="form-control " name="dob"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask />
									</div>
									<div class="col-sm-4">
										<label for="gender">Gender  <span style="color:red">*</span></label>
										<select class="form-control" name="gender"  >
											<option value="">Please select</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
											<option value="other">Other</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-8">
										<label for="address">Address</label>
										<textarea class="form-control" name="address"></textarea>
									</div>
									
									<div class="col-sm-4">
										<label for="city">Photo</label>
										<input type="file" class="form-control" name="photo"  />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="city">City</label>
										<input type="text" class="form-control" name="city"  />
									</div>
									<div class="col-sm-4">
										<label for="state">State</label>
										<input type="text" class="form-control" name="state"  />
									</div>
									<div class="col-sm-4">
										<label for="country">Country</label>
										<input type="text" class="form-control" name="country"  />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="designation">Designation</label>
										<input type="text" class="form-control" name="designation" />
									</div>
									<div class="col-sm-4">
										<label for="department">Department</label>
										<input type="text" class="form-control" name="department"  />
									</div>
									<div class="col-sm-4">
										<label for="pan_no">PAN No.</label>
										<input type="text" class="form-control" name="pan_no"  />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="bank_name">Bank Name</label>
										<input type="text" class="form-control" name="bank_name" />
									</div>
									<div class="col-sm-4">
										<label for="account_no">Bank A/C No.</label>
										<input type="text" class="form-control" name="account_no"  />
									</div>
									<div class="col-sm-4">
										<label for="ifsc_code">IFSC Code</label>
										<input type="text" class="form-control" name="ifsc_code"  />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="pf_account">PF A/C No.</label>
										<input type="text" class="form-control" name="pf_account"  />
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer"><button type="button" class="btn btn-default pull-left close">Close</button>
							<button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
						</div>
					</form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!--modal end-->
  
</div>

</div>

</div>

</div>

</div>

</body>

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

<script src="assets/plugins/moment/min/moment.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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

 <div class="modal fade in" id="EditEmpModal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					
					<h4 class="modal-title">Update Employee Details<img id="emp_photo" src="" alt="Employee Photo" style="width: 90px;height: auto;margin-left: 3rem;"></h4>
					<button type="button" class="btn btn-danger btn-sm close" >
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" role="form" data-parsley-validate="true" name="demo-form" method="post" action="<?=base_url();?>update_employee" enctype="multipart/form-data" >
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<label for="emp_code">Emp. ID</label>
									<div class="form-control" id="emp_code" style="background-color: #d2d6de4f;"></div>
									<input type="hidden" name="emp_id" id="emp_id" />
									<input type="hidden" name="id" id="id" />
								</div>
								<div class="col-sm-8">
									<label for="full_name">Full Name <span style="color:red;">*</span></label>
									<input type="text" class="form-control" name="full_name" id="full_name" required />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
							    <div class="col-sm-4">
									<label for="basic_salary">Basic Salary <span style="color:red">*</span></label>
									<input type="text" class="form-control" name="basic_salary" id="basic_salary"  required />
								</div>
								<div class="col-sm-4">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" id="email" />
								</div>
								
								<div class="col-sm-4">
									<label for="mobile">Mobile</label>
									<input type="text" class="form-control" name="mobile" id="mobile" />
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								
								<div class="col-sm-4">
									<label for="joining_date">DOJ (MM/DD/YYYY)</label>
									<input type="date" class="form-control" name="joining_date" id="joining_date" />
								</div>
								<div class="col-sm-4">
									<label for="dob">Emp. DOB (MM/DD/YYYY)</label>
									<input type="text" class="form-control datepicker" name="dob" id="dob" />
								</div>
								<div class="col-sm-4">
									<label for="gender">Gender <span style="color:red;">*</span></label>
									<select class="form-control" name="gender" id="gender" required>
										<option value="">Please select</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-8">
									<label for="address">Address</label>
									<textarea class="form-control" name="address" id="address"></textarea>
								</div>
								<div class="col-sm-4">
								    
									<label for="city">Photo</label>
									<input type="file" class="form-control" name="photo"  />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<label for="city">City</label>
									<input type="text" class="form-control" name="city" id="city" />
								</div>
								<div class="col-sm-4">
									<label for="state">State</label>
									<input type="text" class="form-control" name="state" id="state" />
								</div>
								<div class="col-sm-4">
									<label for="country">Country</label>
									<input type="text" class="form-control" name="country" id="country" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<label for="designation">Designation</label>
									<input type="text" class="form-control" name="designation" id="designation" />
								</div>
								<div class="col-sm-4">
									<label for="department">Department</label>
									<input type="text" class="form-control" name="department" id="department" />
								</div>
								<div class="col-sm-4">
									<label for="pan_no">PAN No.</label>
									<input type="text" class="form-control" name="pan_no" id="pan_no" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<label for="bank_name">Bank Name</label>
									<input type="text" class="form-control" name="bank_name" id="bank_name" />
								</div>
								<div class="col-sm-4">
									<label for="account_no">Bank A/C No.</label>
									<input type="text" class="form-control" name="account_no" id="account_no" />
								</div>
								<div class="col-sm-4">
									<label for="ifsc_code">IFSC Code</label>
									<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<label for="pf_account">PF A/C No.</label>
									<input type="text" class="form-control" name="pf_account" id="pf_account" />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="submit" class="btn btn-primary">Update Employee</button>
					</div>
				</form>
			</div>
		</div>
	</div>
  <!--update emp modal-->
   <!--salary modal-->
  <div class="modal fade in" id="SalaryMonthModal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					
					<h4 class="modal-title">Select Salary Month for <span  class="modal-title1"  style="color:#e82324;text-decoration:underline;"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding: 15px 30px;">
					<div class="row">
						<?php 
						$months = array(); $years = array();
						$before2Month = (int)date('m') - 2;
						for ( $i = $before2Month; $i < $before2Month + 16; $i++ ) {
						    $months[$i] = date('F', mktime(0, 0, 0, $i, 1));
						    $years[$i] = date('Y', mktime(0, 0, 0, $i, 1));
						}
						foreach ( $months as $key => $month ) { ?>
							<div class="col-sm-3 <?php echo ($month == date('F') && $years[$key] == date('Y')) ? 'bg-danger1' : ''; ?>" style="border: 1px solid #ddd;padding: 0;text-align: center;">
								<a data-month="<?php echo $month; ?>" data-year="<?php echo $years[$key]; ?>" href="#" style="display: block;font-size: 20px;font-weight: bold;padding: 15px 5px;text-decoration:none;">
									<?php echo strtoupper($month); ?><br /><?php echo $years[$key]; ?>
								</a>
							</div>
						<?php 
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!--end salary modal-->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
        // Handle button click for salary generation
        $('.manageSalary').click(function () {
            const name = $(this).data('name'); // Get employee name
            const empId = $(this).data('id'); // Get employee ID
            
            // Update modal title with employee details
            $('#SalaryMonthModal .modal-title1').text(`${name} (ID: ${empId})`);

            // Base URL for generating salary slip links
            const baseUrl = "<?= base_url(); ?>pay-salary/";

            // Update links in the modal for each month
            $('#SalaryMonthModal a').each(function () {
                const month = $(this).data('month'); // Get month from the link
                const year = $(this).data('year'); // Get year from the link
                const salaryLink = `${baseUrl}?emp_id=${empId}&month=${month}&year=${year}`;
                $(this).attr('href', salaryLink); // Set the link's href attribute
            });

            // Show the modal
            $('#SalaryMonthModal').modal('show');
        });
        
        
        // to add emp 
        $('#add_new_emp').click(function (){
            $('#modal-default').modal('show');
        });
        // to close emp 
        $('.close').click(function (){
            $('#modal-default').modal('hide');
            $('#SalaryMonthModal').modal('hide');
            $('#EditEmpModal').modal('hide');
        });
        // for update modal
        $('.editEmp').click(function () {
             // Get employee data from data attributes
            let empId = $(this).closest('td').find('.editEmp').data('id');
            let empName = $(this).closest('td').find('.editEmp').data('name');
            $.ajax({
            url: '<?=base_url();?>getEmployeeDetails', // Replace with your API endpoint
            type: 'GET',
            data: { emp_id: empId },
            success: function (response) {
                // Populate modal fields with the fetched data
                $('#emp_code').html(`<b>${response.emp_id}</b>`);
                $('#id').val(response.id);
                $('#emp_id').val(response.emp_id);
                $('#basic_salary').val(response.salary);
                $('#full_name').val(response.name);
                $('#dob').val(response.dob);
                $('#gender').val(response.gender);
                $('#city').val(response.city);
                $('#address').val(response.address);
                $('#state').val(response.state);
                $('#country').val(response.country);
                $('#email').val(response.email);
                $('#mobile').val(response.mobile);
                $('#joining_date').val(response.doj);
                $('#designation').val(response.designation);
                $('#department').val(response.department);
                $('#pan_no').val(response.pan_no);
                $('#bank_name').val(response.bank_name);
                $('#account_no').val(response.account_no);
                $('#ifsc_code').val(response.ifsc_code);
                $('#pf_account').val(response.pf_account);
                 if (response.photo) {
                    // Set the image source
                    $('#emp_photo').attr('src', `/emp_photo/${response.photo}`); // Adjust the path as needed
                } else {
                    // Set a default placeholder if no photo exists
                    $('#emp_photo').attr('src', '/emp_photo/user_icon.png');
                }

                // Show the modal
                $('#EditEmpModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch employee details. Please try again.');
            }
        });
        });
    });
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

