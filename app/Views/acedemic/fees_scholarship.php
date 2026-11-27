<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
if((isset($_GET['action']))&&($_GET['action']=='notSubmit'))
{
    $sid=($_GET['std'] ?? '');
    if(!empty($sid))
    {
        $sql=tep_db_query("UPDATE student_admission_information SET scholarship_status ='1' WHERE student_admission_id='$sid'");
    }
    
}
if((isset($_GET['action']))&&($_GET['action']=='Submit'))
{
    $sid=($_GET['std'] ?? '');
    if(!empty($sid))
    {
        $sql=tep_db_query("UPDATE student_admission_information SET scholarship_status ='0' WHERE student_admission_id='$sid'");
    }
    
}
?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 20px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


<div id="content" class="app-content">




<div class="col-xl-12">

<div class="panel panel-inverse">
<br>
<div class="">
 <h3 class="text-center" style="font-family:serif;">SCHOLARSHIP FORM DETAILS</h3>
 <h4 class="text-center" style="font-family:serif;"> </h4>
 <h6 class="text-center" style="font-family:serif;"> Session Year: <?php echo $_SESSION['session_year'];?> </h6>
</div>

<div class="panel-body">
    <form method="post">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
    <tr>
        <th class="text-center" colspan="5">Printed Date :  <?= date('d-m-Y');?></th>
    </tr>
<tr>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Reference</th>
<th class="text-nowrap">Scholarship Form Submit</th>
</tr>
</thead>

<tbody>
<?php
$s=count($source);
$n=1;
                                    foreach ($source  as $row) :
                                        ?>
<tr>

<td> <?= $n++.$row['student_admission_id']; ?></td>
<td><?= $row['salutation'].' '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?> </td>
<td><?= $row['category']; ?></td>
<td><?= $row['reference_details']; ?></td>
<?php if ($canEditScholarship): ?>

<td valign="middle" align="center">
    <label class="switch">
        <input
            type="checkbox"
            eid="<?= $row['student_admission_id']; ?>"
            <?= $row['scholarship_status'] == 1 ? 'checked' : ''; ?>
        >
        <span class="slider round"></span>
    </label>
</td>

<?php else: ?>

<td valign="middle" align="center">
    <?= $row['scholarship_status'] == 1 ? 'Active' : 'Inactive'; ?>
</td>

<?php endif; ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>
<script>
 $(document).on('change', '#status', function() {
        let id = $(this).attr('eid');
        // alert(id);
        $.ajax({
            type: "post",
            url: "<?= base_url('fees_report/scholarship/togglestatus'); ?>",
            data: {
                'id': id
            },
            dataType: "JSON",
            success: function(response) {
                // alert(response);
                $('#status').toggle();
                 window.location.reload();
            }
        });
    });
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

// Get the checkbox element





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
    <script>
function myonclick(id=null,status)
 {

 $.ajax({

            type: "POST",
            url: "<?= base_url(); ?>schupdate_status",
            data: { id: id,status:status,name:'student_admission_information',field1:'student_admission_id',field2:'scholarship_status'},
            success : function(data)
            {
            alert(data);
            ajax.reload(null, false);
            window.location.reload();
             
            }
            });
}
</script>
</script>
<?= $this->endSection() ?>

