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
<h3 class="panel-title">
List of Student Enquired for Admission According to Area or Address</h3>
</div>


<div class="panel-body">


  <div class="row">
      <div class="col-md-6">
          <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('list_student_area'); ?>">
          <div class="form-group row">
          <label class="col-lg-2 col-form-label form-label" for="program">Address :</label>
            <div class="col-lg-10">
        <textarea type="text" name="address" class="form-control" id="address"></textarea>
        </div>
        </div>
        <div class="form-group row mt-3">
        <label class="col-lg-2 col-form-label form-label" for="program">Landmark :</label>
            <div class="col-lg-10">
        <select name="landmark" id="landmark" class="form-control chosen-select" >
        <option value="">Click Here To Select...</option>
    <?php
         $db  = \Config\Database::connect();
                            $query1= $db->query("SELECT * FROM adress_keywords ORDER BY id ASC"); 
        foreach ($query1->getResult() as $row1) {
?>
            <option value="<?=$row1->adress_key?>"><?=$row1->adress_key?></option>
            <?php
          }
          ?>
    </select>
        </div>
        </div>
        <div class="form-group row mt-3">
<label class="col-lg-2 col-form-label form-label">&nbsp;</label>
<div class="col-lg-10">
<button type="submit" class="btn btn-primary">Search</button>
<button type="reset" class="btn btn-primary">Cancel</button>
</div>
</div>
</form>
      </div>
      <div class="col-md-6">
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
          <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('save_new_keyword')?>">
          <div class="form-group row">
          <label class="col-lg-4 col-form-label form-label" for="program">Address Keywords :</label>
            <div class="col-lg-8">
        <input type="radio" name = "address_key"  id="address_key"  onclick="show1();"> <span>Click Here to Enter Address Landmark</span>
        </div>
        </div>
        <div id="div1" style="display: none">
            <div class="form-group row mt-3" >
          <label class="col-lg-4 col-form-label form-label" for="program">Enter Address Keywords :</label>
            <div class="col-lg-8">
        <input type="text" class="form-control" name = "add_new_address_key"  id="add_address_key">
        </div>
        </div>
        <div class="form-group row mt-3">
          <label class="col-lg-4 col-form-label form-label" for="program"></label>
            <div class="col-lg-8">
        <input type="submit" class="btn btn-success" value="submit">
        </div>
        </div>
        </div>
        </form>
      </div>
  </div>



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
<h4 class="panel-title">List</h4>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>


<th class="text-nowrap">Date</th>
<th class="text-nowrap">Enquiry No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Address</th>
<th class="text-nowrap">Refer By</th>
</tr>
</thead>
<tbody>

<?php
$s=count($source);

                                    foreach ($source  as $row) :
                                         $query13= $db->query("SELECT * FROM class WHERE class_id='".$row['class']."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query13->getResult() as $row13){
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row13->class;
}
                                        ?>
<tr class="odd gradeX">

<td><?= $row['enquiry_date']; ?> </td>
<td><?= $row['enquiry_no']; ?></td>
<td> <?= $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?></td>

<td><?= $program1; ?></td>
<td><?= $row['semister']; ?> </td>
<td><?= $row['contact_no']; ?></td>
<td><?= $row['category']; ?></td>
<td><?= $row['address']; ?> </td>
<td><?= $row['reference_details']; ?></td>

</tr>
<?php endforeach; ?>

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
 $('#enquiry_no').val(x);
//   getObject('enquiry_no').value = x.value;
}

</script>
<script>
    function show1(){
  document.getElementById('div1').style.display = 'block';
}
</script>
<?= $this->endSection() ?>



