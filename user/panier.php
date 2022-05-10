<?php
include "../connexion.php";
session_start();
// test de session si l'admine qu'est connecter 
if(empty($_SESSION)){
  header("location:pages-login.php");
}
if(isset($_POST['decnn'])){
  session_destroy();
  header("location:../index.php");
}if(isset($_POST['valide'])){
  
 header("Refresh:1");
 
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
<style>

  /*
  I wanted to go with a mobile first approach, but it actually lead to more verbose CSS in this case, so I've gone web first. Can't always force things...

  Side note: I know that this style of nesting in SASS doesn't result in the most performance efficient CSS code... but on the OCD/organizational side, I like it. So for CodePen purposes, CSS selector performance be damned.
  */
  /* Global settings */
  /* Global "table" column settings */
  .product-image {
    float: left;
    width: 20%;
  }

  .product-details {
    float: left;
    width: 37%;
  }

  .product-price {
    float: left;
    width: 12%;
  }

  .product-quantity {
    float: left;
    width: 10%;
  }

  .product-removal {
    float: left;
    width: 9%;
  }

  .product-line-price {
    float: left;
    width: 12%;
    text-align: right;
  }

  /* This is used as the traditional .clearfix class */
  .group:before, .shopping-cart:before,
  .column-labels:before,
  .product:before,
  .totals-item:before,
  .group:after,
  .shopping-cart:after,
  .column-labels:after,
  .product:after,
  .totals-item:after {
    content: "";
    display: table;
  }

  .group:after, .shopping-cart:after,
  .column-labels:after,
  .product:after,
  .totals-item:after {
    clear: both;
  }

  .group, .shopping-cart,
  .column-labels,
  .product,
  .totals-item {
    zoom: 1;
  }

  /* Apply clearfix in a few places */
  /* Apply dollar signs */
  .product .product-price:after,
  .product .product-line-price:after,
  .totals-value:after {
    content: " DH";
  }

  /* Body/Header stuff */
  body {
    padding: 0px 30px 30px 20px;
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 100;
  }

  h1 {
    font-weight: 100;
  }

  label {
    color: #aaa;
  }

  .shopping-cart {
    margin-top: -45px;
    background: white !important;
    padding: 11px !important;
    
  }

  /* Column headers */
  .column-labels label {
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
  }
  

  /* Product entries */
  .product {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
  }
  .product .product-image {
    text-align: center;
  }
  .product .product-image img {
    width: 100px;
  }
  .product .product-details .product-title {
    margin-right: 20px;
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  }
  .product .product-details .product-description {
    margin: 5px 20px 5px 0;
    line-height: 1.4em;
  }
  .product .product-quantity input {
    width: 40px;
  }
  .product .remove-product {
    border: 0;
    padding: 4px 8px;
    background-color: #c66;
    color: #fff;
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    font-size: 12px;
    border-radius: 3px;
  }
  .product .remove-product:hover {
    background-color: #a44;
  }

  /* Totals section */
  .totals .totals-item {
    float: right;
    clear: both;
    width: 100%;
    margin-bottom: 10px;
  }
  .totals .totals-item label {
    float: left;
    clear: both;
    width: 79%;
    text-align: right;
  }
  .totals .totals-item .totals-value {
    float: right;
    width: 21%;
    text-align: right;
  }
  .totals .totals-item-total {
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  }

  .checkout {
    float: right;
    border: 0;
    margin-top: 20px;
    padding: 6px 25px;
    background-color: #6b6;
    color: #fff;
    font-size: 25px;
    border-radius: 3px;
  }

  .checkout:hover {
    background-color: #494;
  }

  /* Make adjustments for tablet */
  @media screen and (max-width: 650px) {
    .shopping-cart {
      margin: 0;
      padding-top: 20px;
      border-top: 1px solid #eee;
    }

    .column-labels {
      display: none;
    }

    .product-image {
      float: right;
      width: auto;
    }
    .product-image img {
      margin: 0 0 10px 10px;
    }

    .product-details {
      float: none;
      margin-bottom: 10px;
      width: auto;
    }

    .product-price {
      clear: both;
      width: 70px;
    }

    .product-quantity {
      width: 100px;
    }
    .product-quantity input {
      margin-left: 20px;
    }

    .product-quantity:before {
      content: "x";
    }

    .product-removal {
      width: auto;
    }

    .product-line-price {
      float: right;
      width: 70px;
    }
  }
  /* Make more adjustments for phone */
  @media screen and (max-width: 350px) {
    .product-removal {
      float: right;
    }

    .product-line-price {
      float: right;
      clear: left;
      width: auto;
      margin-top: 10px;
    }

    .product .product-line-price:before {
      content: "Item Total: $";
    }

    .totals .totals-item label {
      width: 60%;
    }
    .totals .totals-item .totals-value {
      width: 40%;
    }
 
  }

  </style>
   <!-- ======= Header ======= -->
   <?php
include "../header.php"
 ?>
  <!-- ======= Sidebar ======= -->
  <?php

include "asideClient.php"

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





<h1 style="margin-bottom: 50px;">Panier</h1>

<div class="shopping-cart">

  <div class="column-labels">
    <label class="product-image">Image</label>
    <label class="product-details">Produit</label>
    <label class="product-price">Prix Unitaire</label>
    <label class="product-quantity">Quantite</label>
    <label class="product-removal">Operation</label>
    <label class="product-line-price">Total</label>
  </div>


  <?php
      $req=$conn->prepare("select pan.id,pro.libelle,pro.description,pro.prixVente,pro.image,pan.quantite from panier pan,produit pro where pan.idProduit=pro.id and idUser=:idUser2 and status='active'");
      $req->bindParam("idUser2",$_SESSION['idUser']);
      $req->execute();
      $total_de_total=0;  
      foreach($req as $row){
        $img = $row['image'];
        $titre = $row['libelle'];
        $desc = $row['description'];
        $price = $row['prixVente'];
        $qt = $row['quantite'];
        $id=  $row['id'];
        $total = $row['prixVente'] * $row['quantite'];
        $total_de_total=$total_de_total+$total;
        echo "<div class='product'><div class='product-image'><img src=../produit/images/$img></div><div class='product-details'>".
        "<div class='product-title'></div><p class='product-description' style='font-weight: bold;'>$titre<br></p><p>$desc</p></div><div class='product-price'>$price</div>".
        "<div class='product-quantity'>$qt</div><div class='product-removal'>".
        "<a href='sup_panier.php?id=$id' class='remove-product'>Supprimer</a></div><div class='product-line-price'>$total</div></div>";
      }
  ?>
  <div class="totals">
    <div class="totals-item">
      <label>Total</label>
      <div class="totals-value" id="cart-subtotal"><?php echo($total_de_total); ?></div>
    </div>
        <div class="totals-item">
      <label>Frais de Livraison</label>
      <div class="totals-value" id="cart-shipping">50.00</div>
    </div>
    <div class="totals-item totals-item-total">
      <label>Grand Total</label>
      <div class="totals-value" id="cart-total"><?php
      if(!empty($total_de_total)){
        echo $total_de_total + 50;
        $mytotal=$total_de_total+50; 
      }else{
        echo("0");
      }
      ?></div>
    </div>
  </div>
      <form method="POST">
      <button class="checkout" type="submit" name="valide">Valider</button>
    </form>
    <?php
    if(isset($_POST['valide'])){
      $req=$conn->prepare("insert into commande(Total,idUser,statut) values (:total,:idUser,'En cours de traitment')");
      $req->execute(array(
        'total' => $mytotal,
        'idUser' => $_SESSION['idUser']));
      $conn->exec("update panier set status='disable' where idUser=".$_SESSION['idUser']);
  
     
    }
     
    ?>
</div>


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