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
   .report-header { 
      text-align:center; 
      margin-bottom:20px;
      border-top: 3px solid black;
      padding-top: 15px;
  }
  th { background:#0d6efd; color:#fff; text-align:center; }
  td { text-align:center; }
  .grand-total { background:#348fe2; color:#fff; font-weight:bold; }
  .program-name { text-align:left !important; font-weight:600; }
    .filter-box { background:#fff; padding:15px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
</style>

<div class="row mt-sm-5 mt-md-0 mt-5">

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
        <!-- Header -->
        <div class="report-header">
            <h2 class="mt-2">CATEGORY-WISE STRENGTH REPORT (BRANCH-WISE)</h2>
            <h5>Session Year <?= $_SESSION['session_year']; ?></h5>

            <!-- Filters (Semester + Button in one row) -->
            <form method="POST" id="semesterForm">
                <div class="row mb-4 justify-content-center">
                    <div class="col-md-3">
                        <label class="form-label">Select Semester</label>
                        <select name="semister" class="form-control" id="semister">
                            <option value="">-----SELECT SEMESTER-----</option>
                            <?php  
                                $db = \Config\Database::connect();
                                $query1 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id"); 
                                foreach ($query1->getResult() as $row1) {
                            ?>
                            <option value="<?= $row1->program_sem; ?>"><?= $row1->program_sem; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            </form>

            <?php
            $selectedSemester = $_POST['semister'] ?? null; // default Sem I
            ?>

            <h5>Report of <?= $selectedSemester != '' ? $selectedSemester : 'All Semesters' ?></h5>

        </div>
</div>
</div>

<div class="col-xl-12">

<div class="panel panel-inverse">
<?php
$db = \Config\Database::connect();
$sessionYear = $_SESSION['session_year'];

if (!empty($selectedSemester)) {
    $query = $db->query("
        SELECT c.class AS program,
               SUM(CASE WHEN s.category='OPEN' THEN 1 ELSE 0 END) AS OPEN,
               SUM(CASE WHEN s.category='OBC' THEN 1 ELSE 0 END) AS OBC,
               SUM(CASE WHEN s.category='SC' THEN 1 ELSE 0 END) AS SC,
               SUM(CASE WHEN s.category='ST' THEN 1 ELSE 0 END) AS ST,
               SUM(CASE WHEN s.category='NT' THEN 1 ELSE 0 END) AS NT,
               SUM(CASE WHEN s.category='VJ' THEN 1 ELSE 0 END) AS VJ,
               SUM(CASE WHEN s.category='SBC' THEN 1 ELSE 0 END) AS SBC,
               SUM(CASE WHEN s.category='EBC' THEN 1 ELSE 0 END) AS EBC,
               SUM(CASE WHEN s.category='MINO.' THEN 1 ELSE 0 END) AS MINO,
               SUM(CASE WHEN s.pfws=1 THEN 1 ELSE 0 END) AS TFWS,
               SUM(CASE WHEN s.quota='ACAP' THEN 1 ELSE 0 END) AS ACAP,
               COUNT(*) AS total
        FROM student_admission_information s
        INNER JOIN class c ON s.program = c.class_id
        WHERE s.semister = ? 
          AND s.session_year = ?
        GROUP BY c.class
    ", [$selectedSemester, $sessionYear]);
} else {
    // Show all data only for current session
    $query = $db->query("
        SELECT c.class AS program,
               SUM(CASE WHEN s.category='OPEN' THEN 1 ELSE 0 END) AS OPEN,
               SUM(CASE WHEN s.category='OBC' THEN 1 ELSE 0 END) AS OBC,
               SUM(CASE WHEN s.category='SC' THEN 1 ELSE 0 END) AS SC,
               SUM(CASE WHEN s.category='ST' THEN 1 ELSE 0 END) AS ST,
               SUM(CASE WHEN s.category='NT' THEN 1 ELSE 0 END) AS NT,
               SUM(CASE WHEN s.category='VJ' THEN 1 ELSE 0 END) AS VJ,
               SUM(CASE WHEN s.category='SBC' THEN 1 ELSE 0 END) AS SBC,
               SUM(CASE WHEN s.category='EBC' THEN 1 ELSE 0 END) AS EBC,
               SUM(CASE WHEN s.category='MINO.' THEN 1 ELSE 0 END) AS MINO,
               SUM(CASE WHEN s.pfws=1 THEN 1 ELSE 0 END) AS TFWS,
               SUM(CASE WHEN s.quota='ACAP' THEN 1 ELSE 0 END) AS ACAP,
               COUNT(*) AS total
        FROM student_admission_information s
        INNER JOIN class c ON s.program = c.class_id
        WHERE s.session_year = ?
        GROUP BY c.class
    ", [$sessionYear]);
}

$data = $query->getResult();
?>



    
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th rowspan="2">Program</th>
                        <th colspan="11">Category-wise Strength</th>
                        <th rowspan="2">Total</th>
                    </tr>
                    <tr>
                        <th>OPEN</th><th>OBC</th><th>SC</th><th>ST</th><th>NT</th><th>VJ</th>
                        <th>SBC</th><th>EBC</th><th>MINO.</th><th>TFWS</th><th>ACAP</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                // Initialize grand total array
                $grandTotal = [
                    'OPEN'=>0,'OBC'=>0,'SC'=>0,'ST'=>0,'NT'=>0,'VJ'=>0,
                    'SBC'=>0,'EBC'=>0,'MINO'=>0,'TFWS'=>0,'ACAP'=>0,'total'=>0
                ];
                
                if(!empty($data)):
                    foreach($data as $row): 
                        // Sum grand totals
                        foreach($grandTotal as $key => $val){
                            $grandTotal[$key] += $row->$key;
                        }
                ?>
                <tr>
                    <td class="program-name"><?= $row->program ?></td>
                    <td><?= $row->OPEN ?></td>
                    <td><?= $row->OBC ?></td>
                    <td><?= $row->SC ?></td>
                    <td><?= $row->ST ?></td>
                    <td><?= $row->NT ?></td>
                    <td><?= $row->VJ ?></td>
                    <td><?= $row->SBC ?></td>
                    <td><?= $row->EBC ?></td>
                    <td><?= $row->MINO ?></td>
                    <td><?= $row->TFWS ?></td>
                    <td><?= $row->ACAP ?></td>
                    <td><?= $row->total ?></td>
                </tr>
                <?php 
                    endforeach; 
                endif; 
                ?>
                
                <!-- Grand total row -->
                <tr class="grand-total">
                    <td class="program-name">Grand Total</td>
                    <td><?= $grandTotal['OPEN'] ?></td>
                    <td><?= $grandTotal['OBC'] ?></td>
                    <td><?= $grandTotal['SC'] ?></td>
                    <td><?= $grandTotal['ST'] ?></td>
                    <td><?= $grandTotal['NT'] ?></td>
                    <td><?= $grandTotal['VJ'] ?></td>
                    <td><?= $grandTotal['SBC'] ?></td>
                    <td><?= $grandTotal['EBC'] ?></td>
                    <td><?= $grandTotal['MINO'] ?></td>
                    <td><?= $grandTotal['TFWS'] ?></td>
                    <td><?= $grandTotal['ACAP'] ?></td>
                    <td><?= $grandTotal['total'] ?></td>
                </tr>
                </tbody>

            </table>
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
