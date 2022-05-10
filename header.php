<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="../index.php" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">OBM Store</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"> <?php
          $id=$_SESSION['idUser'];
          $sql1="select count(*) as coun from notification where id_client=$id and statut='unread'";
          $res1=$conn->query($sql1);
          foreach($res1 as $row){
            echo($row['coun']);
           
            }
          ?></span>
      </a><!-- End Notification Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          <?php
          $id=$_SESSION['idUser'];
          $sql1="select count(*) as coun from notification where id_client=$id and statut='unread'";
          $res1=$conn->query($sql1);
          foreach($res1 as $row){
            echo(" Vous Avez ".$row['coun']." Nouveaux Notifications");
           
            }
          ?>
         
         
        </li>
        
<?php

$sql="select * from notification where id_client=$id and statut='unread'";
$res=$conn->query($sql);
foreach($res as $row){
echo("<li class='notification-item'>
<i class='bi bi-check-circle text-success'></i>
<div>
  <h4>".$row['titre']."</h4>
  <p>".$row['detail']."</p>
</div>
</li>");
}


?>

        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
          <form method="POST">
          <button style="background: none;border: none;color: #0d6efd;" name="btn_lu">Marque comme lu</button>
          </form>
        </li>
       

      </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number"><?php
          $id=$_SESSION['idUser'];
          $sql1="select count(*) as coun from message where idClient=$id and statutMsg='unread'";
          $res1=$conn->query($sql1);
          foreach($res1 as $row){
            echo($row['coun']);
            }
          ?></span>
      </a><!-- End Messages Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
        <?php
          $id=$_SESSION['idUser'];
          $sql1="select count(*) as coun from message where idClient=$id and statutMsg='unread'";
          $res1=$conn->query($sql1);
          foreach($res1 as $row){
            echo(" Vous Avez ".$row['coun']." Nouveaux Msg");
           
            }
          ?>
         
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <?php
$id=$_SESSION['idUser'];
$sql="select * from message where idClient=$id and statutMsg='unread'";
$res=$conn->query($sql);
foreach($res as $row){
  echo("
  <li class='message-item'>
  <a href='#'>
      <img src='assets/img/messages-1.jpg' class='rounded-circle'>
      <div class='med'>
        <h4>".$row['subjectMsg']."</h4>
        <p>".$row['textMsg']."</p>
      </div>
      </a>
  
  </li>");
}

        ?>

        <li class="dropdown-footer">
        <form method="POST">
          <button style="background: none;border: none;color: #0d6efd;" name="btn_lu2">Marque comme lu</button>
          </form>
        </li>

      </ul><!-- End Messages Dropdown Items -->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <?php
          if(!empty($_SESSION)){
            $sql="select * from user where id=".$_SESSION['idUser'];
            $res=$conn->query($sql);
            foreach($res as $row){
              echo('<span class="d-none d-md-block dropdown-toggle ps-2">'.$row['nom']." ".$row['prenom'].'</span>');
            }
  
          }else{
            header("location:index.php");
          }
      

          ?>
       
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <?php
           if(!empty($_SESSION)){
          $sql="select * from user where id=".$_SESSION['idUser'];
          $res=$conn->query($sql);
          foreach($res as $row){
            echo("<h6>".$row['nom']." ".$row['prenom']."</h6><span>".$row['role']."</span>");
          }}else{
            header("location:index.php");
          }
      


          ?>
         
         
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="../user/users-profile.php">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

    
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <form method="POST">
        <li>
          <a class="dropdown-item d-flex align-items-center" href="">
            <i class="bi bi-box-arrow-right"></i>
           
            <button type="submit" name="decnn" style="border: none;background: white;">Deconnecter</button>
           
          </a>
        </li>
        </form>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->