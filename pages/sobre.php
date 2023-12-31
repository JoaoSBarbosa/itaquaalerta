<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';
?>
<body>
  <?php
  require_once '../modules/header.php'
    ?>
  <div class="main">
    <?php
    require_once '../modules/aside.php'
      ?>
    <div class="content" style="padding: 0;">
      <section class="overview">
        <div class="container_denuncias">
          <div>
            <section class="sobre">
              <div class="sobre-info">
                <div class="sobre-info-content">
                  <h1 class="sobre-info-titulo">Atividade Extensionista
                    <a href="https://www.uninter.com/noticias/atividades-extensionistas-a-revolucao-do-ensino-superior" target="_black">Uninter</a>
                  </h1>
                  <div class="sobre-info-desc">
                    <p>O presente trabalho visa apresentar um projeto para o desenvolvimento de aplicativo mobile para o mapeamento de problemas urbanos, para auxiliar a população na fiscalização e participação na gestão pública com o foco na ODS de Cidades e Comunidades Sustentáveis.</p>

                    <p>Esse projeto visa ser uma ferramenta para os cidadãos onde poderão enviar suas denúncias, bastando fotografar a ocorrência e inserir os detalhes. Será necessário realizar um cadastro simples com autenticação para evitar denúncias falsas e sobrecarregamento de fake news. Espera-se que esse projeto ajude a população local a direcionar os problemas aos representantes do município.</p>
                  </div>
                </div>
              </div>
              <div class="sobre-img">
                <img src="../public/img/sobre.svg" alt="">
              </div>
            </section>
            <section class="mais-detalhes" style="background-color: #007BFF;">
              <div class=" py-5">
                <h2 class="text-white">Mais detalhes</h2>

                <div class="mais-detalhes-content">

                  <div class="mais-detalhes-card">
                    <h5 class="card-title">Fotos</h5>
                    <p>
                      As denúncias serão acompanhadas de fotos para descrever detalhadamente a ocorrência e sua localização. O sistema utilizará o GPS para garantir maior precisão no registro do local informado.
                    </p>
                  </div>

                  <div class="mais-detalhes-card">
                    <h5 class="card-title">Localidade</h5>
                    <p>
                      Nosso sistema tem como foco atender o bairro local, abrangendo ruas do bairro e áreas próximas. Dessa forma, garantimos maior agilidade e eficiência no tratamento das denúncias recebidas.
                    </p>
                  </div>
                  <div class="mais-detalhes-card">
                    <h5 class="card-title">Cadastro</h5>
                    <p>
                      Para garantir a veracidade das informações e reduzir a disseminação de notícias falsas, solicitamos um breve cadastro de todos os usuários antes de realizar uma denúncia. Além disso, esse registro nos permite manter um histórico confiável de cada ocorrência.
                    </p>
                  </div>
                </div>

              </div>
              <div class="hidden" style="color:#fff">
                <p>
                  As denúncias serão acompanhadas de fotos para descrever detalhadamente a ocorrência e sua localização. O sistema utilizará o GPS para garantir maior precisão no registro do local informado.
                </p>
                <p>
                  Para garantir a veracidade das informações e reduzir a disseminação de notícias falsas, solicitamos um breve cadastro de todos os usuários antes de realizar uma denúncia. Além disso, esse registro nos permite manter um histórico confiável de cada ocorrência.
                </p>
                <p>
                  Nosso sistema tem como foco atender o bairro local, abrangendo ruas do bairro e áreas próximas. Dessa forma, garantimos maior agilidade e eficiência no tratamento das denúncias recebidas.
                </p>
              </div>
            </section>

            <section class="quem-sou">
              <!-- Coluna 1 -->
              <div class="quem-sou-img">
                <img src="../public/img/developer.svg" alt="">
              </div>
              <!-- Coluna 2 -->
              <div class="quem-sou-info">
                <h1 class="quem-sou-titulo">Sobre o desenvolvedor do projeto</h1>
                <p>Desenvolvedor graduando Análise e Desenvolvimento de Sistemas pelo Centro Universitário Internacional UNINTER. Experiência com as linguagens JavaScript, PHP, Java e frameworks como: Spring, Angular, React e Bootstrap.</p>
                <ul class="list-unstyled">
                  <li class="my-2">
                    <h3>HARD SKILLS</h3>
                    <div id="tecnologias">
                      <i class="devicon-git-plain-wordmark"></i>
                      <i class="devicon-javascript-plain"></i>
                      <i class="devicon-java-plain-wordmark"></i>
                      <i class="devicon-typescript-plain"></i>
                      <i class="devicon-react-original-wordmark"></i>
                      <i class="devicon-html5-plain-wordmark"></i>
                      <i class="devicon-tailwindcss-plain"></i>
                      <i class="devicon-mysql-plain-wordmark"></i>
                      <i class="devicon-php-plain"></i>
                      <i class="devicon-bootstrap-plain"></i>
                      <i class="devicon-sass-original"></i>
                      <i class="devicon-angularjs-plain colored"></i>
                      <i class="devicon-spring-plain-wordmark"></i>
                      <i class="devicon-nodejs-plain-wordmark"></i>
                      <i class="devicon-wordpress-plain-wordmark"></i>
                    </div>
                  </li>

                  <li>
                    <h3>Links</h3>
                    <div class="" id="">
                      <a class="btn btn-primary " href="https://www.linkedin.com/in/devjbarbosa/" target="_black">LinkedIn</a>
                      <a class="btn btn-dark mx-2" href="https://github.com/JoaoSBarbosa" target="_black">GitHub</a>
                      <a class="btn btn-info" href="https://joaosbarbosa.com.br/" target="_black">Portfolio</a>
                    </div>
                  </li>
                </ul>


              </div>

            </section>

          </div>
        </div>


      </section>
    </div>
  </div>
  <!-- Script para o mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


</body>

</html>