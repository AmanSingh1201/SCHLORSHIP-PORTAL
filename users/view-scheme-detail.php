<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {

$appnum=mt_rand(100000000, 999999999);
 $schemeid=intval($_GET['viewid']);
 $uid=$_SESSION['uid'];
 $dob=$_POST['dob'];
 $gender=$_POST['gender'];
 $category=$_POST['category'];
 $religion=$_POST['religion'];
 $address=$_POST['address'];
 $adharno=$_POST['adharno'];
$pic=$_FILES["pic"]["name"];
$doc=$_FILES["reqdoc"]["name"];
$extension = substr($pic,strlen($pic)-4,strlen($pic));
$extension1 = substr($doc,strlen($doc)-4,strlen($doc));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
$allowed_extensions1 = array("docs",".doc",".pdf");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Profile pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
if(!in_array($extension1,$allowed_extensions1))
{
echo "<script>alert('File has Invalid format. Only docs / doc/ pdf format allowed');</script>";
}
else
{

$pic=md5($pic).time().$extension;
$doc=md5($doc).time().$extension1;
 move_uploaded_file($_FILES["pic"]["tmp_name"],"proimages/".$pic);
 move_uploaded_file($_FILES["reqdoc"]["tmp_name"],"document/".$doc);

 $query1 = "select ID from tblapply where UserID=:uid && SchemeId=:schemeid";
  $query1 = $dbh -> prepare($query1);
  $query1-> bindParam(':uid', $uid, PDO::PARAM_STR);
  $query1-> bindParam(':schemeid', $schemeid, PDO::PARAM_STR);
  $query1->execute();
  $results1=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
echo "<script>alert('Already Applied for this scholarship');</script>"; 
echo "<script>window.location.href ='views-scheme.php'</script>";
}
else
{


$sql="insert into tblapply(SchemeId,ApplicationNumber,UserID,DateofBirth,Gender,Category,Religion,Address,AadharNumber,ProfilePic,DocReq)values(:schemeid,:appnum,:uid,:dob,:gender,:category,:religion,:address,:adharno,:pic,:doc)";
$query=$dbh->prepare($sql);
$query->bindParam(':schemeid',$schemeid,PDO::PARAM_STR);
$query->bindParam(':appnum',$appnum,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':religion',$religion,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':adharno',$adharno,PDO::PARAM_STR);
$query->bindParam(':pic',$pic,PDO::PARAM_STR);
$query->bindParam(':doc',$doc,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
   echo '<script>alert("Your application has been sent successfully. Application Number is "+"'.$appnum.'")</script>';

echo "<script>window.location.href ='views-scheme.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
}

}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>Scholarship Management System||View Scheme</title>
  <!-- loader-->
  <link href="../assets/css/pace.min.css" rel="stylesheet"/>
  <script src="../assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="../assets/css/app-style.css" rel="stylesheet"/>
 
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
    <?php include_once('includes/sidebar.php');?>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<?php include_once('includes/header.php');?>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">View Scholarship Scheme Details</h5>
              <!-- <div class="table-responsive"> -->
                    <?php
                    $vid=$_GET['viewid'];
$sql="SELECT * from tblscheme where ID = :vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<table border="1" class="table table-bordered">

    <tr>
    <th scope>Name of Scheme</th>
    <td > <?php  echo $row->SchemeName;?></td>
  </tr>
  <tr>
    <th scope>Type of Scheme</th>
    <td><?php  echo $row->SchemeType;?></td>
  </tr>
  <tr>
    <th>Scheme Grade</th>
    <td><?php  echo $row->SchemeGrade;?></td>
  </tr>
  <tr>
    <th>Year of Scholarship</th>
    <td><?php  echo $row->Yearofscholarship;?></td>
  </tr>
  <tr>
    <th>Category</th>
    <td><?php  echo $row->Category;?></td>
  </tr>

  <tr>
   <th>Criteria</th>
    <td colspan="4"><?php  echo $row->Criteria;?></td>
  </tr>
  <tr>
    <th>Last Date</th>
    <td><?php  echo $ldate= $row->LastDate;?></td>
    
  </tr>

  <tr>
    <th>Docoment Required</th>
    <td><?php  echo $row->DocomentRequired;?></td>
    
  </tr>
   <tr>
    <th>Scholar Description</th>
    <td style=" word-wrap: break-all;"><?php  echo $row->ScholarDesc;?></td>
  <tr>
     <th>Scholar Amount(per month)</th>
    
    <td><?php  echo $row->ScholarAmount;?></td>

    
  </tr>


<?php }}?>

</table>


                  
              <!-- </div> -->
              <br>
              <div class="table-responsive">


      <?php 
 $cdate=date('Y-m-d');
          if($cdate <= $ldate):?>
                
           <p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Apply Now</button></p>  
              <?php else: ?>
                <p style="color:red; font-size: 18px;">***** Submission date is over</p>
<?php endif;?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apply Now</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
 <table class="table table-bordered table-hover data-tables">
    <form method="post" name="submit" enctype="multipart/form-data">
      <tr>
    <th style="color: blue;">Photo:</th>
    <td>
    <input type="file" name="pic" class="form-control" required="true" style="border:solid 1px #000; color:#000;"></td>
  </tr>
      <tr>
    <th style="color: blue;">Date of Birth :</th>
    <td>
    <input type="date" name="dob" class="form-control" required="true" style="border:solid 1px #000;color:#000;"></td>
  </tr>
  <tr>
    <th style="color: blue;">Gender :</th>
    <td>
   <select name="gender" class="form-control" required="true" style="border:solid 1px #000;color:#000;">
     <option value="Male" selected="true">Male</option>
     <option value="Female">Female</option>
     <option value="Other">Other</option>
   </select></td>
  </tr> 
  <tr>
    <th style="color: blue;">Category :</th>
    <td>
   <select name="category" class="form-control" required="true" style="border:solid 1px #000;color:#000;">
    <option value="General" selected="true">General</option>
     <option value="SC" >SC</option>
     <option value="ST">ST</option>
     <option value="OBC">OBC</option>
   </select></td>
  </tr>
  <tr>
    <th style="color: blue;">Religion :</th>
    <td>
   <input type="text" name="religion" class="form-control" required="true" style="border:solid 1px #000;color:#000;"></td>
  </tr>
     <tr>
    <th style="color: blue;">Mailing Address :</th>
    <td>
    <textarea name="address" rows="4" cols="14" class="form-control" required="true" style="border:solid 1px #000;color:#000;"></textarea></td>
  </tr>  
  <tr>
    <th style="color: blue;">Upload Required Doc :</th>
    <td>
    <input type="file" name="reqdoc" value="" class="form-control" required="true" style="border:solid 1px #000;color:#000;"> </td>
  </tr> 
  <tr>
    <th style="color: blue;">Adhar Card Number :</th>
    <td>
    <input type="text" name="adharno" class="form-control" required="true" style="border:solid 1px #000;color:#000;"></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>
                                </div>
                            </div>
                        </div>
                                    
                  
              </div>

            </div>
          </div>
        </div>
      </div><!--End Row-->
	  
	  <!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<?php include_once('includes/footer.php');?>
	<!--End footer-->
	
	<!--start color switcher-->
   <?php include_once('includes/color-switcher.php');?>
  <!--end color switcher-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>
	
</body>
</html>
<?php }  ?>