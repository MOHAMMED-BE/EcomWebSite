<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="assets/css/styleDetails.css">
    <script src="assets/js/jQuery v3.6.0.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet"    href="assets/BootStrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet"    href="assets/BootStrap/js/bootstrap.js">
    <link rel="stylesheet"    href="assets/BootStrap/js/bootstrap.min.js">
    <link rel="stylesheet"    href="assets/BootStrap/js/bootstrap.bundle.js">
    <link rel="stylesheet" type="text/css"    href="assets/BootStrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="shortcut icon" href="assets/img/obmLogo.png" type="image/x-icon">


</head>
<body>


<?php

session_start();

    include("connexion.php");
    include("header-page.php");

    $idProduit = $_GET['id'];
    $select = $conn->prepare("SELECT * from produit where id=$idProduit");
    $select->execute();
    $select = $select->fetchObject();

    $checkCountProduit = $conn->prepare("SELECT * from produit where id=$idProduit");
    $checkCountProduit->execute();
    $checkQuantite = $select->quantite;
    $Available = "";
    if($checkQuantite > 0){
        $Available = "in stock";
    }
    else{
        $Available = "out of stock";
    }

    $idCateg = $select->idCateg;
    $getCategorie = $conn->prepare("SELECT * from categorie where id=$idCateg");
    $getCategorie->execute();
    $getCategorie = $getCategorie->fetchObject();

    
// Add To Cart

if(isset($_POST['addTo'])){
    if(isset($_SESSION['idUser'])){
    
        $addToPanier = $conn->prepare("INSERT INTO panier(id,idProduit, idUser, prixUnit, quantite, status, idCommande)
                            VALUES(:idPanier,:idProduit,:idUser,:prixUnit,:quantite,:status,NULL)");

        $getPrix = $conn->prepare("SELECT prixAchat from produit where id=" .  $idProduit );
        $getPrix->execute();
        $getPrix = $getPrix->fetchObject();
        
        $idUser = $_SESSION['idUser'];
        $prixUnit = $getPrix->prixAchat ;
        $quantite = $_POST['quantite'];
        $status = 'active';
        
        $date = date('dMYis');
        $idPanier = $date . 'C' . $idUser . 'P' . $idProduit;


        $addToPanier->bindParam(':idPanier',$idPanier);
        $addToPanier->bindParam(':idProduit',$idProduit);
        $addToPanier->bindParam(':idUser',$idUser);
        $addToPanier->bindParam(':prixUnit',$prixUnit);
        $addToPanier->bindParam(':quantite',$quantite);
        $addToPanier->bindParam(':status',$status);

        if($addToPanier->execute()){
            echo '<div class="alert alert-success alert-dismissible fade show  fixed-top top-0 text-center" role="alert">
            Article Added to panel !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
       
    }
        

}



    ?>


<div class = "card-wrapper">
  <div class = "card_">
    <!-- card left -->
    <div class = "img-display">
        <?php echo "<img src='" . "produit/images/" .  $select->image ."' />"  ?>
      </div>
      
    <!-- card right -->
    <div class = "product-content">
      <h2 class = "product-title"><?php echo $select->libelle?></h2>
      <div class = "product-price">
        <p class = "new-price">New Price: <span><?php echo $select->prixAchat?> $</span></p>
      </div>

      <div class = "product-detail">
        <h2>about this item: </h2>
        <p><?php echo $select->description?></p>
        <ul>
          <li>Available: <span><?php  echo $Available ?></span></li>
          <li>Category: <span><?php echo $getCategorie->Name ?></span></li>
          <li>Shipping Area: <span>All over the world</span></li>
          <li>Shipping Fee: <span>Free</span></li>
        </ul>
      </div>

      <div class = "purchase-info">
        <form method="POST">
        <input type = "number" min = "0" value = "1" name="quantite">
        <button type = "submit" name="addTo" class = "btnAddTo">
        <i class='fa-solid fa-cart-plus'></i> Add To Cart
        </button>
        </form>
      </div>

    </div> <!-- product-content close -->
  </div><!-- card close -->
  </div>


<script>

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>




</body>
</html>