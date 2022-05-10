<?php

include "../connexion.php";

$id_client=$_GET['id_client'];
$detail='votre commande numero: '.$_GET['id'].'est valide';
$req=$conn->prepare("insert into notification(titre,detail,id_client,statut) values('commande valider',:detail,:id_client,'unread')");
$req->execute(array(
'detail'=>$detail,
'id_client'=>$id_client
));

$sql="UPDATE commande set statut='Traiter' where id=".$_GET['id'];

if($conn->query($sql)){
    header("location:liste_commande.php");

}else{
    echo"<script>alert(\"Erreur de validation\")
    window.location.href='liste_commande.php'
    </script>";
   
}


?>