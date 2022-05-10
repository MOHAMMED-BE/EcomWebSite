

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="shortcut icon" href="./IMG/Icon.png" type="image/x-icon">
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="../Style/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"    href="../assets/BootStrap/css/bootstrap.min.css">

    <script  src="../assets/BootStrap/js/bootstrap.js"></script>
    <script  src="../assets/BootStrap/js/bootstrap.bundle.min.js"></script>
    <script  src="../assets/BootStrap/js/bootstrap.min.js"></script>
    <script  src="../assets/BootStrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/jQuery v3.6.0.js"></script>

    
    <link rel="stylesheet" href="../assets/css/style1.css">

</head>
<body>

<?php

session_start();
include("../connexion.php");

?>

    <!-- contact section -->
	 <div class="Overlay">
        <div class="contact">
            <!-- Header section -->
        <div class="section-header">         
            <h2 class="section-title">Contact Us</h2>
            <span class="line"></span> 
         </div><!-- ./Header section -->
 
             <div class="contact-info">
                <div class="contact-item">
                    <i class="fa fa-mobile"></i>
                    <h1 class="contact-item-title">phone</h1>
                    <span class="contact-item-info">212-20-08-70-60</span>
                </div><!-- ./contact-item -->

                <div class="contact-item">
                    <i class="fa fa-envelope"></i>
                    <h1 class="contact-item-title">email</h1>
                    <span class="contact-item-info">OBMStore@gmail.com</span>
                </div><!-- ./contact-item -->

                <div class="contact-item">
                    <i class="fa fa-map-marker"></i>
                    <h1 class="contact-item-title">address</h1>
                    <span class="contact-item-info">333 Lot Ihssan 08 El Jadida  Moroco</span>
                </div><!-- ./contact-item -->

             </div><!-- ./contact-info -->

             <div class="Contact-form">
                <form method="POST">
                    <input  class="Contact-form-email" name="subject" type="text" placeholder="Subject" required />
                    <span  id="email_span"></span>
                    <textarea id="Message" class="Contact-form-Message" name="message" placeholder="Message" required></textarea>
                    <span  id="Message_span"></span><br>
                    <!-- <button id="Send">Send message</button> -->
                    <input  id="Send" type="submit" name="Send" value="Send message" placeholder="Subject" />
                </form>
            </div>
        </div>
    </div><!-- ./contact section -->

    
<?php


if(isset($_SESSION['idUser'])){

    if(isset($_POST['Send'])){
        $subjectMsg = $_POST['subject'];
        $textMesg = $_POST['message'];
        $dateMsg = date('Y/m/d');
        $statutMsg = "unread";
        $idClient = $_SESSION['idUser'];

        $insert = $conn->prepare("INSERT into message(subjectMsg,textMsg,dateMsg,statutMsg,idClient) values(:subjectMsg,:textMsg,:dateMsg,:statutMsg,:idClient)");
       
        $insert->bindParam(':subjectMsg',$subjectMsg);
        $insert->bindParam(':textMsg',$textMesg);
        $insert->bindParam(':dateMsg',$dateMsg);
        $insert->bindParam(':statutMsg',$statutMsg);
        $insert->bindParam(':idClient',$idClient);

        if($insert->execute()){
            echo '<div class="alert alert-success alert-dismissible fade show  fixed-top top-0 text-center" role="alert">
            Your message was sent successfully  !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        else{
            die();
            echo '<div class="alert alert-danger alert-dismissible fade show  fixed-top top-0 text-center" role="alert">
            Your message was sent successfully  !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        
    }
    

}

else{
    header("REFRESH:0;URL=../pages-login.php");
}

?>


    
<script>

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>

</body>

</html>


