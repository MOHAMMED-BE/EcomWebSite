


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBM Store</title>
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
    <script  src="assets/BootStrap/js/bootstrap.js"></script>
    <script  src="assets/BootStrap/js/bootstrap.bundle.min.js"></script>
    <script  src="assets/BootStrap/js/bootstrap.min.js"></script>
    <script  src="assets/BootStrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="shortcut icon" href="assets/img/obmLogo.png" type="image/x-icon">


</head>
<body>

<?php
    session_start();

    include("header-page.php");
    include("connexion.php");
    ?>


    <section class='home'>
    
    <div class="HomePageContent">
        <article class="homeDesc">
            <span>OBM Store</span>
            <p>A website that allows people to buy and sell physical goods, services, and digital products over the internet rather than at a brick-and-mortar location.</p>
            <button> <a href="#sectionHeader">Start Shopping</a></button>
        </article>
        <article class="homeImg">
                    <img src="assets/img/bg4.png" alt="">
        </article>
    </div>

    </section>

    <?php

    $select = $conn->prepare("SELECT * from produit");
    $select->execute();

    if(isset($_GET['search'])){
        $idC  = $_GET['search'];
        $select = $conn->prepare("SELECT * from produit where idCateg = $idC");
        $select->execute();
    }

    echo "<section class='container mt-3 d-flex justify-content-evenly flex-wrap' id='sectionHeader'>
	<div class='section-header'>
		
		<h2 class='section-title'>Our products</h2>
		<span class='line'></span>

    </div>
    </section>";

    echo "<section class='container mt-3 d-flex justify-content-evenly flex-wrap' >";



    foreach($select as $value){
        $idProduit = $value['id'];

        echo "<article class='mt-4 size' >
            <a href=''>" . "<img class='rounded' src='" . "produit/images/" . $value['image']."' width='100' height='100' />" . 
            "  </a>
                <p>" . $value['libelle'] . "</p>
                <span>" . $value['prixAchat'] .  " MAD</span>
             <form class='form' method='POST'>
              <a  class='addToCart' target='_blank' href='detailsProduit.php?id=$idProduit'><i class='fa-solid fa-cart-plus'></i> ADD TO CART</a>
              </form>
        </article>";

    }

    echo "</section>";



    ?>


<footer class="foot">

<p>copyright &copy; <a href="index.php">OBM Store</a> 2022</p>

</footer>








</body>
</html>