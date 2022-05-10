<?php

include "../connexion.php";


$sql="delete from user where id=".$_GET["id"];
if($conn->query($sql)){
    header("location:liste_client.php");

}else{
    echo"<script>alert(\"Erreur de Suppression\")
    window.location.href='liste_client.php'
    </script>";
   
}

?>