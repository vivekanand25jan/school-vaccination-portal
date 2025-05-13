<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add student</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">



  <?php $this->load->view('headers'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('menu'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add User
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Add Student</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> Add Student</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="addAgency" enctype="multipart/form-data" method="post" id="addStudent" action="<?php echo BASE_URL;?>students/addStudentAction">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <?php echo form_error('FirstName'); ?>
                  <input type="text"  name="FirstName" class="form-control is_required" id="FirstName" value="<?php echo set_value('FirstName'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <?php echo form_error('LastName'); ?>
                  <input type="text"  name="LastName" class="form-control is_required" id="LastName" value="<?php echo set_value('LastName'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Roll</label>
                  <?php echo form_error('roll'); ?>
                  <input type="text"  name="roll" class="form-control is_required" id="roll" value="<?php echo set_value('roll'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <?php echo form_error('useremail'); ?>
                  <input type="email"  name="useremail" class="form-control is_required" value="<?php echo set_value('useremail'); ?>" id="useremail">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Class</label>
                  <?php echo form_error('studentClass'); ?>
                  <select name="studentClass" id="studentClass" class="form-control">
                    <option value="">--Select--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <?php echo form_error('userGender'); ?>
                  <select name="userGender" id="userGender" class="form-control">
                    <option value="">--Select--</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

      

       

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
      </div>
      <!-- /.row -->
    </section>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?php echo VERSION;?>
    </div>
    <strong>Copyright &copy; <?php echo MFG_YEAR;?> <a href="<?php echo COMP_URL;?>"><?php echo FOOTER_NAME;?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_INCLUDES;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_INCLUDES;?>dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
        $(".btn").click(function(){
          var i=0;
              $(".is_required").each(function(){ 
                var vals = $(this).val();
                if(vals==""){
                  $(this).css('border','1px solid red');
                  i++;
                }else{
                  $(this).css('border','1px solid gray');
                  if(i>0){
                    i--;
                  }
                }

                if(i==0){
                  return false;
                }else{
                  return void(0);
                }
            });
        });
  });
</script>
</body>
</html>
