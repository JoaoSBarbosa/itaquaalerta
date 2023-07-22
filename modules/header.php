<header>
  <div class="logo">
    <a class="navbar-brand text-white hover:text-black" href="./home.php" id="logo_link">Itaquá Alerta <i class="fas fa-bullhorn"></i></a>
  </div>
  <div class="hamburger" onclick="toggleSidebar()">&#9776;</div>
  <nav class="d-none d-md-flex">
    <ul class="d-flex flex-row align-items-center justify-content-between">
      <!-- Exibir a foto de perfil -->
      <?php $fotoPerfil = getFotoPerfil(); ?>
      <li class="nav-item">
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de Perfil" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
      </li>
      <li class="nav-link text-center">Bem-vindo(a),
        <?php echo $_SESSION["usuarioNome"]; ?>
      </li>
      <li class="nav-item">
        <a class="btn btn-danger" href="logout.php">Sair</a>
      </li>
    </ul>
  </nav>
</header>

<!-- Menu do header para dispositivos móveis -->
<nav class="mobile-menu d-md-none">
  <ul class="d-flex flex-column w-100 align-items-center">
    <li>Bem-vindo, Usuário</li>
    <li>Menu Sair</li>
  </ul>
</nav>