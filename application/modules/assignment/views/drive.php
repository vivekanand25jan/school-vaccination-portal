<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Drive::Home</title>
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
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo BASE_INCLUDES;?>dist/css/skins/_all-skins.min.css">

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

  

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  
  <?php $this->load->view('headers'); ?>

  <!-- =============================================== -->
  <?php $this->load->view('menu'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Drive List
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Drive</a></li>
        <li class="active">Drive List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Drive List</h3>

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
        <div class="col-md-12">
          <div class="box">
            <div class="box-header" style="float: rights;">
                <button type="button" class="btn btn-primary btn-sm btnStudents">Add Drive</button>
             <!--  <h3 class="box-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Drive Name</th>
                  <th>Vaccine</th>
                  <th>Start Date</th>
                  <th>Class</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $k = 1;  
                    if(isset($defaultData) && $defaultData!='' ){
                     
                    foreach($defaultData as $key=>$val){
                      $disable = "";
                      $today = strtotime(date('d-m-Y'));
                      if($today > strtotime($val['drive_start_date'])) {$disable = 1; }
                      if($val['status'] == 1){
                        $stClass="glyphicon glyphicon-ok";
                        $stTitle = "Active";
                      }else{
                        $stClass="glyphicon glyphicon-remove";
                        $stTitle = "Diactive";
                      }
                  ?>
                <tr>
                  <td><?php echo $k;?></td>
                  <td><?php echo $val['drive_name'];?></td>
                  <td><?php echo $val['vaccine_name'];?></td>
                  <td><?php echo $val['drive_start_date'];?></td>
                  <td><?php echo $val['drive_for_class'];?></td>
                  <td><?php echo $stTitle;?></td>
                  <td><a href="<?php if($disable == "") { echo BASE_URL;?>drive/editDrive/<?php echo $val['driveId']; }else{ echo '#';}?>" title="<?php if($disable == 1) { echo 'driveExpired';}else{ echo 'Edit Details';}?>"><i class="glyphicon glyphicon-pencil <?php if($disable == 1) { echo 'driveExpired';}?>"></i></a> | <a href="<?php echo BASE_URL;?>drive/changeDriveStatus/<?php echo $val['driveId'];?>/<?php echo $val['status'];?>" title="<?php echo $stTitle;?>"><i class="<?php echo $stClass;?>" id="changeDriveStatus"></i></a> | <a href="<?php echo BASE_URL;?>drive/deleteDrive/<?php echo $val['driveId'];?>" title="Delete Record" id="deleteExclusive"><i class="glyphicon glyphicon-trash"></i></a></td>
                </tr>
                <?php $k++;} }else{?>
                <tr>
                  <td colspan="6"><center><b>No data available</b></center></td>
                </tr>
                <?php } ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

      

       

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

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_INCLUDES;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo BASE_INCLUDES;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_INCLUDES;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_INCLUDES;?>dist/js/demo.js"></script>
<script src="<?php echo BASE_INCLUDES;?>dist/js/main.js"></script>
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

      $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });

      $(".btnStudents").click(function(){
        window.location.assign("<?php echo BASE_URL;?>drive/addDriveRecord");
      });
  });
</script>
</body>
</html>
