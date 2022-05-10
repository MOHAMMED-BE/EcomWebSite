
<?php
session_start();
include("connexion.php");

// test de session si l'admine qu'est connecter 
if(empty($_SESSION)){
  header("location:pages-login.php");
}else{
  $id_user=$_SESSION['idUser'];
  $sql="select * from user where id=".$id_user;
  $res=$conn->query($sql);
  foreach($res as $row){
    if($row['role']=="Client"){
      header("location:user/dashboardClient.php");
    }
  }
}
//fin de test
if(isset($_POST['decnn'])){
  session_destroy();
  header("location:index.php");
}
if(isset($_POST['btn_lu2'])){
  $req2=$conn->prepare("update message set statutMsg='read'");
  $req2->execute();
}

$select = $conn->prepare("SELECT count(*) from commande where statut='traiter' ");
$select->execute();
$count=$select->fetchColumn();

$select1 = $conn->prepare("SELECT count(*) from user where role='Client'");
$select1->execute();
$count_client=$select1->fetchColumn();

$select2 = $conn->prepare("SELECT sum(Total) from commande ");
$select2->execute();
$count_revenu=$select2->fetchColumn();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="../dashboard.php" class="logo d-flex align-items-center">
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

    </li><!-- End Messages Nav -->

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
          <a class="dropdown-item d-flex align-items-center" href="user/users-profile.php">
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
           
            <button type="submit" name="decnn" style="    border: none;
    background: white;">Deconnecter</button>
           
          </a>
        </li>
        </form>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">


<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="dashboard.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
      
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#commande-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Commande</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="commande-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="commande/liste_commande.php">
          <i class="bi bi-circle"></i><span>Liste Des Commande</span>
        </a>
      </li>
    </ul>
  </li><!-- End commande Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#produit-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Produit</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="produit-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="produit/ajouter_produit.php">
          <i class="bi bi-circle"></i><span>Ajouter un Produit</span>
        </a>
      </li>
      <li>
        <a href="produit/liste_produit.php">
          <i class="bi bi-circle"></i><span>Liste des Produits</span>
        </a>
      </li>
    </ul>
  </li><!-- End Produit Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#client-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="client-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="client/ajouter_client.php">
          <i class="bi bi-circle"></i><span>Ajouter un Client</span>
        </a>
      </li>
      <li>
        <a href="client/liste_client.php">
          <i class="bi bi-circle"></i><span>Liste des Clients</span>
        </a>
      </li>
    </ul>
  </li><!-- End Client Nav -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="user/users-profile.php">
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

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Commande</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

            

                <div class="card-body">
                  <h5 class="card-title">Revenue </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_revenu?> DH</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Client </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_client?></h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Commande Récent</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Numero commande</th>
                        <th scope="col">Client</th>
                        <th scope="col">Date</th>
                        <th scope="col">Total</th>
                        <th scope="col">Statut</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
$req="select c.id,c.date,c.Total,cl.nom,cl.prenom,c.statut from commande c,user cl where c.idUser=cl.id order by c.date limit 5 ";
$res=$conn->query($req);
$col_style="style='background-color: #ffc107 !important;'";
foreach($res as $row){
  echo('<tr><th scope="row">'.$row['id'].'</th><td>'.$row['nom']." ".$row['prenom'].'</td><td>'.$row['date'].'</td><td>'
.$row['Total']." Dh".'</td><td><span class="badge bg-success"');
if($row['statut']=='En cours de traitment')
{
  echo ($col_style);
}
echo(">".$row['statut']."</span></td></tr>");
}


?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

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

                <div class="card-body pb-0">
                  <h5 class="card-title">Produit Les Plus Vendu</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Produit</th>
                        <th scope="col">StockVendu</th>
                        <th scope="col">Prix d'unité</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      $sql="select p.image,p.quantite,p.prixVente, p.libelle,count(pan.idProduit),sum(pan.prixUnit*pan.quantite) as revenu ,
                      sum(pan.quantite) as qantiteVendu from produit p,panier pan where
                       p.id=pan.idProduit and pan.status='disable' GROUP by pan.idProduit ORDER by count(pan.idProduit) LIMIT 10";
                      $res=$conn->query($sql);
                      foreach($res as $row){
                        echo('<th scope="row"><a href="#"><img src="Produit/images/'.$row["image"].'"></a></th>'.
                        '</td><td>'.$row['libelle'].
                        '</td><td>'.$row['qantiteVendu'].
                        '</td><td>'.$row['prixVente'].
                        '</td><td>'.$row['quantite'].
                        '</td><td>'.$row['revenu']."Dh".
                        '</td></tr>');
                      }
                    ?>
                                  
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

  



        </div><!-- End Right side columns -->

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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>