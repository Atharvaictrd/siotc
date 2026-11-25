<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<?php
 $db  = \Config\Database::connect();
$fee_search_key=array();


if(!empty($_POST['class'])){
$fee_search_key[]="class = '".($_POST['class'] ?? '')."'";
}


if(!empty($_POST['sem'])){
$fee_search_key[]="sem = '".($_POST['sem'] ?? '')."'";
}

if(!empty($_POST['session'])){
$fee_search_key[]="session = '".($_POST['session'] ?? '')."'";
}

if(!empty($_POST['category'])){
$fee_search_key[]="category = '".($_POST['category'] ?? '')."'";
}


if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}


if (!isset($key)) {
    $key = '';
}
if(isset($_POST['search'])){
    // echo "<script>alert('click')</script>";
 $stud_query = $db->query("SELECT * FROM `fees_to_program` $key");
}else{
    $session = $_SESSION['session_year'];
    $stud_query = $db->query("SELECT * FROM `fees_to_program` WHERE session='$session' ORDER BY fee_assign_id DESC");
}
?>


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
<!--<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="?= base_url('masters/search_fee_assign_to_program_list')?>">-->
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post">
<div class="form-group row mb-3">
<label class="col-lg-1 col-form-label form-label" for="reference_name">Class : </label>
<div class="col-lg-2">
<?php
$db = \Config\Database::connect();
$class_query = $db->query("SELECT * FROM class");
?>
<select class="form-control" name="class">
    <option value="">--Program--</option>
    <?php
foreach ($class_query->getResult() as $row) {
    ?>
    <option value="<?=$row->class;?>"><?=$row->class;?></option>
    <?php
}
    ?>
</select>
</div>

<label class="col-lg-1 col-form-label form-label" for="Semester">Year:  </label>
<div class="col-lg-2">
<?php
									
									 $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="sem"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) {
    

?>
            <option value="<?php echo $row2->program_sem;?>"><?php echo $row2->program_sem;?></option>
            <?php } ?></select>
</div>
<label class="col-lg-1 col-form-label form-label" for="Category">Section: </label>
<div class="col-lg-2">
<select name="section" id="section" class="form-control" >
           <option value="">Select</option>
      <option value="1">Section A</option>
    <option value="2">Section B</option>
      </select>
</div>
<label class="col-lg-1 col-form-label form-label" for="Category">Category: </label>
<div class="col-lg-2">
<select name="category" id="category" class="form-control" >
       
            <option value="<?php echo $c2;?>" selected><?php echo $c2;?></option>
         
            </select>
</div>
<label class="col-lg-1 col-form-label form-label mt-4" for="reference_name">Session :  </label>
<div class="col-lg-2 mt-4">
<select class="form-control" name="session"  id="dropdownYear">
<option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select>
</div>
</div>
<div class="form-group row mb-3">
<div class="col-lg-4"></div>
<div class="col-lg-2">
<button type="submit" class="btn btn-primary" name="search">Search</button>
<button type="reset" class="btn btn-danger">Cancel</button>

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


<table width="100%" class="table table-bordered" id="example">
    <center><b>Session Year : <?= $_SESSION['session_year']; ?></b></center>
					<thead>
					    <tr>
                            <td align="center"><span class="style5"><b>Action</b></span></td>
							<td align="center"><span class="style5"><b>Sr.&nbsp;No.</b></span></td>
							<td align="center"><span class="style5"><b>Class</b></span></td>
						<td align="center"><span class="style5"><b>Year</b></span></td>
						<td align="center"><span class="style5"><b>Category</b></span></td>
						<td align="center"><span class="style5"><b>Components</b></span></td>
						<td align="center"><span class="style5"><b>Gender</b></span></td>
							<td align="right">
							<span class="style5"><b>Amount</b></span></td>
						</tr>
					</thead>
					<tbody>
						
						<?php
        $count = 0;
        // foreach ($stud_query  as $row) :
             foreach ($stud_query->getResult() as $row) {
$count++;

        $fee_components_id = $row->fee_type;
        $query = $db->query("SELECT * FROM fee_components WHERE fee_component_id = '$fee_components_id'");
        $sn = 1;
        foreach ($query->getResult() as $row1) {
            $component = $row1->component;
        }
            ?>
						
						<tr>
						    <td align="center">
			<a title="Edit" href="<?=base_url();?>masters/edit_fee_program_list/<?=$row->fee_assign_id;?>" style="margin-right: 5px">
              <span class="fa fa-edit fw-fa" style="font-size: 1rem;color: #00acac;"></span>
              </a>
             
              <a title="Remove" href="<?=base_url();?>masters/delete_fee_assign_to_program_list/<?=$row->fee_assign_id;?>"  
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              >
              <span class="fa fa-trash fw-fa" style="    font-size: 1rem;
    color: red;"></span>
              </a></td>
						    <td align="center"><span class="style5" ><?php echo $count;?></span></td>
							<td  align="center"><?=$row->class;?></td>
							<td  align="center"><?=$row->sem;?></td>
							<td  align="center"><?=$row->category;?></td>
							<td  align="center"><?=$component;?></td>
							<td  align="center"><?=$row->gender;?></td>
							<td align="right"><?=$row->amount;?></td>
						</tr>
					

<?php } ?>	
</tbody>	
</table>

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
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
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




<?php 

// Check if delete button active, start this
      if(isset($_POST['delete']))
      {
          echo"<script>alert('gtgtygty yuygfbuyh')</script>";
        // $checkbox = $_POST['checkbox'];
        // for($i=0; $i<count($checkbox); $i++) {
        //   $del_id = $checkbox[$i];
        //   $sql = "DELETE FROM links WHERE link_id='$del_id'";
        //   $result = mysqli_query($sql);
        // }
        // // if successful redirect to delete_multiple.php 
        // if($result){
        //   echo '<meta http-equiv="refresh" content="0;URL=view_links.php">';
        // }
      }
?>

<script>
  $(document).ready(function(){  
			
			$('#section').change(function () {
			 // alert()
			    var val=$("#section").val();
			 //   alert(val);
			$.ajax({
            type: "POST",
            url: "<?= base_url('section')?>",
            data: { id: val},
            success : function(result)
            {
            //   alert(result);
    			//$('#item_modal').modal();
                $("#category").html(result);
    			//alert(result);
            }
            });
			});
  });
</script>
<?= $this->endSection() ?>