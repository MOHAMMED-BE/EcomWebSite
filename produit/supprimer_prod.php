<?php

include "../connexion.php";


$sql="delete from produit where id=".$_GET["id"];
if($conn->query($sql)){
echo "alert('mzyan')";
header("location:liste_produit.php");

}else{
    echo "alert('noo')";
}

?>