<?php
       include('include/connect.php');
       include('include/header.php');
       include('include/sidebar1.php')

       
       
        ?>
<div id="content-wrapper">

        
 <h2>List of Equipment(s)</h2> 
            <div class="card-body">
              <form method="post" action="temp_add.php">
<div class="row" style="min-height:400px">
           <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" class="form-control pull-right" name="qty"placeholder="Quantity" tabindex="2" value="1"  required>
              <label for="date">Select Equipment To Be Borrowed</label>
               
                <select class="form-control select2" name="equipname" tabindex="1" autofocus required>
                <?php
                   $query2=mysqli_query($db,"select * from equipments where status != 'UNAVAILABLE'")or die(mysqli_error());
                      while($row=mysqli_fetch_array($query2)){
                ?>
                    <option value="<?php echo $row['equip_id'];?>"><?php echo $row['name']." ".$row['uniquec']."" ;?></option>
                  <?php }?>
                </select>
              </div><!-- /.form group -->
          </div>
          <div class=" col-md-0">
            <div class="form-group">
              <div class="input-group">
              </div><!-- /.input group -->
            </div><!-- /.form group -->
           </div>
           <input type="hidden" class="form-control" value="<?php echo $_GET['emp_id']; ?>" name="emp">
           <input type="hidden" class="form-control" value="<?php echo $_GET['location_id']; ?>" name="loc">
           <input type="hidden" class="form-control" value="<?php echo $_GET['code']; ?>" name="code">
           <input type="hidden" class="form-control" value="<?php echo $_GET['due']; ?>" name="due">
          <div class="col-md-2">
            <div class="form-group">
              <label for="date"></label>
              <div class="input-group">
                <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="add">+</button>
              </div>
            </div> 
          </form> 
        </div>
        <div class=" col-md-2">
            <div class="form-group">
              <div class="input-group">
              </div><!-- /.input group -->
            </div><!-- /.form group -->
           </div>
     <div class="col-md-3">
      <?php
      $query4=mysqli_query($db,"select * from employees where emp_id ='".$_GET['emp_id']."'")or die(mysqli_error());
    $row4=mysqli_fetch_array($query4);
    ?>
            <div class="form-group">
              <h4>Assigned Employee:</h4> <h6 style="color: green"><?php echo $row4['name'];?></h6>
              </div>
            </div>
            <div class="col-md-3">
              <?php
      $query5=mysqli_query($db,"select * from location where location_id ='".$_GET['location_id']."'")or die(mysqli_error());
    $row5=mysqli_fetch_array($query5);
    ?>
            <div class="form-group">
              <h4>Location:</h4><h6 style="color: green"><?php echo $row5['location_address'];?></h6>
              </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
              <h4>Code:</h4><h6 style="color: green"><?php echo $_GET['code'];?></h6>
              </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
              <h4>Due Date:</h4><h6 style="color: green"><?php echo $_GET['due'];?></h6>
              </div>
            </div>    
<div class="col-md-12"> 
<a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#outsource">Outsource Equipment</a><br><br>

<div id="outsource" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header"><h3>Outsource Equipment</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      
                        
                          <form method="POST" action="outsource.php">
                            <div class="form-group">
                            <div class="form-label-group">
                              <input type="hidden" class="form-control" value="<?php echo $_GET['emp_id']; ?>" name="emp">
                              <input type="hidden" class="form-control" value="<?php echo $_GET['location_id']; ?>" name="loc">
                              <input type="hidden" class="form-control" value="<?php echo $_GET['code']; ?>" name="code">
                              <input type="hidden" class="form-control" value="<?php echo $_GET['due']; ?>" name="due">
                            <input type="text" id="inputName" class="form-control" placeholder="Name" name="company" autofocus="autofocus" required>
                            <label for="inputName">Company Name</label>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="form-label-group">
                             <select class="form-control" name="equipname" tabindex="1" autofocus required>
                <?php
                   $querys2=mysqli_query($db,"select * from equipments")or die(mysqli_error());
                      while($rows2=mysqli_fetch_array($querys2)){
                ?>
                    <option value="<?php echo $rows2['equip_id'];?>"><?php echo $rows2['name'].' '.$rows2['uniquec'];?></option>
                  <?php }?>
                </select>
                          </div>
                        </div>
                            <div class="form-group">
                            <div class="form-label-group">
                            <input type="number" hidden id="inputQty" value="1" class="form-control" placeholder="Quantity" name="qty" required>
                            <label for="inputQty">Quantity</label>
                            </div>
                            </div>
                            
                          
                 
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                  </div>
                  </form>
               
</div>
</div>
              </div>
            </div>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Equipment Name</th>
                        <th>Equipment Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
    
    $querys=mysqli_query($db,"select temp.temp_id,temp.qty,equipments.name,equipments.uniquec,equipments.equip_id from temp inner join equipments on equipments.equip_id = temp.equip_id and temp.unique_id = '".$_GET['code']."'")or die(mysqli_error());
    while($rows=mysqli_fetch_array($querys)){
    
?>
                      <tr >
            <td><?php echo $rows['qty'];?></td>
            <td><?php echo $rows['name'];?></td>
            <td><?php echo $rows['uniquec'];?></td>
                        <td>

              <a type="button" href="#delete<?php echo $rows['temp_id'];?>" data-target="#delete<?php echo $rows['temp_id'];?>" data-toggle="modal" class="btn btn-danger fas fa-trash"></a>
              
            </td>
                      </tr>
            <div id="delete<?php echo $rows['temp_id'];?>" class="modal fade in" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="del.php" enctype='multipart/form-data'>  
          <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $rows['temp_id'];?>" required>  
          <input type="hidden" class="form-control" value="<?php echo $_GET['emp_id']; ?>" name="emp">
           <input type="hidden" class="form-control" value="<?php echo $_GET['location_id']; ?>" name="loc">
           <input type="hidden" class="form-control" value="<?php echo $_GET['code']; ?>" name="code">
           <input type="hidden" class="form-control" value="<?php echo $_GET['due']; ?>" name="due">
           <input type="hidden" class="form-control" value="<?php echo $rows['qty'];?>" name="qty">
           <input type="hidden" class="form-control" value="<?php echo $rows['equip_id']; ?>" name="equipname">
        <p>Are you sure you want to remove <?php echo $rows['name'];?>?</p>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>
</div>
 <!--end of modal-->  
 
<?php }?>           

                    </tbody>
                    
                  </table>
                  <?php
    
    $querys=mysqli_query($db,"select temp.temp_id,temp.qty,equipments.name from temp inner join equipments on equipments.equip_id = temp.equip_id and temp.unique_id = '".$_GET['code']."'")or die(mysqli_error());
    $rows=mysqli_fetch_array($querys);
    
 
if($rows>0){
 ?>
                <!-- /.box-body -->
<form class="form-horizontal" method="post" action="execute.php" enctype='multipart/form-data'>  
          <input type="hidden" class="form-control" id="price" name="code" value="<?php echo $_GET['code'];?>" required>
          <input type="hidden" class="form-control" id="price" name="due" value="<?php echo $_GET['due'];?>" required>
    <center>
                <button type="submit" class="btn btn-primary fas fa-location-arrow">Borrow</button>
              </center>
        </form>
        <?php
}else{
  echo "";
}
        ?>
        </div>
      
             
    <?php
              include('include/scripts.php');
       include('include/footer.php');
       
        ?>