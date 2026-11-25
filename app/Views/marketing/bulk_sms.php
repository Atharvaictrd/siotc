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

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">BULK SMS</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form">
<div class="form-group row">
   <div class="col-xl-4"><b>Enquiry No</b></div>
    <div class="col-xl-4"><b>From Date</b></div>
  <div class="col-xl-4"><b>To Date</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-4"><input type="text" class="form-control" name="enquiry_no" id="enquiry_no">
        </div>
        <div class="col-xl-4"><input type="date" class="form-control" name="f_date" id="f_date">
        </div>
        <div class="col-xl-4"><input type="date" class="form-control" name="t_date" id="t_date">
        </div>
   
</div>
<br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn btn-primary">Cancel</button>
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

<div class="row">
<div class="col-xl-7">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">List</h4>
</div>

<div class="panel-body">
<table id="data-table-keytable" class="table table-striped table-bordered align-middle table-responsive">
<thead>
<tr>

        <th width="3%"></th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Contact No</th>

</tr>
</thead>
<tbody>

<tr class="odd gradeX">



<td></td>
<td></td>
<td></td>

</tr>

</tbody>
</table>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>
<div class="col-xl-5">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">SEND SMS</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form">
<div class="form-group row">
   <div class="col-xl-10"><b>Contact No</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-10"><input type="text" class="form-control" name="contact_no" id="contact_no">
        </div>
        </div>
        <div class="form-group row">
   <div class="col-xl-10"><b>Message</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-10"><textarea type="text" class="form-control" name="message" id="message"></textarea>
        </div>
        </div>
   
</div>
<br>
<div class="form-group row">
<div class="col-xl-8 offset-xl-2">
<button type="submit" class="btn btn-warning col-xl-8">Send</button>
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

</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>

</div>

<?= $this->endSection() ?>

