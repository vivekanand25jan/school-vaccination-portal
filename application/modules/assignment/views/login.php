<html>
<title>Login</title>
<head>
  <script src="<?php echo BASE_INCLUDES;?>dist/js/jquery.slim.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/bootstrap.min.css">  
  <script src="<?php echo BASE_INCLUDES;?>dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/all.css">
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/login.css">
  <style type="text/css">
  body {
        background: #021858;
      }
    .btn-primary {
      color: #fff;
      background-color: #8e173b;
      border-color: #8e173b;
    }
    .btn-primary:hover {
      color: #fff;
      background-color: #021858;
      border-color: #021858;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <center><img src="<?php echo BASE_INCLUDES;?><?php echo LOGO_SIGN;?>"/></center>
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="post" action="<?php echo BASE_URL;?>admin/checkLogin">
              <div class="form-label-group">
                <?php echo form_error('username'); ?>
                <input type="text" id="inputEmail" name="username" value="<?php echo set_value('username');?>" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address OR User Name</label>
              </div>

              <div class="form-label-group">
                <?php echo form_error('userpassword'); ?>
                <input type="password" id="inputPassword" name="userpassword" value="" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <!-- <hr class="my-4"> -->
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>