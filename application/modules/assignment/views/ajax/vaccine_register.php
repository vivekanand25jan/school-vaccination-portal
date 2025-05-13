<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header" style="float: rights;">
                
             <h3 class="box-title">Vactination Registration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body registerBox">
             
<table id="example3" class="table table-bordered table-striped">
  <tr><th>Student Name</th></tr>
    <tr>
      <td>
        <?php echo $rec[0]['student_first_name'].' '.$rec[0]['student_last_name'];?>
      </td>
    </tr>
  </table>
  <table id="example4" class="table table-bordered table-striped">
  <tr><th>Vaccination Request</th><th>Drive Name</th><th>Drive Date</th><th>vaccine Name</th><th>Dose Left</th></tr>
  <?php
    if($error == false){ 
    foreach($rec as $k=>$v){
  ?>
    <tr>
      <td><button type="button" class="btn btn-primary btn-sm btnRegisterVaccination" data-val="<?php echo $v['driveId'];?>" data-stdId="<?php echo $v['studentId'];?>" data-vacId="<?php echo $v['vaccineId'];?>">Add Request</button></td>
      <td>
        <?php echo $v['drive_name'];?>
      </td>
      <td>
        <?php echo $v['drive_start_date'];?>
      </td>
      <td>
        <?php echo $v['vaccine_name'];?>
      </td>
      <td>
      <?php echo $v['totalCount'];?>
      </td>
    </tr>
    <?php } }else{ ?>
      <tr><td colspan="5"><h3>There is not any vaccinetion drive started for you!</h3></td></tr>
   <?php } ?>
  </table><br/><br/>

 
                
                </div>
    
              </div>
            </div>
          </div>
  