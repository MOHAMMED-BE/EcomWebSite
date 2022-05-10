
<?php


include("connexion.php");
$select = $conn->prepare("SELECT * from categorie");
$select->execute();


if(isset($_POST['register'])){
    header("REFRESH:0;URL =  pages-register.php");
}

if(isset($_POST['login'])){
    header("REFRESH:0;URL =  pages-login.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("REFRESH:0;URL =  index.php");
}

?>

<header class="header">

    <nav class='navbar navbar-expand-lg navbar-light bg-light '>
        <div class='container-fluid ms-5'>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>

                <li class=''>
                <img src="assets/img/obmLogo1.png" alt="" style="width: 64px;height: 36px">
                </li>
                <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='index.php'>Home</a>
                </li>
               
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Categorie
                </a>
                <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                <form method='GET'>
            <?php


                foreach($select as $value){
                    echo  "
                    <li><button class='dropdown-item' name='search' value=" . $value['id'] . "> " . $value['Name'] . " </button></li>";
                }

                
            ?>
                </form>
                </ul>
                </li>

                <li class='nav-item'>
                <a class='nav-link active'  href='dashboard.php' target='_blank'>Dashboard</a> <!-- aria-current='page' -->
                </li>
                <li class='nav-item'>
                <a class='nav-link active'  href='contactUs/contactUs.php'  target='_blank'>Contact US</a>
                </li>
            </ul>
            <form class='d-flex' method='POST'>

            <?php


            if(isset($_SESSION['idUser'])){
                $idUser = $_SESSION['idUser'];
                $select = $conn->prepare("SELECT count(*) from panier where idUser = :idUser and status='active'");
                $select->bindParam(':idUser',$idUser);
                $select->execute();
                $count = $select->fetchColumn();

                echo '<a class="nav-link nav-icon" href="user/panier.php" target="_blank">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 23px;color: #ffa701;"></i>
                        <span class="badge bg-primary badge-number" 
                        style="position: relative;
                        inset: -10px 8px auto auto;
                        font-weight: normal;
                        font-size: 11px;
                        padding: 3px 6px;
                        background-color: #52575d !important;">' . $count .'</span>
                    </a>';
            }
            

      ?>

            <button name='register' class='btn btn-outline-dark mx-3'  type='submit'>Sign UP</button>
                
                <?php
                // session_start();
                    if(!isset($_SESSION['idUser'])){
                        echo "<button name='login' class='btn btn-outline-dark mx-3'  type='submit'>Sign IN</button>";
                    }
                    else{
                        echo "<button name='logout' class='btn btn-outline-dark mx-3'  type='submit'>Log Out</button>";
                    }


    
                  
                ?>
            </form>
            </div>
        </div>
    </nav>


</header>
