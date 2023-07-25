<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';
require_once '../modules/all_head.php';
?>

<body>
  <?php require_once '../modules/header.php' ?>
  <div class="main">
    <?php require_once '../modules/aside.php' ?>
    <div class="content" style="padding: 0;">
      <section class="overview">
        <div class="p-4">
          <h3 class="text-center mt-3">Todas as Denúncias</h3>
          <form method="get" class="mb-4">
            <div class="form-group">
              <label for="categoria">Filtrar por Categoria:</label>
              <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                <option value="">Todas as Categorias</option>
                <?php
                // Obter todas as categorias disponíveis do banco de dados
                $categorias = getAllCategorias();

                foreach ($categorias as $categoria) {
                  $nomeCategoria = $categoria['categoria'];
                  ?>
                  <option value="<?php echo $nomeCategoria; ?>" <?php if (isset($_GET['categoria']) && $_GET['categoria'] === $nomeCategoria)
                       echo 'selected'; ?>>
                    <?php echo $nomeCategoria; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </form>
          <div class="ultimas_denuncias my-4">

            <?php
            // Obtém todas as denúncias do banco de dados com base na categoria selecionada
            $categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
            $denuncias = getAllDenuncias($categoriaSelecionada);
            $numDenuncias = count($denuncias);

            if ($numDenuncias > 0) {
              foreach ($denuncias as $denuncia) {
                $titulo = $denuncia['titulo'];
                $descricao = $denuncia['descricao'];
                $imagem = $denuncia['foto'];
                $id = $denuncia['id'];
                $bairro = isset($denuncia['bairro_da_ocorrencia']) ? $denuncia['bairro_da_ocorrencia'] : null;
                $rua = isset($denuncia['rua_da_ocorrencia']) ? $denuncia['rua_da_ocorrencia'] : null;
                $data = isset($denuncia['data_da_ocorrencia']) ? $denuncia['data_da_ocorrencia'] : null;

                ?>
                <div class="denuncia_item ">
                  <div class="" style="height: 100%;">
                    <div class="denuncia_conteudo">
                      <div>
                        <figure class="img">
                          <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>" style="height: 225px; object-fit: cover;">
                          <span class="categoria bg-primary text-white rounded px-2 py-1" style="font-size: 12px;">
                            <?php echo $categoria['categoria']; ?>
                          </span>
                        </figure>
                        <h5 class="card-title align-self-start" style="margin: 10px 0px;">
                          <?php echo $titulo; ?>
                          <hr />
                        </h5>
                      </div>
                      <div style="display: flex; gap: 10px">
                        <?php if (!empty($bairro)): ?>
                          <span class="btn-light">
                            <?php echo $bairro; ?>
                          </span>
                        <?php endif; ?>

                        <?php if (!empty($rua)): ?>
                          <span class="btn-light">
                            <?php echo $rua; ?>
                          </span>
                        <?php endif; ?>
                        <?php if (!empty($data)): ?>
                          <span class="btn-light">
                            <?php echo $data; ?>
                          </span>
                        <?php endif; ?>
                      </div>
                      <?php echo $descricao; ?>
                      </p>
                    </div>




                  </div>
                </div>

                <?php
              }
            } else {
              echo '<div class="col-md-12 text-center"><p>Nenhuma denúncia encontrada.</p></div>';
            }
            ?>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="../public/js/aside.js"></script>

</body>

</html>