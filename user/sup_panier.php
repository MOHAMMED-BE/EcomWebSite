<?php

include "../connexion.php";

$id=$_GET['id'];
$sql="delete from panier where id='$id'";

if($conn->query($sql)){
header("location:panier.php");

}else{
    echo "alert('noo')";
}

?>