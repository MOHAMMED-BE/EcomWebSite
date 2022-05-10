<?php

include "../connexion.php";


$sql="delete from commande where id=".$_GET["id"];
if($conn->query($sql)){
    header("location:liste_commande.php");

}else{
    echo"<script>alert(\"Erreur de Suppression\")
    window.location.href='liste_commande.php'
    </script>";
   
}

?>