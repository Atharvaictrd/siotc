<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
// function enq_no()
// {
$db = \Config\Database::connect();

$enq_sql = $db->query("SELECT prospect_no FROM prospect_sales ORDER BY prospect_no ASC");
// 	echo "SELECT enquiry_no FROM marketing_enquiry ORDER BY enquiry_no DESC";
// 	$enq=tep_db_fetch_array($enq_sql);
foreach ($enq_sql->getResult() as $enq) {
}
echo $no = $enq->prospect_no + 1;
?>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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


    <div class="row">

        <div class="col-xl-12">

            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <div class="panel-heading">
                    <h3 class="panel-title">Prospectus Sales (Already Enquired)</h3>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>


                <div class="panel-body">
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success ">
                            <h5><?= $_SESSION['success']; ?></h5>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger ">
                            <h5><?= $_SESSION['error']; ?></h5>
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" data-parsley-validate="true" name="prospect_form" id="prospect_form" method="POST" action="<?= base_url('create_prospect_enquired') ?>">

                        <div class="form-group row">
                            <div class="col-xl-3"><b>Enquiry No. - Student Name</b></div>
                            <div class="col-xl-3"><b>Enquiry No</b></div>
                            <div class="col-xl-1"></div>
                            <div class="col-xl-3"><b>Prospectus No</b></div>
                            <div class="col-xl-2"><b>Date</b></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xl-3"> <select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
                                    <option>--Select--</option>
                                    <?php
                                    $db  = \Config\Database::connect();
                                    $query1 = $db->query("SELECT * FROM marketing_enquiry ORDER BY id ASC");
                                    foreach ($query1->getResult() as $row1) {
                                        $displayText = $row1->enquiry_no . " - " . $row1->gender . ". " . $row1->f_name . " " . $row1->l_name;
            
                                        echo '<option value="' . $row1->enquiry_no . '">' . $displayText . '</option>';
                                    }
                                    ?>
                                </select> </div>
                            <div class="col-xl-3"><input type="text" name="enquiry_no"  class="form-control" id="enquiry_no" readonly></div>
                            <div class="col-xl-1"><input type="button" name="search" class="btn btn-warning" id="search" value="search"></div>
                            <div class="col-xl-3"><input type="text" class="form-control prospectus_no" name="prospect_no" id="prospectus_no" required></div>
                            <div class="col-xl-2"><input type="date" name="date" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" required></div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-xl-3"><b>Student Name</b></div>
                            <div class="col-xl-3"><b>First Name</b></div>
                            <div class="col-xl-3"><b>Middle Name</b></div>
                            <div class="col-xl-3"><b>Last Name</b></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xl-3"><select class="form-control" name="student_gender" id="student_gender">
                                    <option value="">Select Here...</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                </select></div>
                            <div class="col-xl-3"><input type="text" name="student_first_name" class="form-control" id="f_name"></div>
                            <div class="col-xl-3"><input type="text" name="student_middle_name" class="form-control" id="m_name"></div>
                            <div class="col-xl-3"><input type="text" class="form-control" name="student_last_name" id="l_name"></div>
                        </div>
                        <br>
                        <div class="form-group row" style="margin-top: 1rem;margin-bottom: 1rem;">

                            <div class="col-md-1"><b>Gender: </b></div>
                            <div class="col-md-3"><select class="form-control" name="gender1" id="gender1">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select></div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xl-2"><b>Section</b></div>
                            <div class="col-xl-2"><b>Category</b></div>
                            <div class="col-xl-2"><b>Program</b></div>
                            <div class="col-xl-3"><b>Semester</b></div>
                            <div class="col-xl-3"><b>Session</b></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xl-2"><select name="section" id="section" class="form-control" required>
                                    <option value="">Select Section</option>
                                    <option value="1">Section A</option>
                                    <option value="2">Section B</option>
                                </select></div>
                            <div class="col-xl-2"><select name="category" id="category" class="form-control" required>

                                </select></div>
                            <div class="col-xl-2"><?php
                                                    $db      = \Config\Database::connect();
                                                    $query3 = $db->query("SELECT * FROM class ORDER BY class_id ");
                                                    // $query   = $builder->get(); 

                                                    ?>


                                <select name="class" class="form-control" id="class">

                                    <option value="">-----SELECT-----</option>
                                    <?php foreach ($query3->getResult() as $row3) {


                                    ?>
                                        <option value="<?php echo $row3->class_id; ?>"><?php echo $row3->class; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-3"><?php
                                                    $db      = \Config\Database::connect();
                                                    $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ");
                                                    // $query   = $builder->get(); 

                                                    ?>


                                <select name="semister" class="form-control" id="semister">

                                    <option value="">-----SELECT-----</option>
                                    <?php foreach ($query2->getResult() as $row2) {


                                    ?>
                                        <option value="<?php echo $row2->program_sem; ?>"><?php echo $row2->program_sem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-3"><select name="session" onchange="javascript:form_submit();" id="dropdownYear" class=" form-control">
                                    <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
                                </select></div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-xl-3"><b>Contact No</b></div>
                            <div class="col-xl-3"><b>Prospectus Amount</b></div>
                            <div class="col-xl-3"><b>Medium</b></div>
                            <div class="col-xl-3"><b>Percentage</b></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xl-3"><input type="text" class="form-control" name="contact_no" id="contact_no"></div>
                            <div class="col-xl-3"><input type="text" class="form-control" name="amount" id="prospectus_amt" placeholder="Rs." required></div>
                            <div class="col-xl-3"><select name="medium" id="medium" class="form-control">
                                    <option value="" selected="">--Medium--</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="English">English</option>
                                    <option value="Marathi">Marathi</option>
                                    <option value="Semi-English">Semi-English</option>
                                </select></div>
                            <div class="col-xl-2"><input type="text" class="form-control" name="percentage" id="percentage"></div>
                            <div class="col-xl-1" align="left">%</div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-xl-6"><b>Last School / College Attended</b></div>
                            <div class="col-xl-6"><b>Address</b></div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xl-6"><?php

                                                    $query8 = $db->query("SELECT * FROM last_school_attended ORDER BY s_id ");
                                                    // $query   = $builder->get(); 

                                                    ?><select name="last_school_attended" id="last_school_attended" class="form-control">
                                    <?php foreach ($query8->getResult() as $row8) {


                                    ?>
                                        <option value="<?php echo $row8->s_id; ?>"><?php echo $row8->school_name; ?></option>
                                    <?php } ?>
                                </select></div>
                            <div class="col-xl-6"><textarea type="text" class="form-control" name="address" id="address" style="height:35px;"></textarea></div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary col-xl-3">Submit</button>
                                <button type="reset" class="btn btn-danger col-xl-3">Cancel</button>
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
                <h4 class="panel-title" id="heading_title">Prospectus Sales List (Already Enquired)</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" data-parsley-validate="true" name="report_form" id="report_form" method="post" action="<?= base_url('prospectus_enquired'); ?>">
                    <div class="form-group row">
                        <div class="col-xl-6"><b>From Date</b></div>
                        <div class="col-xl-6"><b>To Date</b></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-6"><input type="date" class="form-control" name="f_date" id="f_date"></div>
                        <div class="col-xl-6"><input type="date" class="form-control" name="t_date" id="t_date"></div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-xl-3"><b>Category</b></div>
                        <div class="col-xl-3"><b>Program</b></div>
                        <div class="col-xl-3"><b>Semester</b></div>
                        <div class="col-xl-3"><b>Session</b></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-3"><select name="category" id="category" class="form-control">
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
                        <div class="col-xl-3"><?php
                                                $db      = \Config\Database::connect();
                                                $query3 = $db->query("SELECT * FROM class ORDER BY class_id ");
                                                // $query   = $builder->get(); 

                                                ?>


                            <select name="class" class="form-control" id="class">

                                <option value="">-----SELECT-----</option>
                                <?php foreach ($query3->getResult() as $row3) {


                                ?>
                                    <option value="<?php echo $row3->class_id; ?>"><?php echo $row3->class; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xl-3"> <select name="semister" class="form-control" id="semister">

                                <option value="">-----SELECT-----</option>
                                <?php foreach ($query2->getResult() as $row2) {


                                ?>
                                    <option value="<?php echo $row2->program_sem; ?>"><?php echo $row2->program_sem; ?></option>
                                <?php } ?>
                            </select></div>
                        <div class="col-xl-3"><select name="session" onchange="javascript:form_submit();" id="dropdownYear1" class=" form-control">
                                <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
                            </select></div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-warning col-xl-4">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
                    <thead>
                        <tr>


                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">Prospectus No</th>
                            <th class="text-nowrap">Student Name</th>
                            <th class="text-nowrap">Program</th>
                            <th class="text-nowrap">Semester</th>
                            <th class="text-nowrap">Contact No</th>
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $count = 0;
                        foreach ($source  as $fees_collection) {
                            $count++;
                        ?>
                            <tr bgcolor="<?php echo ($count % 2 == 0) ? '#ffffff' : '#ffffff'; ?>">

                                <td><?php echo $fees_collection['date']; ?></td>
                                <td><?php echo $fees_collection['prospect_no']; ?></td>
                                <td style="white-space:nowrap;"><span style="white-space:nowrap;text-transform:uppercase;"><?php echo $fees_collection['student_gender'] . '.' . $fees_collection['student_first_name'] . ' ' . $fees_collection['student_middle_name'] . ' ' . $fees_collection['student_last_name'] ?></span></td>
                                <?php $query6 = $db->query("SELECT * FROM class WHERE class_id='" . $fees_collection['class'] . "' ");
                                foreach ($query6->getResult() as $row6) {
                                } ?>
                                <td style="white-space:nowrap;"><?php echo $row6->class; ?></td>
                                <td style="white-space:nowrap;"><?php echo $fees_collection['semister']; ?></td>
                                <td style="white-space:nowrap;"><?php echo $fees_collection['contact_no'] ?></td>
                                <td><?php echo $fees_collection['category'] ?></td>

                                <td style="white-space:nowrap;">
                                    <!--<a href="id=<?php echo $fees_collection['prospect_id']; ?>" ><i class="fa fa-pen-to-square" style="color:blue;font-size:20px;"></i></a> /-->
                                    <a href="delete_prospect_enquired?id=<?php echo $fees_collection['prospect_id']; ?>" onclick="return confirm('Are you sure you want to reset this data?');"><i class="fa fa-trash-can" style="color:red;font-size:20px;"></i></a>
                                </td>
                            </tr>
                        <?php      } ?>

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

<script>
    function myFunction() {
        var x = document.getElementById("search_enquiry_name").value;
        $('#enquiry_no').val(x);
        $('#search').click();
        //  $('.prospectus_no').show();
        //   getObject('enquiry_no').value = x.value;
    }

    function myFunction1() {
        //   var x = document.getElementById("enquiry_no").value ;
        //  $('#enquiry_no').val(x);
        //  $('.prospectus_no').show();
        //   getObject('enquiry_no').value = x.value;
    }

    $(document).ready(function(e) {

        $(document).on('click', '#search', function() {
            var enquiry_no = $('#enquiry_no').val();
            if (enquiry_no != '') {

                $.ajax({

                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "<?= base_url('search_enquiry_pro') ?>",
                    data: JSON.stringify({
                        enquiry_no: enquiry_no
                    }),
                    cache: false,
                    success: function(data) {
                        var data = JSON.parse(data);
                        //   alert(data.class);
                        $('#prospectus_no').show();
                        $('#f_name').val(data.user.f_name);
                        $('#m_name').val(data.user.m_name);
                        $('#l_name').val(data.user.l_name);
                        $('#section').val(data.user.section);
                        $('#category').html('<option value=' + data.user.category + '>' + data.user.category + '</option>');
                        $('#class').val(data.user.class);
                        $('#semister').val(data.user.semister);
                        $('#session').val(data.user.session);
                        $('#contact_no').val(data.user.contact_no);
                        $('#last_school_attended').val(data.user.last_school_attended);
                        $('#medium').val(data.user.medium);
                        $('#percentage').val(data.user.percentage);
                        $('#address').val(data.user.address);
                        $('#student_gender').val(data.user.gender);
                        $('#gender1').html('<option value=' + data.user.gender1 + '>' + data.user.gender1 + '</option>');
                    }
                });
            } else {
                alert('Please enter Enquired Student Name OR Enquiry No');
            }
        });

    });
</script>



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


<script>
    $('#dropdownYear').each(function() {

        var year = (new Date()).getFullYear();
        var current = year;
        year -= 4;
        for (var i = 0; i < 10; i++) {
            if ((year + i) == current)
                $(this).append('<option  value="' + (year + i) + '-' + (year + 1 + i) + '">' + (year + i) + ' - ' + (year + 1 + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '-' + (year + 1 + i) + '">' + (year + i) + ' - ' + (year + 1 + i) + '</option>');
        }

    })
    $('#dropdownYear1').each(function() {

        var year = (new Date()).getFullYear();
        var current = year;
        year -= 4;
        for (var i = 0; i < 10; i++) {
            if ((year + i) == current)
                $(this).append('<option  value="' + (year + i) + '-' + (year + 1 + i) + '">' + (year + i) + ' - ' + (year + 1 + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '-' + (year + 1 + i) + '">' + (year + i) + ' - ' + (year + 1 + i) + '</option>');
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

    function select_student_detail(id) {
        //reg_no
        getObject('enquiry_no').value = id.value;
    }
</script>

<script>
    function refreshEnquiryNo() {
        $.get("<?= base_url('Home/getNextProsNo'); ?>", function(data) {
            $("#prospectus_no").val(data);
            // console.log("Next pros No: " + data);
        });
    }

    // Page load pe ek baar call karo
    refreshEnquiryNo();

    // Ab har 1 second me auto refresh karega
    setInterval(refreshEnquiryNo, 1000);
</script>
<?= $this->endSection() ?>