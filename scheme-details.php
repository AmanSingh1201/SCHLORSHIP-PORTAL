<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Scholarship Management System | Scheme details Page</title>
 
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
<?php include_once('includes/header.php');?>
    
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Scheme Details</span></p>
            <h1 class="mb-3 bread">Schemes Details</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    		
          <?php
          $sid=$_GET['sid'];
$sql="SELECT * from tblscheme where ID=:sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
    			<div class="col-md-12 d-flex ftco-animate">
    				<div class="course align-self-stretch">
    					<a href="#" class="img" style="background-image: url(images/course-2.jpg)"></a>
    					<div class="text p-4">
    						<p class="category"><span>Scholarship Amount</span> <span class="price">$<?php  echo $row->ScholarAmount;?></span></p>
    						<h3 class="mb-3"><?php  echo $row->SchemeName;?></h3>

 <table class="table table-bordered">
    <tbody>
      <tr>
        <th>Scholarship Details</th>
        <td> <?php  echo $row->ScholarDesc;?></td>
      </tr>


      <tr>
        <th>Scheme Type</th>
        <td><?php  echo $row->SchemeType;?></td>
      </tr>
      <tr>
        <th>SchemeGrade</th>
        <td><?php  echo $row->SchemeGrade;?></td>
      </tr>
      <tr>
        <th>Year of Scholarship:</th>
        <td><?php  echo $row->Yearofscholarship;?></td>
      </tr>


            <tr>
        <th>Category</th>
        <td><?php  echo $row->Category;?></td>
      </tr>

            <tr>
        <th>Criteria</th>
        <td><?php  echo $row->Criteria;?></td>
      </tr>


            <tr>
        <th>Docoment Required</th>
        <td><?php  echo $row->DocomentRequired;?></td>
      </tr>


            <tr>
        <th>Last Date</th>
        <td><?php  echo $ldate=$row->LastDate;?></td>
      </tr>

            <tr>
        <th>Published Date</th>
        <td><?php  echo $row->PublishedDate;?></td>
      </tr>
    </tbody>
  </table>



          <?php 
 $cdate=date('Y-m-d');
          if($cdate <= $ldate):?>
                
    						<p><a href="users/login.php" class="btn btn-primary">Apply now!</a></p>
              <?php else: ?>
                <p style="color:red; font-size: 18px;">***** Submission date is over</p>
<?php endif;?>

    					</div>
    				</div>
    			</div><?php $cnt=$cnt+1;}} ?>
    		
    		
    		
    		
    		</div>
    	
    	</div>
    </section>
		
		<?php include_once('includes/footer.php');?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>