<?php

include "../connexion.php";
if(isset($_POST['nom_prod'])&&isset($_POST['marque_prod'])&&isset($_POST['desc_prod'])&&isset($_POST['prix_achat_prod'])&&isset($_POST['prix_vente_prod'])&&
isset($_POST['categorie_prod'])){
    $sql=$conn->prepare("insert into produit(libelle,marque,description,prixAchat,prixVente,quantite,image,idCateg)
     values(:libelle,:marque,:description,:prixAchat,:prixVente,:quantite,:image,:categorie)");

    $image = $_FILES['image_prod'];
    
    $imagetype = $_FILES['image_prod']['type'];
    $imageerror = $_FILES['image_prod']['error'];
    $imagetemp = $_FILES['image_prod']['tmp_name'];

    $fileTempPath = $_FILES['image_prod']['tmp_name'];
  
    $fileName = $_FILES['image_prod']['name'];

    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $imagePath = 'images/';

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $newFileName)) {
            echo "Sussecfully uploaded your image.";
        }
        else {
            echo "Failed to move your image.";
        }
    }
    else {
        echo "Failed to upload your image.";
    }

    
    try{
    $sql->execute(array(
    'libelle'=>$_POST['nom_prod'],
    'marque'=>$_POST['marque_prod'],
    'description'=>$_POST['desc_prod'],
    'prixAchat'=>(float)$_POST['prix_achat_prod'],
    'prixVente'=>(float)$_POST['prix_vente_prod'],
    'quantite'=>(int)$_POST['quantite_prod'],
    'image'=>$newFileName,
    'categorie'=>(int)$_POST['categorie_prod']
    ));
    header('Location: ajouter_produit.php?verf=true');
    }catch(PDOException $e){
        header('Location: ajouter_produit.php?verf=false');
    }
}else{
    echo "<script>alert(\"Erreur\")</script>";
}





?>