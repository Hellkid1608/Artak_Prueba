<?php
  class db_functions
  {
    var $conn;

    function db_functions($server,$username,$password,$database)
    {
      $this->conn = mysqli_connect($server,$username,$password) or die ("Could not connect : " . mysqli_error());
      mysqli_select_db($this->conn,$database) or die ("Could not select database <b>$database</b>");
      mysqli_set_charset($this->conn, "UTF-8");
    }

    function idToField($tablename,$field,$field_id,$id)
  	{
  		$result = mysqli_query($this->conn,"SELECT ".$field." FROM $tablename WHERE ".$field_id."=".$id);
  		$row = mysqli_fetch_assoc($result);
  		return $row[$field];
  	}

    function Test_Login($user,$pass)
    {
      $clean_user = mysqli_real_escape_string($this -> conn,$user);
      $encrypted_pass = hash('haval256,5', $pass);
      $Query = "SELECT * from users where email = '$user' and password = '$encrypted_pass'";
      $result = MYSQLI_QUERY($this -> conn,$Query);
      $row = mysqli_fetch_array($result,MYSQLI_NUM);
      $count = mysqli_num_rows($result);
      if ($count == 1)
      {
        header("location: index.php");
      }else {
        $alerta = "<div class='alert alert-danger'>
                    <strong>Warning!</strong> Usuario y/o Constraseña incorrectos.
                  </div>";
                  echo $alerta;
      }
    }

    function Table_Users()
    {
      $Query   = "SELECT * from users";
      $Data    = array();
      $result  = MYSQLI_QUERY($this -> conn,$Query);
      while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
      {
        $Buttons = '  <div class="btn-group">
            <button type="button" class="btn btn-outline-success ViewModal" data-toggle="modal" data-target="#myModalView" value=View.'.$row[0].'><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-outline-warning EditModal" data-toggle="modal" data-target="#myModalView" value=Edit.'.$row[0].'><i class="fa fa-pencil"></i></button>
            <button type="button" class="btn btn-outline-danger  DeleteModal" data-toggle="modal" data-target="#myModalView" value=Delete.'.$row[0].'><i class="fa fa-trash"></i></button>
          </div>';

        if ($row[6] != "")
        {
          $row[6] = '<span class="fa fa-facebook"></span>';
        }

        if ($row[7] != "")
        {
          $row[7] = '<span class="fa fa-twitter"></span>';
        }
        array_push($Data,$row[1]."|".$row[2]."|".$row[3]."|".$row[4]."|".$row[6].$row[7]."|".$Buttons);
      }
      return $Data;
    }


    function New_User()
    {
      $name = trim(mysqli_real_escape_string($this-> conn,$_POST['user']));
      $surname = trim(mysqli_real_escape_string($this-> conn,$_POST['pass']));
      $phone = trim(mysqli_real_escape_string($this-> conn,$_POST['phone']));
      $adress = trim(mysqli_real_escape_string($this-> conn,$_POST['adress']));
      $facebook = trim(mysqli_real_escape_string($this-> conn,$_POST['facebook']));
      $twitter  = trim(mysqli_real_escape_string($this-> conn,$_POST['twitter']));
      $min_name = strtolower($name[0]);
      $min_last = strtolower($surname);
      $min_last = explode(" ",$min_last);
      $email = $min_name.$min_last[0]."@artak.com";
      $password = hash('haval256,5', 'Artak!');
      $Query = "INSERT INTO users (name,surname,phone,address,email,password,facebook,twitter) VALUES ('$name','$surname','$phone','$adress','$email','$password','$facebook','$twitter')";
      if (mysqli_query($this -> conn, $Query))
      {
          echo $inner = '<div class="alert alert-success"><strong>success!</strong><strong>success!</strong><strong>success!</strong><strong>su</strong> User Creted Success</div>';
      } else {
        echo $inner = '<div class="alert alert-warning"><strong>success!</strong><strong>success!</strong><strong>success!</strong><strong>su</strong> User Creted Failed</div>';
      }
      return $inner;
    }

    function Update_User()
    {
      $name = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdateName']));
      $surname = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdatePassword']));
      $phone = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdatePhone']));
      $email = trim(mysqli_real_escape_string($this -> conn,$_POST['UpdateEmail']));
      $pass = trim(mysqli_real_escape_string($this -> conn,$_POST['UpdatePassword']));
      $adress = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdateAddress']));
      $facebook = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdateFacebook']));
      $twitter  = trim(mysqli_real_escape_string($this-> conn,$_POST['UpdateTwitter']));
      $id = $_POST['hide'];
      $password = hash('haval256,5', $pass);
      $Query = "UPDATE users SET name = '$name', surname='$surname', phone='$phone',email='$email',password='$password',facebook='$facebook',twitter='$twitter',address='$adress' WHERE id=$id";
      $result = MYSQLI_QUERY($this -> conn, $Query);
    }


    function closeDBlink()
    {
    	mysqli_close($this->conn);
    }
  }
 ?>
