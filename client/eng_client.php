<?php

include "../connexion.php";

$email=$_POST['email'];
$sql1="select email from user where email='$email'";
$res=$conn->query($sql1);
$don=$res->fetch();

if($don['email']!=""){
    
    echo"<script>alert(\"L'email déja existe\")
    window.location.href='ajouter_client.php'
    </script>";
}else{
    if($_POST["password"]==$_POST["con_password"]){

        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])){
    
            $sql=$conn->prepare("insert into user(nom,prenom,email,password,role) values(:nom,:prenom,:email,:password,'Admin')");
        
            try{
            $sql->execute(array(
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'email'=>$_POST['email'],
            'password'=>$_POST['password']
         
            ));
            header('Location: ajouter_client.php?verf=true');
            }catch(PDOException $e){
                header('Location: ajouter_client.php?verf=false');
            }
        }
    }else{
        header('Location: ajouter_client.php?verf=falsepass');
    }
}









?>