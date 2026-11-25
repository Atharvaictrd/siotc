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
<h4 class="panel-title">Dailt Attendence Report</h4>
</div>
<div class="panel-body">
<table id="data-table-keytable" class="table table-striped table-bordered align-middle">
<thead>
<tr>



<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Daily Attendence Report</th>
<th class="text-nowrap">View</th>

</tr>
</thead>
<tbody>

<tr class="odd gradeX">
<td>1</td>
<td> Daily Attedence Report</td>
<td><a href="<?=base_url();?>stu_attendence_report/daily_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>2</td>
<td> Present Student Report</td>
<td><a href="<?=base_url();?>stu_attendence_report/present_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>3</td>
<td> Absent Student Report</td>
<td><a href="<?=base_url();?>stu_attendence_report/absent_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>4</td>
<td> Weekly Student Attendence Summary</td>
<td><a href="<?=base_url();?>stu_attendence_report/weekly_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>5</td>
<td> CONSOLIDATED ATTENDANCE REPORT BRANCHWISE</td>
<td><a href="<?=base_url();?>stu_attendence_report/branchwise_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>6</td>
<td>Monthly Student attedendence Summary</td>
<td><a href="<?=base_url();?>stu_attendence_report/monthly_report" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>7</td>
<td> 	Student Attendence Percentage (%)</td>
<td><a href="<?=base_url();?>stu_attendence_report/attendence_percentage" class="btn btn-xl btn-warning">View</a></td>
</tr>
<tr class="odd gradeX">
<td>8</td>
<td> 	Send SMS To Absent Student</td>
<td><a href="<?=base_url();?>stu_attendence_report/send_sms" class="btn btn-xl btn-warning">View</a></td>
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

