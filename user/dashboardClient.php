

<?php
session_start();
include("../connexion.php");
if(isset($_POST['decnn'])){
  session_destroy();
  header("location:../index.php");
}
// test de session si l'admine qu'est connecter 
if(empty($_SESSION)){
  header("location:pages-login.php");
}

//fin de test
$select = $conn->prepare("SELECT count(*) from commande where statut='traiter' ");
$select->execute();
$count=$select->fetchColumn();

if(isset($_POST['btn_lu'])){
  $req2=$conn->prepare("update notification set statut='read' where id_client=$id");
  $req2->execute();
}
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - OBM Admin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
 <?php
include "../header.php"
 ?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">


<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
      
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#panier-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Panier</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="panier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="panier.php">
          <i class="bi bi-circle"></i><span>Panier</span>
        </a>
      </li>
    </ul>
  </li><!-- End panier Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.php">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->



</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
      <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
      <div class="card-body">
                  <h5 class="card-title">Commande Récentes</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Numero de commande</th>
                        <th scope="col">Total</th>
                        <th scope="col">Statut</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $id=$_SESSION['id'];
                      $sql="select * from commande where id=$id order by date desc";
                      $res=$conn->query($sql);
                      $col_style="style='background-color: #ffc107 !important;'";
                      foreach($res as $row){
                        echo("<tr><td>".$row['id'].
                        "</td><td>".$row['Total'].
                        " DH</td><td><span class='badge bg-success'");

                        if($row['statut']=='En cours de traitment')
                        {
                          echo ($col_style);
                        }

                       echo(">".$row['statut']."</span></td></tr>") ;
                      }
                      ?>
                  
                     
                    </tbody>
                  </table>

                </div>

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

  



        </div><!-- End Right side columns -->

      </div>
      </div>
            </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>OBM Admin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
     
      Designed by <a href="https://OBM Team.com/">OBM Team</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>