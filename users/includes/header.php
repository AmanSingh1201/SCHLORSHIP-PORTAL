<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    
    <li class="nav-item dropdown-lg">
<?php 
  $uid=$_SESSION['uid'];
$sql ="SELECT * from  tblapply where Status='Disbursed' and UserID='$uid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$disapp=$query->rowCount();
?>
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i>(<?php echo htmlentities($disapp);?>)</a>
      <ul class="dropdown-menu dropdown-menu-right">
        <?php
foreach($results as $row)
{ 

  ?>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> Disbursed Application(<?php echo $row->ApplicationNumber;?>)</li> <?php  } ?>
         
        </ul>
    </li>
    
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="../assets/images/images.jpg" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="../assets/images/images.jpg" alt="user avatar"></div>
            <div class="media-body">
              <?php
$uid=$_SESSION['uid'];
$sql="SELECT FullName,Email from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
            <h6 class="mt-2 user-title"><?php  echo $row->FullName;?></h6>
            <p class="user-subtitle"><?php  echo $row->Email;?></p><?php $cnt=$cnt+1;}} ?>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        
        <li class="dropdown-divider"></li>
        <a href="profile.php" target="_blank">
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Profile</li>
    </a>
        <li class="dropdown-divider"></li>
        <a href="setting.php" target="_blank">
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li></a>
        <li class="dropdown-divider"></li>
        <a href="logout.php" target="_blank">
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
    </a>
      </ul>
    </li>
  </ul>
</nav>
</header>