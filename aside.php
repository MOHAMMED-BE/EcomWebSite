<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="../dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
    
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#commande-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Commande</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="commande-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../commande/liste_commande.php">
              <i class="bi bi-circle"></i><span>Liste Des Commande</span>
            </a>
          </li>
        </ul>
      </li><!-- End commande Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#produit-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Produit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="produit-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../produit/ajouter_produit.php">
              <i class="bi bi-circle"></i><span>Ajouter un Produit</span>
            </a>
          </li>
          <li>
            <a href="../produit/liste_produit.php">
              <i class="bi bi-circle"></i><span>Liste des Produits</span>
            </a>
          </li>
        </ul>
      </li><!-- End Produit Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#client-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Utilisateur</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="client-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../client/ajouter_client.php">
              <i class="bi bi-circle"></i><span>Ajouter un Utilisateur</span>
            </a>
          </li>
          <li>
            <a href="../client/liste_client.php">
              <i class="bi bi-circle"></i><span>Liste des Utilisateur</span>
            </a>
          </li>
        </ul>
      </li><!-- End Client Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../user/users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

  
    </ul>

  </aside><!-- End Sidebar-->