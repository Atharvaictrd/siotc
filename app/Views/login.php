<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from seantheme.com/color-admin/admin/html/login_v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2023 07:52:59 GMT -->
<head>
<meta charset="utf-8" />
<title>Eduwings | Login</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content name="description" />
<meta content name="author" />
<!--<link rel="shortcut icon" href="<?=base_url();?>assets/img/bg_r.png">-->
<link
    rel="icon"
    type="image/png"
    href="https://sconw.eduwings.in/assets/eduwings-favicon.png"
>
<link href="<?= base_url('assets/css/vendor.min.css'); ?>" rel="stylesheet" />
<link href="<?= base_url('assets/css/default/app.min.css'); ?>" rel="stylesheet" />

</head>
<body class="pace-top">

<div id="loader" class="app-loader">
<span class="spinner"></span>
</div>


<div id="app" class="app">

<div class="login login-v2 fw-bold" >

<div class="login-cover">
<div class="login-cover-img" style="background-image: url(<?= base_url('/assets/banner1.jpg'); ?>)" data-id="login-cover-image"></div>
<div class="login-cover-bg"></div>
</div>

<!-- Version (bottom right of page) -->
<div style="position:fixed;bottom:22px;right:40px;z-index:1000;color:#ffffff;font-size:16px;font-weight:bold;text-shadow:0 1px 3px rgba(0,0,0,0.6);">
Version : v.1.07
</div>

<div class="login-container" style="background:#ffffff;padding:20px;border-top: 5px solid #348fe2;border-radius: 5px;">
<!-- Eduwings Logo (top center of page) -->
<div style="text-align:center;">
    <img src="https://eduwings.in/assets/Eduwings_new.png" alt="Eduwings" style="max-height:70px;max-width:100%;">
</div>
<hr style="border:0;border-top:2px solid #000;opacity:1;margin:10px 0;">
<div class="login-header">
<div class="brand">
<div class="d-flex align-items-center">
<span class=""><img src="<?= base_url('/assets/img/somya_tech_logo.png'); ?>"  width="100%">
<!--</span>&nbsp; <b>SOMAYYA</b><small> <span style="color:white;">AYURVED MEDICAL COLLEGE & HOSPITAL,</span></small>-->
</div>
<h3 style="color:black;text-align:center;">Eduwings Admin</h3>
</div>

</div>


<div class="login-content">
<form action="<?=base_url(route_to('admin.loginsubmit'))?>" class="form-horizontal form-material" method="post" id="loginform" >
                       

                        <!--?php if (isset($_SESSION['success'])) : ?>-->
                        <!--    <div class="alert alert-success my-5">-->
                        <!--        <h5>?=$_SESSION['success'];?></h5>-->
                        <!--    </div>-->
                        <!--?php endif; ?>-->

                        <?php if (isset($error['username'])) : ?>
                        <div class="alert alert-danger">
                    <?= $error['username'] ;?>
                  </div>
                            <!--<span class="text-danger1">?= $error['username'] ;?></span>-->
                        <?php endif; ?>
                        <?php if (isset($error['password'])) : ?>
                        <div class="alert alert-danger">
                    <?= $error['password']; ?>
                  </div>
                            <!--<span class="text-danger">?= $error['password']; ?></span>-->
                        <?php endif; ?>
                        
                        
<div class=" mb-20px">
    <!--<label for="emailAddress"  >Username</label>-->
<input type="text" class="form-control fs-13px h-45px" id="emailAddress" name="username" placeholder="User name" style="color:black"/>

</div>
<div class=" mb-20px">
<input type="password" class="form-control fs-13px h-45px" id="password" name="password" placeholder="Password" />
<!--<label for="password" class="d-flex align-items-center" >Password</label>-->
</div>
<div class="form-check mb-20px">
<select name="session" onchange="javascript:form_submit();" id="dropdownYear" class="form-control fs-13px h-45px" style="margin-left:-25px;width: 360px;">
        
</select>
   <!--<label for="emailAddress" class="d-flex align-items-center" >Username</label>      -->
</div>
<div class="login-buttons">
<button type="submit" class="btn btn-primary h-45px d-block w-100 btn-lg">Login</button>
</div>
</form>
</div>

</div>

</div>

<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>



<script src="<?= base_url('assets/js/vendor.min.js'); ?>" type="a803a47b0b0d49d52217f80b-text/javascript"></script>
<script src="<?= base_url('assets/js/app.min.js'); ?>" type="a803a47b0b0d49d52217f80b-text/javascript"></script>



<script src="<?= base_url('ssets/js/demo/login-v2.demo.js'); ?>" type="91dfb791dd4a38c3bd9c3e92-text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3" type="91dfb791dd4a38c3bd9c3e92-text/javascript"></script>
<script type="91dfb791dd4a38c3bd9c3e92-text/javascript">
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-Y3Q0VGQKY3');
		</script>
<script src="<?= base_url('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js'); ?>" data-cf-settings="a803a47b0b0d49d52217f80b-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"7fdaf234c90b68ef","version":"2023.8.0","r":1,"b":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}' crossorigin="anonymous"></script>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
     $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
</script>
</html>