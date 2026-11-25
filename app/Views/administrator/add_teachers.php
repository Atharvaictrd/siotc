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

<h3 class="panel-title">Create Teaching</h3>
</div>

<div class="panel-body">
    <form method="post" action="<?= base_url('save_user')?>">
    <div class="form-group row">
          <div class="col-xl-2 offset-xl-3"><b> Employee Type : </b></div>
         <div class="col-xl-4">  <select name="usertype" class="form-control">
  <option value="">Select Employee Type</option>
  <option value="Non-Teaching">Non-Teaching</option>
  
  <option value="Teaching">Teaching</option>
</select></div>
         
                                   
         </div><br>
           <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b> Teacher Name : </b></div>
          <div class="col-xl-4"> <input type="text" name="name" class="form-control"  value="<?= set_value("name"); ?>">
          <small style="color:red;"><?= isset($validation) ? $validation->getError('username') : '' ?></small>
                                   
         </div>
    </div><br>
     <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b>  Subject : </b></div>
          <div class="col-xl-4"> <input type="password" name="password" class="form-control"  value="<?= set_value("password"); ?>">
          <small style="color:red;"><?= isset($validation) ? $validation->getError('password') : '' ?></small></div>
    </div><br>
     <div class="form-group row">
        <div class="col-xl-2 offset-xl-3"><b>Confirm Password  : </b></div>
          <div class="col-xl-4"> <input type="password" name="conf_password" class="form-control"  value="<?= set_value("conf_password"); ?>">
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

<tr class="odd gradeX">
<td>Admission</td>
<td class="text-center"><input type="checkbox" name="admission"  value="1" class="checkbox"> </td>
</tr>
<tr class="odd gradeX">
<td>Fees</td>
<td class="text-center"><input type="checkbox" name="fees"   value="1" class="checkbox"> </td>
</tr>
<!--<tr class="odd gradeX">-->
<!--<td>Scholarship</td>-->
<!--<td class="text-center"><input type="checkbox" name="scholarship"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Time Table Management</td>-->
<!--<td class="text-center"><input type="checkbox" name="time_table"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Employee Management</td>-->
<!--<td class="text-center"><input type="checkbox" name="employee_manage"   value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Staff Attendance</td>-->
<!--<td class="text-center"><input type="checkbox" name="staff_atten"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Salary</td>-->
<!--<td class="text-center"><input type="checkbox" name="salary"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Leaves</td>-->
<!--<td class="text-center"><input type="checkbox" name="leaves"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Event Planner</td>-->
<!--<td class="text-center"><input type="checkbox" name="eve_planner"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Library</td>-->
<!--<td class="text-center"><input type="checkbox" name="library"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Stock </td>-->
<!--<td class="text-center"><input type="checkbox" name="stock"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Account </td>-->
<!--<td class="text-center"><input type="checkbox" name="amount"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<!--<tr class="odd gradeX">-->
<!--<td>Exam </td>-->
<!--<td class="text-center"><input type="checkbox" name="exam"  value="1" class="checkbox"> </td>-->
<!--</tr>-->
<tr class="odd gradeX">
<td>Certificates </td>
<td class="text-center"><input type="checkbox" name="certificates"  value="1" class="checkbox"> </td>
</tr>
<tr class="odd gradeX">
<td>User Management </td>
<td class="text-center"><input type="checkbox" name="user_manage"  value="1" class="checkbox"> </td>
</tr>
<tr class="odd gradeX">
<td>Administrator </td>
<td class="text-center"><input type="checkbox" name="administrator"  value="1" class="checkbox"> </td>
</tr>
<tr class="odd gradeX">

<td class="text-center" colspan="2"><input type="submit" name=""  id="submitButton" class=" btn btn-success col-xl-2" >
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

