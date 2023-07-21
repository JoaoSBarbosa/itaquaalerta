<header>
  <!-- MENU SUPERIOR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./home.php">Itaquá Alerta <i class="fas fa-bullhorn"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Exibição de "Bem-vindo(a), [nome do usuário]" tanto em dispositivos móveis quanto em desktops -->
          <li class="nav-item">
            <span class="nav-link text-center">Bem-vindo(a),
              <?php echo $_SESSION["usuarioNome"]; ?>
            </span>
          </li>
        </ul>
        <!-- Ícones para GitHub e LinkedIn (agora ao lado um do outro no mobile) -->
        <ul class="navbar-nav d-flex flex-row align-items-center justify-content-between gap-lg-4 gap-md-4">
          <li class="nav-item">
            <a class="nav-link" href="https://joaosbarbosa.com.br/" target="_blank" title="Portfólio">
              <i class="fas fa-briefcase fa-2x"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/JoaoSBarbosa/itaquaalerta" target="_blank" title="Repositório">
              <i class="fab fa-github fa-2x"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.linkedin.com/in/devjbarbosa/" target="_blank">
              <i class="fab fa-linkedin fa-2x"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger" href="logout.php">Sair</a>
          </li>
        </ul>
        <!-- Botão de Logout (agora na direita) -->
        <!-- <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="btn btn-danger" href="logout.php">Sair</a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>
</header>