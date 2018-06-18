<?php
session_start();
include ("class/display.php");
include ("class/settings.php");
include ("class/db_functions.php");
include ("class/security_functions.php");
$dbf     = new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database);
$Value_IP = explode(".",$_POST['ipe']);


switch ($Value_IP[0])
{
  case 'View':
    $inner = '<div class="col-lg-12">
                <h1>Information for: '.$dbf -> idToField("users","name","id",$Value_IP[1]).'&nbsp;'.$dbf -> idToField("users","surname","id",$Value_IP[1]).'</h1>
                <form role="form">
                  <fieldset disabled>
                    <div class="form-group">
                      <label for="disabledSelect">Name:</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","name","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Surnames</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","surname","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Phone</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","phone","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Email</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","email","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Password</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="*********************" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Facebook</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","facebook","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Twitter</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","twitter","id","$Value_IP[1]").'" disabled>
                    </div>

                    <div class="form-group">
                      <label for="disabledSelect">Address</label>
                      <input class="form-control" id="disabledInput" type="text" placeholder="'.$dbf -> idToField("users","address","id","$Value_IP[1]").'" disabled>
                    </div>
                  </fieldset>
                </form>
              </div>';
    echo $inner;
  break;

  case 'Edit':
  $inner = '<div class="col-lg-12">
              <h1>Information for: '.$dbf -> idToField("users","name","id",$Value_IP[1]).'&nbsp;'.$dbf -> idToField("users","surname","id",$Value_IP[1]).'</h1>
              <form role="form" action="" method ="POST" >
                <fieldset>
                  <div class="form-group">
                    <label for="disabledSelect">Name:</label>
                    <input class="form-control" id="disabledInput" name="UpdateName" type="text" placeholder="'.$dbf -> idToField("users","name","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Surnames</label>
                    <input class="form-control" id="disabledInput" name="UpdateSurname" type="text" placeholder="'.$dbf -> idToField("users","surname","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Phone</label>
                    <input class="form-control" id="disabledInput" name="UpdatePhone" type="text" placeholder="'.$dbf -> idToField("users","phone","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Email</label>
                    <input class="form-control" id="disabledInput" name="UpdateEmail" type="text" placeholder="'.$dbf -> idToField("users","email","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Password</label>
                    <input class="form-control" id="disabledInput" name="UpdatePassword" type="text" placeholder="*********************">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Facebook</label>
                    <input class="form-control" id="disabledInput" name="UpdateFacebook" type="text" placeholder="'.$dbf -> idToField("users","facebook","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Twitter</label>
                    <input class="form-control" id="disabledInput" name="UpdateTwitter" type="text" placeholder="'.$dbf -> idToField("users","twitter","id","$Value_IP[1]").'">
                  </div>

                  <div class="form-group">
                    <label for="disabledSelect">Address</label>
                    <input class="form-control" id="disabledInput" name="UpdateAddress" type="text" placeholder="'.$dbf -> idToField("users","address","id","$Value_IP[1]").'">
                  </div>

                  <input type="hidden" name="hide" value="'.$Value_IP[1].'">

                  <div class="form-group">
                    <button type="submit" name="Update" class="btn btn-bloack btn-primary">Submit</button>
                  </div>
                </fieldset>
              </form>
            </div>';
  echo $inner;
  break;

  case 'Delete':
    $Query = "DELETE  from users Where id = '$Value_IP[1]'";
    $result = mysqli_query($dbf -> conn,$Query);
    echo '<div class="alert alert-success">User Eliminated</div>';
  break;

}

 ?>
