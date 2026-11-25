<?= $this->extend('masters/layout1/tempmain') ?>
<?= $this->section('links') ?>
<?= $this->endSection('links') ?>
<?= $this->section('content') ?>
<style>
    .margin{
        margin-right: 10px;
    }
</style>
<div id="content" class="app-content">
    <?php
    $db  = \Config\Database::connect();
    $category_res = $db->query("SELECT * FROM student_category");
    if(isset($_POST['insert'])){
    	if(($_POST['class'] ?? '') ==''){
    			$error[] = 'Please Select Class.';
    	}
    	if(($_POST['sem'] ?? '')==''){
    		$error[] = 'Please Select sem.';
    	}
    
    	if(($_POST['session'] ?? '') == ''){
    			$error[] = 'Please Select Session.';
    	}
    	if(($_POST['category'] ?? '')==''){
    		$error[] = 'Please Select atleast one category.';
    	}
    	if(($_POST['session'] ?? '') == $_SESSION['session_year'] && ($_POST['class'] ?? '') !='' && ($_POST['sem'] ?? '') !='' && ($_POST['session'] ?? '') !=''  && ($_POST['category'] ?? '') !=''){
    	    if (!empty($_POST['category']) && is_array($_POST['category'])) {
    foreach (($_POST['category'] ?? '') as $cat) {
        for ($i = 1; $i <= ($_POST['count'] ?? ''); $i++) {
            $class   = ($_POST['class'] ?? '');
            $sem     = ($_POST['sem'] ?? '');
            $session = ($_POST['session'] ?? '');
            $component_id  = $_POST["component_id_" . $i];
            $perticular_rate = $_POST["perticular_rate_" . $i];
            $insert_by = $_SESSION['adminloggedname'];
            $insert_date = date('Y-m-d H:i:s');
            $insert_ip = $_SERVER['REMOTE_ADDR'];
            $gender = ($_POST['gender'] ?? '');

            // Check for duplicate
            $check = $db->query("SELECT * FROM fees_to_program 
                                 WHERE category='$cat' AND class='$class' 
                                 AND sem='$sem' AND session='$session' 
                                 AND fee_type='$component_id' AND gender='$gender'");
            if ($check->getNumRows() == 0) {
                $query = $db->query("INSERT INTO `fees_to_program`
                            (`class`, `sem`, `session`, `fee_type`, `amount`, `category`, `gender`, `insert_by`, `insert_date`, `insert_ip`) 
                            VALUES 
                            ('$class', '$sem', '$session', '$component_id', '$perticular_rate', '$cat', '$gender', '$insert_by', '$insert_date', '$insert_ip')");
            }
        }
    }
}

    		if($query){
    		    echo '<script language="javascript">alert("Fees Assign To Program successfully.");</script>';
    		    echo "<meta http-equiv='refresh' content='0'>";
    		}else{
    		    $error[] = 'Components already exists..';
    		}
    	}else{
    	   $error[] = 'Your academic year and slection session must be same. Please login again with the correct session';
    	}
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
            <?php if($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                foreach($error as $key => $val){
					echo "<li>".$val."</li>";
				}
                ?>
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
                <?php
                $db = \Config\Database::connect();
                $class_query = $db->query("SELECT * FROM class");
                $program_sem_query = $db->query("SELECT * FROM program_sem");
                $fees_to_program_query = $db->query("SELECT * FROM fees_to_program ORDER BY fee_assign_id DESC LIMIT 1");
                foreach ($fees_to_program_query->getResult() as $row) {}
                ?>
                <form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" >
                    <div class="panel-body">
                        <div class="form-group row mb-3">
                            <label class="col-lg-1 col-form-label form-label" for="reference_name">Class : <span class="text-danger">*</span> </label>
                            <div class="col-lg-2">
                                <select class="form-control" name="class" >
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
                            <label class="col-lg-1 col-form-label form-label" for="reference_name">Semester: <span class="text-danger">*</span> </label>
                            <div class="col-lg-2">
                                <select class="form-control" name="sem" >
                                    <option value="">Select Semester</option>
                                    <?php
                                    foreach ($program_sem_query->getResult() as $row) {
                                    ?>
                                    <option value="<?=$row->program_sem;?>"><?=$row->program_sem;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-1 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
                            <div class="col-lg-2">
                                <select class="form-control" name="session" id="dropdownYear" >
                                    <option value="">Select session</option>
                                    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
                                </select>
                            </div>
                            <label class="col-lg-1 col-form-label form-label" for="reference_name">Gender : </label>
                            <div class="col-lg-2">
                                <select class="form-control" name="gender"  >
                                    <option value="male">Male</option>
                                    <option value="female" >Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-1 col-form-label form-label" for="reference_name">Category : <span class="text-danger">*</span> </label>
                            <div class="col-lg-8" style="padding-top: calc(.4375rem + 1px);">
                                <?php
                                $count=0;
                                foreach ($category_res->getResult() as $category_row) {
                                    $count++;
                                	?>
                                	<input type="checkbox" name="category[]" value="<?=$category_row->category?>"/>
                                    <span class="margin"><?=$category_row->category?></span>
                                	<?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="panel-body">
                                <table width="100%" bgcolor="#efefef" class="table_color" border="1" cellspacing="2" cellpadding="2">
                                    <tr>
            							<td width="100px" align="center"><span class="style5"><b>Sr.&nbsp;No.</b></span></td>
            							<td width="300px" align="center"><span class="style5"><b>Particulars</b></span></td>
            							<td width="300px" align=""><span class="style5"><b>Session</b></span></td>
            							<td align="right"><span class="style5"><b>Amount Rs.</b></span></td>
        						    </tr>
        						    <tr>
                						<td colspan="4"><hr></td>
            						</tr>
            						<?php
            						$count=0;
            						$total_amount=0;
            				        $current_and_next_year = $_SESSION['session_year'];
            						$fee_row = $db->query("SELECT * FROM fee_components WHERE session = '$current_and_next_year'");
                                    foreach ($fee_row->getResult() as $fee_res) {
                                    $count++;
            						?>
            						<tr>
            						    <td align="center"><span class="style5" ><b><?php echo $count;?></b></span></td>
            							<td  align="center"><b><?=$fee_res->component;?></b>
                							<input type="hidden" name="component_id_<?=$count;?>"  style="text-align:right" value="<?=$fee_res->fee_component_id;?>">
                							<input type="hidden" name="component_name_<?=$count;?>"  style="text-align:right" value="<?=$fee_res->component;?>">
            							</td>
            							<td  align=""><b><?=$fee_res->session;?></b>
            							<td align="right">
                							<input type="text" name="perticular_rate_<?=$count;?>" id="perticular_rate_<?=$count;?>"  style="text-align:right" onkeyup="fee_sub_total(this);">
                						</td>
                						<input type="hidden" value="<?php echo $count; ?>" id="count" name="count" />
            						</tr>
                                    <?php
                                    }
                                    ?>
            						<tr>
            						    <td colspan="4"><hr></td>
            						</tr>
            						<tr>
            						    <td colspan="4" align="right">
            							    <b>Sub Total&nbsp;&nbsp;</b><input type="number" name="fees_sub_total" id="fees_sub_total" style="text-align:right" readonly > 
            							</td>
            						</tr>
            					</table>
                            </div>	
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary" name="insert">Insert</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#dropdownYear').each(function() {
        var year = (new Date()).getFullYear();
        var current = year;
        year -= 24;
        for (var i = 0; i < 25; i++) {
            if ((year+i) == current)
                $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
            else
                $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
        }
    });
    $('#dropdownYear1').each(function() {
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
</script>
<script>
    $(document).ready(function () {
        // Attach event listener for input changes
        $(document).on('input', "[id^='perticular_rate_']", function () {
            calculateSubtotal();
        });

        function calculateSubtotal() {
            var totalAmount = 0;

            // Iterate through all input fields with IDs starting with "perticular_rate_"
            $("[id^='perticular_rate_']").each(function () {
                var value = $(this).val(); // Get the value of the input
                if (!isNaN(value) && value.trim() !== "") { // Check if it's a valid number
                    totalAmount += parseInt(value); // Add to totalAmount
                }
            });

            // Update the subtotal field
            $('#fees_sub_total').val(totalAmount);
        }
    });
</script>
<?= $this->endSection() ?>