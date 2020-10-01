<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Theatre Assistant| Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a>Theatre Assistant<b> &nbsp; Admin </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php session_start(); include('../msgbox.php');?>
    <p class="login-box-msg">Sign in to start your session</p>
<form action="pages/process_login.php" method="post">
      <div class="form-group has-feedback">
        <input name="Email" type="text" size="25" placeholder="Email" class="form-control" placeholder="Email"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="Password" type="password" size="25" placeholder="Password" class="form-control" placeholder="Password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
		  var email = document.myForm.email.value;
		  var pass = document.myForm.password.value;
    if( email == "" )
         {
            document.getElementById("email").innerHTML="Please Fill the username field";
            document.myForm.email.focus() ;
            return false;
         }
		 else{
			document.getElementById("email").innerHTML=""; 
		 }
		 if((email.length <= 5) || (email.length > 25) )
		 {
			document.getElementById("email").innerHTML="user length must be between 5 and 25";
            document.myForm.email.focus() ;
            return false;
		 }
		 else{
			document.getElementById("email").innerHTML=""; 
		 }
		 if(!isNaN(email))
		 {
			document.getElementById("email").innerHTML="Only character allowed";
            document.myForm.email.focus() ;
            return false;
		 }
		 else{
			document.getElementById("email").innerHTML=""; 
		 }
		 if(email.indexOf('@') <= 0)
		 {
			document.getElementById("email").innerHTML="@ Invalid Position ";
            document.myForm.email.focus() ;
            return false;
		 }
		 else{
			document.getElementById("email").innerHTML=""; 
		 }
		 if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.'))
		 {
			document.getElementById("email").innerHTML=". Invalid Position ";
            document.myForm.email.focus() ;
			 return false;
		 }
		 else
		 {
			 document.getElementById("email").innerHTML="";
		 }
		 
		if( pass == "" )
         {
            document.getElementById("password").innerHTML="Please Fill the password field";
            document.myForm.password.focus() ;
            return false;
         }
		 else{
			document.getElementById("password").innerHTML=""; 
		 }
		 if((pass.length <= 5) || (pass.length > 20) )
		 {
			document.getElementById("password").innerHTML="password length must be between 5 and 20";
            document.myForm.password.focus() ;
            return false;
		 }	
		else{
			document.getElementById("password").innerHTML=""; 
		 }
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
