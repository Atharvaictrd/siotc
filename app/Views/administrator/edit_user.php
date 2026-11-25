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
</style>



<div class="col-xl-12">
<?php
if (!empty(session()->getFlashdata('select_fail'))) : ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= session()->getFlashdata('select_fail'); ?>
    </div>
<?php
endif
?>
<?php
if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php
endif
?>
<div class="panel panel-inverse">

<div class="panel-heading">

<h3 class="panel-title">Create User</h3>
</div>

<div class="panel-body">
    <form method="post" action="<?= base_url('update_user/'.$user->user_id)?>">
        <div class="form-group row">
          <div class="col-xl-2 offset-xl-3"><b> User Type : </b></div>
         <div class="col-xl-4"> <select name="usertype" class="form-control">
  <option value="">Select User Type</option>
  <option value="superadmin" <?php echo ($user->usertype == 'superadmin') ? 'selected' : ''; ?>>Superadmin</option>
  <option value="admin" <?php echo ($user->usertype == 'admin') ? 'selected' : ''; ?>>Admin</option>
  <option value="accountant" <?php echo ($user->usertype == 'accountant') ? 'selected' : ''; ?>>Accountant</option>
  <option value="teacher" <?php echo ($user->usertype == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
  <option value="other" <?php echo ($user->usertype == 'other') ? 'selected' : ''; ?>>Other</option>
</select></div>
         
                                   
         </div><br>
    <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b> Username : </b></div>
          <div class="col-xl-4"> <input type="text" name="username" class="form-control"  value="<?=$user->user_name; ?>">
          <small style="color:red;"><?= isset($validation) ? $validation->getError('username') : '' ?></small>
                                   
         </div>
    </div><br>
     <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b>  Password : </b></div>
          <div class="col-xl-4"> <input type="text" name="password" class="form-control"  value="<?=$user->password; ?>">
          <small style="color:red;"><?= isset($validation) ? $validation->getError('password') : '' ?></small></div>
    </div><br>
     <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b>Confirm Password  : </b></div>
          <div class="col-xl-4"> <input type="text" name="conf_password" class="form-control"  value="<?=$user->password; ?>">
          <small style="color:red;"><?= isset($validation) ? $validation->getError('conf_password') : '' ?></small></div>
    </div>
    <br>
   
<table id="data-table-buttons checkboxTable" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>


<th class="text-nowrap text-center">Assign Permission</th>
<th class="text-nowrap text-center"><input type="checkbox" id="checkAll">Check All</th>

</tr>
</thead>
<tbody>

<?php
$db = \Config\Database::connect();
$id= $user->user_id;

    if($user->user_id==1){
    $admission = 1;
    $fees = 1;
    $scholarship = 1;
    $time_table = 1;
    $employee_manage = 1;
    $staff_atten = 1;
    $salary = 1;
    $leaves = 1;
    $eve_planner = 1;
    $library = 1;
    $stock = 1;
    $amount =1;
    $exam = 1;
    $certificates = 1;
    $user_manage = 1;
    $administrator = 1;
    }else{
$query = $db->query("SELECT * FROM user_perm WHERE user_id='$user->user_id'");
$sn = 1;
$row = $query->getRow();
    
    $admission = $row->ADMISSION;
    $fees = $row->FEES;
    $scholarship = $row->SCHOLARSHIP;
    $time_table = $row->TIME_TABLE;
    $employee_manage = $row->EMPLOYEE_MANAGEMENT;
    $staff_atten = $row->STAFF_ATTENDANCE;
    $salary = $row->SALARY;
    $leaves = $row->LEAVES;
    $eve_planner = $row->EVENT_PLANNER;
    $library = $row->LIBRARY;
    $stock = $row->STOCK;
    $amount = $row->ACCOUNT;
    $exam = $row->EXAM;
    $certificates = $row->CERTIFICATES;
    $user_manage = $row->USER_MANAGEMENT;
    $administrator = $row->ADMINISTRATOR;
    
}
?>


<tr class="odd gradeX">
<td>Admission</td>
<td class="text-center"><input type="checkbox" name="admission"  value="1" class="checkbox" <?php if($admission == '1'){ ?> checked <?php } ?>> </td>
</tr>
<tr class="odd gradeX">
<td>Fees</td>
<td class="text-center"><input type="checkbox" name="fees"   value="1" class="checkbox" <?php if($fees == '1'){ ?> checked <?php } ?>> </td>
</tr>
<tr class="odd gradeX">
<td>Certificates </td>
<td class="text-center"><input type="checkbox" name="certificates"  value="1" class="checkbox" <?php if($certificates == '1'){ ?> checked <?php } ?>> </td>
</tr>
<tr class="odd gradeX">
<td>User Management </td>
<td class="text-center"><input type="checkbox" name="user_manage"  value="1" class="checkbox" <?php if($user_manage == '1'){ ?> checked <?php } ?>> </td>
</tr>
<tr class="odd gradeX">
<td>Administrator </td>
<td class="text-center"><input type="checkbox" name="administrator"  value="1" class="checkbox" <?php if($administrator == '1'){ ?> checked <?php } ?>> </td>
</tr>
<tr class="odd gradeX">

<td class="text-center" colspan="2"><input type="submit" name=""  id="submitButton" class=" btn btn-success col-xl-2" value="Update">
<input type="reset" name="" class=" btn btn-danger col-xl-2" ></td>
</tr>

</tbody>
</table>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>
</form>
</div>

</div>

</div>

</div>
<script>
    // Check All functionality
document.getElementById('checkAll').addEventListener('change', function () {
    var checkboxes = document.querySelectorAll('.checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});

// Form submission validation
// document.getElementById('submitButton').addEventListener('click', function () {
//     var checkboxes = document.querySelectorAll('.checkbox');
//     var isChecked = false;
//     for (var i = 0; i < checkboxes.length; i++) {
//         if (checkboxes[i].checked) {
//             isChecked = true;
//             break;
//         }
//     }
//     if (!isChecked) {
//         alert("Please select at least one option.");
//     } else {
//         // Form submission code here
//         // For example, you can submit the form programmatically or perform any other action
//         console.log("Form submitted successfully.");
//     }
// });

</script>
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


<?= $this->endSection() ?>

