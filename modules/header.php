<header>
  <!-- MENU SUPERIOR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./home.php">Itaquá Alerta <i class="fas fa-bullhorn"></i>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Centraliza o texto apenas em dispositivos maiores que md -->
          <li class="nav-item d-none d-md-block">
            <span class="nav-link text-center">Bem-vindo(a),
              <?php echo $_SESSION["usuarioNome"]; ?>
            </span>
          </li>
        </ul>
        <!-- Ícones para GitHub e LinkedIn -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/seu_usuario" target="_blank">
              <i class="fab fa-github fa-2x"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.linkedin.com/in/seu_usuario" target="_blank">
              <i class="fab fa-linkedin fa-2x"></i>
            </a>
          </li>
        </ul>
        <!-- Botão de Logout -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Sair</a>
          </li>
        </ul>



        <!-- Centraliza o texto apenas em dispositivos menores que md -->
        <span class="nav-link text-center d-md-none">Bem-vindo(a),
          <?php echo $_SESSION["usuarioNome"]; ?>
        </span>
      </div>
    </div>
  </nav>
</header>