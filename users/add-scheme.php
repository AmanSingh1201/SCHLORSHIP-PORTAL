<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['submit']))
  {
   
  $schemename=$_POST['schemename'];
  $schtype=$_POST['schtype'];
  $schgrade=$_POST['schgrade'];
  $yearofsch=$_POST['yearofsch'];
  $category=$_POST['category'];
  $criteria=$_POST['criteria'];
  $docreq=$_POST['docreq'];
  $lastdate=$_POST['lastdate'];
  $schdesc=$_POST['schdesc'];
  $schamt=$_POST['schamt'];
  $sql="insert into tblscheme(SchemeName,SchemeType,SchemeGrade,Yearofscholarship,Category,Criteria,DocomentRequired,LastDate,ScholarDesc,ScholarAmount)values(:schemename,:schtype,:schgrade,:yearofsch,:category,:criteria,:docreq,:lastdate,:schdesc,:schamt)";
     $query = $dbh->prepare($sql);
     $query->bindParam(':schemename',$schemename,PDO::PARAM_STR);
     $query->bindParam(':schtype',$schtype,PDO::PARAM_STR);
     $query->bindParam(':schgrade',$schgrade,PDO::PARAM_STR);
     $query->bindParam(':yearofsch',$yearofsch,PDO::PARAM_STR);
     $query->bindParam(':category',$category,PDO::PARAM_STR);
     $query->bindParam(':criteria',$criteria,PDO::PARAM_STR);
     $query->bindParam(':docreq',$docreq,PDO::PARAM_STR);
     $query->bindParam(':lastdate',$lastdate,PDO::PARAM_STR);
     $query->bindParam(':schdesc',$schdesc,PDO::PARAM_STR);
     $query->bindParam(':schamt',$schamt,PDO::PARAM_STR);
$query->execute();
       $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Scheme detail has been added.")</script>';
echo "<script>window.location.href ='add-scheme.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Scholarship Management System||Add Scheme</title>
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

    <div class="row mt-3">
      <div class="col-lg-6">
         <div class="card">
           <div class="card-body">
           <div class="card-title">Add Scheme</div>
           <hr>
            <form method="post">
                       <div class="form-group">
            <label for="input-1">Name of Scheme</label>
            <input type="text" class="form-control" id="schemename" name="schemename" value="" required='true'>
           </div>
           <div class="form-group">
            <label for="input-2">Type of Scholarship</label>
            
            <select class="form-control" id="schtype" name="schtype" required='true'>
              <option value="">Choose Type</option>
              <option value="Central">Central</option>
              <option value="UGC">UGC</option>
              <option value="AICTE">AICTE</option>
              <option value="State">State</option>
              <option value="Other">Other</option>
              
            </select>
           </div>
           <div class="form-group">
            <label for="input-3">Scholarship Grade</label>
            <select class="form-control" id="schgrade" name="schgrade" required='true'>
              <option value="">Choose Grade</option>
              <option value="High School Students">High School Students</option>
              <option value="Undergraduate Students">Undergraduate Students</option>
              <option value="Graduate Students">Graduate Students</option>
              <option value="Other">Other</option>
              
            </select>
           </div>
           <div class="form-group">
            <label for="input-4">Year of Scholarship</label>
            <input type="text" class="form-control" id="yearofsch" name="yearofsch" value="" required='true'>
           </div>
           <div class="form-group">
            <label for="input-4">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="" required='true'>
           </div>
           <div class="form-group">
            <label for="input-4">Criteria</label>
            
            <textarea class="form-control" id="criteria" name="criteria" value="" required='true'></textarea>
           </div>
           <div class="form-group">
            <label for="input-4">Document Required</label>
            <textarea class="form-control" id="docreq" name="docreq" value="" required='true'></textarea>
           </div>
           <div class="form-group">
            <label for="input-4">Last Date</label>
            <input type="date" class="form-control" id="lastdate" name="lastdate" value="" required='true'>
           </div>
          <div class="form-group">
            <label for="input-4">Scheme Description</label>
            <textarea class="form-control" id="schdesc" name="schdesc" value="" required='true'></textarea>
           </div>
          <div class="form-group">
            <label for="input-4">Scholarship Amount(per month)</label>
            <input type="text" class="form-control" id="schamt" name="schamt" value="" required='true'>
           </div>
           <div class="form-group">
            <button type="submit" class="btn btn-light px-5" name="submit"><i class="icon-lock"></i> Add</button>
          </div>
          </form>
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