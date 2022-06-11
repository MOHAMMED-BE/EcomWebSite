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
}
//fin de test

if(isset($_GET['verf']) && $_GET['verf']=="true"){
  echo "<script>alert(\"Le produit est Ajouter\")</script>";
}elseif($_GET['verf']=="false"){
  echo "<script>alert(\"Le produit n'est Ajouter\")</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Elements - OBM Admin Bootstrap Template</title>
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
  <?php

include "../aside.php"

?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- General Form Elements -->
              <form method="POST" action="eng_produit.php" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label  class="col-sm-2 col-form-label">Nom produit:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nom_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Marque:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="marque_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Description:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="desc_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Prix D'Achat</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="prix_achat_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Prix de Vente</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="prix_vente_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Quantite</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="quantite_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="image_prod" name="image_prod" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Categorie:</label>
                  <div class="col-sm-10">
                    <select   name="categorie_prod" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" >
                      <?php
                      $sql="select * from categorie";
                      $result=$conn->query($sql);
                      while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value=\"".$row['id']."\">".$row['Name']."</option>";
                      }
                      ?>
                   

                    </select>
                   
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Ajouter le produit</label>
                  <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
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