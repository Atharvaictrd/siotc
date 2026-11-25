<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<!--<ol class="breadcrumb float-xl-end">-->
<!--<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>-->
<!--<li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>-->
<!--<li class="breadcrumb-item active">Form Validation</li>-->
<!--</ol>-->


<!--<h1 class="page-header">Form <small></small></h1>-->


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
<h4 class="panel-title">Manage Fee Component</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

        <div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('masters/search_subjects_list')?>">
<div class="form-group row mb-3">
<label class="col-lg-1 col-form-label form-label" for="reference_name">Class : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<?php
$db = \Config\Database::connect();
$class_query = $db->query("SELECT * FROM class");
?>
<select class="form-control" name="class" required>
    <option value="">--Program--</option>
    <?php
foreach ($class_query->getResult() as $row) {
    ?>
    <option value="<?=$row->class_id;?>"><?=$row->class;?></option>
    <?php
}
    ?>
</select>
</div>
<div class="col-lg-2">
<button type="submit" class="btn btn-primary">Search</button>
<button type="reset" class="btn btn-danger">Cancel</button>

</div>
</div>

</form>

</div>



<div class="hljs-wrapper">
<pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
</div>

</div>

</div>


<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-2">

<div class="panel-heading">
<h4 class="panel-title">List</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body" id="dvContents">
<?php
if($no_search_subjects_list == "no"){
    echo"Sorry no records found...";
}else{
?>

<table width="100%" class="table table-bordered" id="example">
					<thead>
					    <tr>
							<td ><span class="style5"><b>Sr.&nbsp;No.</b></span></td>
							<td ><span class="style5"><b>Class</b></span></td>
						<td ><span class="style5"><b>Subject</b></span></td>
						<td ><span class="style5"><b>Group</b></span></td>
						<td ><span class="style5"><b>Description</b></span></td>
                            <td ><span class="style5"><b>Action</b></span></td>
							
						</tr>
					</thead>
					<tbody>
						
						<?php
        $count = 0;
        foreach ($subjects_list  as $row) :
$count++;

        $class = $row['class'];
        $query = $db->query("SELECT * FROM class WHERE class_id = '$class'");
        $sn = 1;
        foreach ($query->getResult() as $row1) {
            $class_name = $row1->class;
        }
            ?>
						
						<tr>
						    
						    <td ><span class="style5" ><?php echo $count;?></span></td>
							<td  ><?=$class_name;?></td>
							<td  ><?=$row['subject'];?></td>
							<td  ><?=$row['subject_group'];?></td>
							<td  ><?=$row['discription'];?></td>
							<td>
                            <a title="Edit" href="<?=base_url();?>masters/edit_subjects_list/<?=$row['subject_id'];?>" style="margin-right: 5px;">
                              <span class="fa fa-edit fw-fa text-success"></span>
                              </a>
                             
                              <a title="Remove" href="<?=base_url();?>masters/delete_subjects_list/<?=$row['subject_id'];?>"  
                              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
                              >
                              <img src="<?=base_url();?>public/record_drop.png" height="12" width="12">
                              </a>
                        </td>
						</tr>
					

<?php endforeach; ?>	
</tbody>	
</table>
<?php
}
?>
<!--<button class="btn btn-warning" onclick="print();">Print</button>-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 24;
  for (var i = 0; i < 25; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

function print(){
    var printWindow = window.open('', '', 'height=200,width=400');
        //Print the DIV contents i.e. the HTML Table.
        var divContents = document.getElementById("example").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.close();
        printWindow.print();
}
</script>
<?= $this->endSection() ?>