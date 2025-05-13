<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header" style="float: rights;">
                
             <h3 class="box-title">Viaccination Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body registerBox">
             
  <table id="example4" class="table table-bordered table-striped">
  <tr><th>Drive Name</th><th>Drive Date</th><th>vaccine Name</th></tr>
  <?php
    if($error == false){ 
    foreach($rec as $k=>$v){
  ?>
    <tr>
      
      <td>
        <?php echo $v['drive_name'];?>
      </td>
      <td>
        <?php echo $v['drive_start_date'];?>
      </td>
      <td>
        <?php echo $v['vaccine_name'];?>
      </td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
      <tr><td colspan="5"><h3>There is no any vaccinetion done for you!</h3></td></tr>
   <?php } ?>
  </table><br/><br/>

 
                
                </div>
    
              </div>
            </div>
          </div>
  