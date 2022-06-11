<?php
include "../connexion.php";
session_start();
// test de session si l'admine qu'est connecter 
if(empty($_SESSION)){
  header("location:pages-login.php");
}else{
  $id_user=$_SESSION['id'];
  $sql="select * from user where id=".$id_user;
  $res=$conn->query($sql);
  foreach($res as $row){
    if($row['role']=="Client"){
      header("location:user/dashboardClient.php");
    }
  }
}if(isset($_POST['decnn'])){
  session_destroy();
  header("location:../index.php");
}
//fin de test
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / General - OBM Admin Bootstrap Template</title>
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

  <!-- =======================================================
  * Template Name: OBM Admin - v2.2.2
  * Template URL: https://OBM Team.com/nice-admin-bootstrap-admin-html-template/
  * Author: OBM Team.com
  * License: https://OBM Team.com/license/
  ======================================================== -->
</head>

<body>

   <!-- ======= Header ======= -->
   <?php
include "../header.php"
 ?>
  <!-- ======= Sidebar ======= -->
  <?php

include "../aside.php"

?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>General Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Commandes List</h5>

              <!-- Commandes List -->
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Id_commande</th>
                    <th scope="col">Date_commande</th>
                    <th scope="col">Total(DH)</th>
                    <th scope="col">Client</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Operation</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql="select * from commande";
                  $resultat=$conn->query($sql);
while($row=$resultat->fetch(PDO::FETCH_ASSOC)){
  $sql1="select nom,prenom from user where id=".$row["id"]."";
  $resultat1=$conn->query($sql1);
  while($row1=$resultat1->fetch(PDO::FETCH_ASSOC)){
  $nom_client=$row1["nom"]." ".$row1["prenom"];
  }

  echo "<tr><td>".$row["id"].
  "</td><td>".$row["date"].
  "</td><td>".$row["Total"].
  "</td><td>".$nom_client.
  "</td><td>".$row["statut"].
  "</td><td>"."<a href=\"valid_cmd.php?id=".$row["id"]."&id_client=".$row["id"]."\" style=\"color: white !important;\">
  <i class=\"ri-checkbox-circle-line\"></i><span>Valider</span></a>
  <a href=\"supprimer_cmd.php?id=".$row["id"]."\" style=\"color: white !important;\"><i class=\"ri-close-circle-fill\"></i><span>Supprimer</span></a>
  </td></tr>";
}
                  ?>
                
              
                </tbody>
              </table>
              <!-- End Commandes List -->

            </div>
          </div>

         
       
        
        </div>

     
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    

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