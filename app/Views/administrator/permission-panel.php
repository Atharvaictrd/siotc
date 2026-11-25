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
</style>



<div class="col-xl-12">
<?php
if (!empty(session()->getFlashdata('select_fail'))) : ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= session()->getFlashdata('select_fail'); ?>
    </div>
<?php
endif
?>
<?php
if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php
endif
?>
<div class="panel panel-inverse">

<div class="panel-heading">

<h4>User Panel List</h4>
</div>

<div class="panel-body">
   <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    

.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    border-top-width: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
}

.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.hovercard {
    box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    /*background-color: rgba(214, 224, 226, 0.2);*/
}

.card.hovercard .cardheader {
    background: url("https://siotc.eduwings.in/assets/banner1.jpg");
    background-size: cover;
    height: 135px;
    filter: brightness(50%);
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 13px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
        background: #f3f6f9;
    padding: 15px;
    /*margin-bottom: 17px;*/
}

.btn{ border-radius: 50%; width:35px; height:35px; line-height:18px;margin-right:1rem;  }
.rirhtpadding {
    padding-right: 15px;
}
.fa-edit{
    font-size: 15px;
    position: relative;
    top: 4px;
}
.fa-trash{
    font-size: 15px;
    position: relative;
    top: 4px;
}
.fa-check-circle {
    color: #3CBA2E;
    font-size: 1rem;
}
.fa-times-circle {
    color: #F03;
    font-size: 1rem;
}
</style>
<div class="container">
	<div class="row">
	    <?php
$db = \Config\Database::connect();
$query = $db->query("SELECT * FROM user ORDER BY user_id DESC");
$sn = 1;
foreach ($query->getResult() as $row) {
?>
		<div class="col-lg-4 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="https://siotc.eduwings.in/assets/img/somya_tech_logo1.png">
                </div>
                <div class="info">
                    <div class="title">
                        <a href="">
                            <?php
                        if($row->usertype==''){
                            echo 'User';
                        }else{
                            echo $row->usertype;
                        }
                        ?>
                       </a>
                    </div>
                    <div class="desc">Username : <?=$row->user_name;?></div>
                    <div class="desc">Password : <?=$row->password;?></div>
                    <div class="desc"><h5>Assign Permissions</h5></div>
                    
                    <div class="row">
                    <?php
                    if($row->user_id=='1'){
                    ?>
                        <center>
                            <table>
                                <tr>
                                    <td><span class="rirhtpadding "><i class="fa  fa-check-circle"></i></span></td>
                                    <td>Admission</td>
                                </tr>
                                <tr>
                                    <td><span class="rirhtpadding "><i class="fa  fa-check-circle"></i></span></td>
                                    <td>Fees</td>
                                </tr>
                                <tr>
                                    <td><span class="rirhtpadding "><i class="fa  fa-check-circle"></i></span></td>
                                    <td>Certificates</td>
                                </tr>
                                <tr>
                                    <td><span class="rirhtpadding "><i class="fa  fa-check-circle"></i></span></td>
                                    <td>User Management</td>
                                </tr>
                                <tr>
                                    <td><span class="rirhtpadding "><i class="fa  fa-check-circle"></i></span></td>
                                    <td>Administrator</td>
                                </tr>
                            </table>
                        </center>
                        
                    <?php
                    }else{
                        $query1 = $db->query("SELECT * FROM user_perm WHERE user_id='$row->user_id'");
                        $row1 = $query1->getRow();
                        $admission = $row1->ADMISSION;
                        $fees = $row1->FEES;
                        $certificates = $row1->CERTIFICATES;
                        $user_manage = $row1->USER_MANAGEMENT;
                        $administrator = $row1->ADMINISTRATOR;
    
                        ?>
                        <center>
                            <table>
                                <tr>
                                    <td>
                                        <span class="rirhtpadding ">
                                            <?php if($admission == '1'){ ?> 
                                                <i class="fa  fa-check-circle"></i>
                                            <?php }else{ ?>
                                                <i class="fa  fa-times-circle"></i>
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>Admission</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="rirhtpadding ">
                                            <?php if($fees == '1'){ ?> 
                                                <i class="fa  fa-check-circle"></i>
                                            <?php }else{ ?>
                                                <i class="fa  fa-times-circle"></i>
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>Fees</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="rirhtpadding ">
                                            <?php if($certificates == '1'){ ?> 
                                                <i class="fa  fa-check-circle"></i>
                                            <?php }else{ ?>
                                                <i class="fa  fa-times-circle"></i>
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>Certificates</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="rirhtpadding ">
                                            <?php if($user_manage == '1'){ ?> 
                                                <i class="fa  fa-check-circle"></i>
                                            <?php }else{ ?>
                                                <i class="fa  fa-times-circle"></i>
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>User Management</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="rirhtpadding ">
                                            <?php if($administrator == '1'){ ?> 
                                                <i class="fa  fa-check-circle"></i>
                                            <?php }else{ ?>
                                                <i class="fa  fa-times-circle"></i>
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>Administrator</td>
                                </tr>
                            </table>
                        </center>
                        <?php
                    }
                    ?>
                    </div>
                 </div>
                <div class="bottom">
                    <a class="btn btn-success btn-twitter btn-sm" href="<?=base_url();?>edit_user/<?=$row->user_id;?>">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" rel="publisher" href="<?=base_url();?>delete_user/<?=$row->user_id;?>" onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" >
                        <i class="fa fa-trash"></i>
                    </a>
                    <!--<a class="btn btn-primary btn-sm" rel="publisher"-->
                    <!--   href="">-->
                    <!--    <i class="fa fa-facebook"></i>-->
                    <!--</a>-->
                    <!--<a class="btn btn-warning btn-sm" rel="publisher" href="">-->
                    <!--    <i class="fa fa-behance"></i>-->
                    <!--</a>-->
                </div>
            </div>

        </div>
        <?php
}
        ?>
	</div>
</div>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

</div>

</div>
<script>
  var currentTab = 0;
  showTab(currentTab);

  function showTab(n) {
    var tabs = document.getElementsByClassName("tab");
    tabs[n].classList.add("active");
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (tabs.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // Show only the current tab
    for (var i = 0; i < tabs.length; i++) {
      if (i !== n) {
        tabs[i].classList.remove("active");
      }
    }
  }

  function nextStep() {
    var tabs = document.getElementsByClassName("tab");
    if (currentTab >= tabs.length - 1) {
      document.getElementById("wizardForm").submit();
      return false;
    }
    if (!validateForm()) return false;
    currentTab++;
    showTab(currentTab);
  }

  function prevStep() {
    if (currentTab <= 0) {
      return false;
    }
    currentTab--;
    showTab(currentTab);
  }

  function validateForm() {
    var tabs = document.getElementsByClassName("tab");
    var inputs = tabs[currentTab].getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value == "") {
        alert("Please fill in all fields.");
        return false;
      }
    }
    return true;
  }

  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
    currentTab = Array.prototype.indexOf.call(document.getElementsByClassName("tab"), document.getElementById(tabName));
  }
</script>


<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>


<script src="assets/js/vendor.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/app.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>


<?= $this->endSection() ?>

