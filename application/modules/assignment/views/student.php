<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student::Home</title>
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
        Students List
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Student List</li>
      </ol>
            
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Student List</h3>

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
                <button type="button" class="btn btn-primary btn-sm btnStudents">Add Students</button>
             <!--  <h3 class="box-title">Data Table With Full Features</h3> -->

            
             
            </div>
            
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Student Name</th>
                  <th>Vaccine Status</th>
                  <th>Class</th>
                  <th>Email</th>
                  <th>Roll</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $k = 1; 
                    if(isset($defaultData) && $defaultData!='' ){
                    foreach($defaultData as $key=>$val){ $totalCount = ($val['totalC'] > 0)?"Vaccineted":"Not Vaccineted";
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
                  <td><?php echo $val['student_first_name'].' '.$val['student_last_name'];?></td>
                  <td><?php echo $totalCount;?></td>
                  <td><?php echo $val['class'];?></td>
                  <td><?php echo $val['student_email'];?></td>
                  <td><?php echo $val['student_roll'];?></td>
                  <td><?php echo $stTitle;?></td>
                  <td><a href="<?php echo BASE_URL;?>students/editStudent/<?php echo $val['studentId'];?>" title="Edit Details"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="<?php echo BASE_URL;?>students/changeStudentStatus/<?php echo $val['studentId'];?>/<?php echo $val['status'];?>" title="<?php echo $stTitle;?>"><i class="<?php echo $stClass;?>" id="changeExclusiveStatus"></i></a> | <a href="<?php echo BASE_URL;?>students/deleteStudent/<?php echo $val['studentId'];?>" title="Delete Record" id="deleteExclusive"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;|&nbsp;<i class="glyphicon glyphicon-registration-mark studentr" style="cursor:pointer;color:blue;" data-sid="<?php echo $val['studentId'];?>" data-class="<?php echo $val['class'];?>"></i>&nbsp;|&nbsp;<i class="glyphicon glyphicon-list-alt studentListV" style="cursor:pointer;color:blue;" data-sid="<?php echo $val['studentId'];?>" data-class="<?php echo $val['class'];?>"></i></td> 
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

    <section class="content registerBox">
      
            <div class="box-body">
                Kindly select the student from above table
                
            </div>

          
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
        $('#example3').DataTable({
    });
        $('#example4').DataTable({
      'lengthChange': true
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
        window.location.assign("<?php echo BASE_URL;?>students/addStudentRecord");
      });

      $(".studentr").click(function(){
        let studentId = $(this).attr('data-sid');
        $(".registerBox").load("<?php echo BASE_URL;?>students/addRegisterPage/"+studentId);
      }); 

      $(".studentListV").click(function(){
        let studentId = $(this).attr('data-sid');
        $(".registerBox").load("<?php echo BASE_URL;?>students/getVaccineDoneList/"+studentId);
      }); 
      
      $(document).on("click",".btnRegisterVaccination",function(){
        let driveIds = $(this).attr('data-val');
        let stdIds = $(this).attr('data-stdId');
        let vacIds = $(this).attr('data-vacId');
        $.post( "<?php echo BASE_URL;?>students/registerForVaccination", { driveid: driveIds, stdid: stdIds, vacId: vacIds})
        .done(function( data ) {
          $(".registerBox").html(data);
        });
      }); 
  });
</script>
</body>
</html>
