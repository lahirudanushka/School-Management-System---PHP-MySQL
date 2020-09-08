<?php session_start(); 


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

 $sid =$title =$description = " ";
              

if(isset($_GET['update'])){
  $update = "SELECT * FROM subject WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sid = $row['sid'];
        $title = $row['title'];
                $description = $row['description'];
                
                
    }
}
}

?>


<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Subject</title><link rel="icon" href="../img/favicon2.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
 <?php include_once 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subject
        <small>Subject Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Subject</a></li>
        <li class="active">Details</li>
      </ol>
    </section>

    <!-- Main content -->


    <section class="content">

 <div class="row">


     <?php if (!isset($_GET['update'])) { ?>
 <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                New Subject Successfully added
              </div>






          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" >
              <div class="box-body">

                 

                <div class="form-group">
                  <label for="exampleInputPassword1">Subject ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Subject ID" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Subject Title</label>
                  <input name="title" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Subject Title" required>
                </div>

                

            


                <div class="form-group">
    <label for="exampleFormControlTextarea1">Syllubus Details</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
  </div>
   


       
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Subject</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $sid = $_POST['sid'];
                $title = $_POST['title'];
                $description = $_POST['description'];

              


                  try {


                   

                    $sql = "INSERT INTO subject (sid,title,description) VALUES ( '".$sid."', '".$title."','".$description."')";

                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                # code...
                                            }

              ?>



          </div></div>

                 <?php }elseif (isset($_GET['update'])) { ?>


 <div class="col-xs-4">

   

         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                 Subject Updated Successfully 
              </div>






          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" >
              <div class="box-body">

                 

                <div class="form-group">
                  <label for="exampleInputPassword1">Subject ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$sid."'"; ?> disabled>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Subject Title</label>
                  <input name="title" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$title."'"; ?>>
                </div>

                

            


                <div class="form-group">
    <label for="exampleFormControlTextarea1">Syllubus Details</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="10"><?php echo $description; ?></textarea>
  </div>
   


       
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Subject</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
               
                $title = $_POST['title'];
                $description = $_POST['description'];

              


                  try {


                   
                    $sql = "UPDATE subject set title='".$title."',description='".$description."' where sid = '".$sid."' " ;
                  //  $sql = "INSERT INTO subject (sid,title,description) VALUES ( '".$sid."', '".$title."','".$description."')";

                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                # code...
                                            }

              ?>



          </div></div>


        <?php } ?>



          <div class="col-xs-8">


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Subjects</h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subject ID</th>
                  <th>Title</th>
                  <th>Details</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * FROM subject";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["sid"]. " </td><td> " . $row["title"]. "</td><td>" . $row["description"]. "</td><td><a href='subject.php?update=". $row["sid"]."'><small class='label  bg-orange'>Update</small></a></td></tr>";
                       }
                                  }

                  ?>


                </tbody>
                <tfoot>
                 
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            
          </div>
          <!-- /.box -->

          

        </div>

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
   
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include_once 'footer.php'; ?>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Select2 -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


<script>   $('.select2').select2()
  $('#datepicker').datepicker({
      autoclose: true
    });


        
            var r = document.getElementById("subject"); 
            r.className += "active"; 
           
    </script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>