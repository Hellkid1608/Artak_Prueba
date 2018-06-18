<?php
  class Display
  {
    var $conn;
    var $dbf;
    var $sec;

    function display($conexion /*,$security*/)
    {
      require_once("class/db_functions.php");
      include("class/settings.php");
      $this -> dbf = new db_functions("$cfg_server","$cfg_username","$cfg_password","$cfg_database");
      $this -> conn = $conexion;
    	//$this -> sec = $security;
    }

    function Table($table_headers,$table_content)
    {
      $inner = "";
      $inner .= '<table class="table table_responsive">
        <thead class="thead-light">
          <tr>';
          for ($i =0;$i < count($table_headers); $i++)
          {
            $inner .= '<th>'.$table_headers[$i].'</th>';
          }
          $inner .='</tr></thead>
                    <tbody>';
                    for ($j=0;$j<count($table_content);$j++)
                    {
                      $h = explode("|",$table_content[$j]);
                      $inner .= '<tr index='.$j.' style="word-wrap:break-word;">';
                      for ($k=0;$k < count($h);$k++)
                      {
                        $inner .='<td>'.$h[$k].'</td>';
                      }
                      $inner .='</tr>';
                    }
                    $inner .= '</tbody>
                          </table>';
      return $inner;
    }

    function Modal_View()
    {
      $inner ="";
      $inner .= '<!-- Modal -->
                  <div id="myModalView" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                          <p id="AjaxRequest"></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>';
      return $inner;
    }




    function Index_Page()
    {
      if (isset($_POST['NewUser']))
      {
        if (!empty($_POST["email"]))
        {
          $this -> dbf -> New_User();
      }else {
        echo $inner = '<div class="alert alert-warning"><strong>success!</strong><strong>success!</strong><strong>success!</strong><strong>su</strong> Please type all the fields</div>';
      }

      }

      if (isset($_POST['Update']))
      {
        if (!empty($_POST["UpdateName"]))
        {
          $this -> dbf -> Update_User();
          //echo $inner = '<div class="alert alert-success"><strong>success!</strong><strong>success!</strong><strong>success!</strong><strong>su</strong> Updated User Success</div>';
        }else {
          echo $inner = '<div class="alert alert-warning"><strong>success!</strong><strong>success!</strong><strong>success!</strong><strong>su</strong> Please type all the fields</div>';
        }
      }
      $inner = "";
      $inner .= '<!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Artak Test</title>
        <!-- Bootstrap core CSS-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">
      </head>

      <body class="fixed-nav sticky-footer bg-dark" id="page-top">

      '.$this -> Modal_View().'


        <!-- The Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Create New User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <form action = "" name="email" method = "POST" id="Create" Name="Create">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input class="form-control" name = "user" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Surnames</label>
                    <input class="form-control" name = "pass" id="exampleInputPassword1" type="text" placeholder="Surnames">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhone1">Phone</label>
                    <input class="form-control" name = "phone" id="exampleInputPhone1" type="text" placeholder="Phone">
                  </div>
                  <div class="form-group">
                   <label for="exampleAddress1">Addres</label>
                   <textarea class="form-control"  name = "adress" rows="5" id="exampleAddress1"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSocial"><span class="fa fa-facebook"></span></label>
                    <input class="form-control" id="exampleInputSocial1" name="facebook" type="text" placeholder="Facebook">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSocial"><span class="fa fa-twitter"></span></label>
                    <input class="form-control" id="exampleInputSocial1" name="twitter" type="text" placeholder="Twitter">
                  </div>
                </form>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" form="Create" name="NewUser">Create</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
          <a class="navbar-brand" href="index.html">Artak</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link" href="index.html">
                  <i class="fa fa-fw fa-users"></i>
                  <span class="nav-link-text">Users</span>
                </a>
              </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
              <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                  <i class="fa fa-fw fa-angle-left"></i>
                </a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-fw fa-sign-out"></i>Logout</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="content-wrapper">
          <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Users</a>
              </li>
              <li class="breadcrumb-item active">Users CRUD</li>
            </ol>
            <!-- Area Chart Example-->
            <div class="card mb-3">
              <div class="card">
                <div class="card-header"></div>
                <div id="content" class="card-body">';
                $table_headers = array("Name","Surnames","Phone","Address","Social","");
                $table_content = $this -> dbf -> Table_Users();
                $inner .= $this -> Table($table_headers,$table_content);
                $inner .='</div>
                <div class="card-footer">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal">New User</button>
                </div>
              </div>
            </div>
          <!-- /.container-fluid-->
          <!-- /.content-wrapper-->
          <footer class="sticky-footer">
            <div class="container">
              <div class="text-center">
                <small>Powered By José Uriel Nava Anaya</small>
              </div>
            </div>
          </footer>
          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
          </a>
          <!-- Logout Modal-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Bootstrap core JavaScript-->
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <!-- Core plugin JavaScript-->
          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
          <!-- Page level plugin JavaScript-->
          <script src="vendor/datatables/jquery.dataTables.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
          <!-- Custom scripts for all pages-->
          <script src="js/sb-admin.min.js"></script>
          <!-- Custom scripts for this page-->
          <script src="js/sb-admin-datatables.min.js"></script>

          <script>
          $(function(){
             $("#content").on("click", ".ViewModal", function(){
                 var ip = $(this).val();
                 $.post("users.php", {
                     ipe: ip
                     }, function(data){
                        $("#AjaxRequest").html(data);
                         });
                 });

                 $("#content").on("click", ".EditModal", function(){
                     var ip = $(this).val();
                     $.post("users.php", {
                         ipe: ip
                         }, function(data){
                            $("#AjaxRequest").html(data);
                             });
                     });

                     $("#content").on("click", ".DeleteModal", function(){
                         var ip = $(this).val();
                         $.post("users.php", {
                             ipe: ip
                             }, function(data){
                                $("#AjaxRequest").html(data);
                                 });
                         });
             });
          </script>
      </body>

      </html>';
      return $inner;
    }


    function Login_Page()
    {
      if (isset($_POST['submit']))
      {
        $user = $_POST['email_user'];
        $pass = $_POST['password_user'];
        $this -> dbf -> Test_Login($user,$pass);
      }
      $inner = "";
      $inner .= '<!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Artak Test</title>
        <!-- Bootstrap core CSS-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">
      </head>

      <body class="bg-dark">
        <div class="container">
          <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form action="" method = "POST" id = "login">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control"  name="email_user" type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" name="password_user" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                </div>
                <button type = "submit" class="btn btn-primary btn-block" name="submit" value="submit">Login</button>
              </form>
            </div>
          </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      </body>

      </html>';
      return $inner;
    }
  }
 ?>
