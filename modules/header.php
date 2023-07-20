<header>
  <!-- MENU SUPERIOR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Itaquá Alerta <i class="fas fa-bullhorn"></i>
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

        <!-- Mantém o formulário de pesquisa à direita -->
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </div>
        </form>

        <!-- Centraliza o texto apenas em dispositivos menores que md -->
        <span class="nav-link text-center d-md-none">Bem-vindo(a),
          <?php echo $_SESSION["usuarioNome"]; ?>
        </span>
      </div>
    </div>
  </nav>
</header>