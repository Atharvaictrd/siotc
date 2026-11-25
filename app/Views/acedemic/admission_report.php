<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>


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

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Admission Report</h4>
</div>
<div class="panel-body">
<table id="data-table-keytable" class="table table-striped table-bordered align-middle">
<thead>
<tr>



<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Report</th>
<th class="text-nowrap">View</th>

</tr>
</thead>
<tbody>

<tr class="odd gradeX">
<td>1</td>
<td> Section Wise Admission Report</td>
<td><a href="<?=base_url();?>report_section" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>2</td>
<td>CATEGORIWISE STRENGTH REPORT BRANCHWISE</td>
<td><a href="<?=base_url();?>report_category" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>3</td>
<td> General Admission register</td>
<td><a href="<?=base_url();?>report_register" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>4</td>
<td>Student Details Admission type wise</td>
<td><a href="<?=base_url();?>report_admission_type" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>5</td>
<td> Student details</td>
<td><a href="<?=base_url();?>report_student" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>6</td>
<td>Admission Report --(Program + Semister + Category)</td>
<td><a href="<?=base_url();?>report_admission_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>7</td>
<td> 	List of admitted students according to last exam</td>
<td><a href="<?=base_url();?>report_last_exam" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>8</td>
<td> 	List of admitted students according to last school attended</td>
<td><a href="<?=base_url();?>report_last_school" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>9</td>
<td> List of admitted students according to medium of last</td>
<td><a href="<?=base_url();?>report_medium" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>10</td>
<td> 	List of admitted students according to mscit institute attended</td>
<td><a href="<?=base_url();?>report_institute" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>11</td>
<td>List of admitted students according to percentage</td>
<td><a href="<?=base_url();?>report_percentage" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>12</td>
<td> List of admitted students according to sports achievements</td>
<td><a href="<?=base_url();?>report_sports_achievement" class="btn btn-xl btn-warning">View</a></td>
</tr>
<!--<tr class="odd gradeX">-->
<!--<td>13</td>-->
<!--<td> 	Custom Report</td>-->
<!--<td><a href="<?=base_url();?>report_custom" class="btn btn-xl btn-warning">View</a></td>-->
<!--</tr>-->
<tr class="odd gradeX">
<td>13</td>
<td> 	List of admitted students according to Area</td>
<td><a href="<?=base_url();?>report_area" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>14</td>
<td> 	List of admitted student who purchase prospectus</td>
<td><a href="<?=base_url();?>list_purchase_prospectus" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>15</td>
<td> List of not admitted students who purchase prospectus</td>
<td><a href="<?=base_url();?>list_not_purchase_prospectus" class="btn btn-xl btn-warning">View</a></td>
</tr>
</tbody>
</table>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div></div>

</div>

</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>



<?= $this->endSection() ?>

