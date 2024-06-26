<style>
  * {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
  }

  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    overflow-x: hidden;

  }

  header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .logo {
    font-size: 20px;
    font-weight: bold;
  }

  #logo_link {
    transition: all ease-in-out .3s;
  }

  #logo_link:hover {
    color: #007BFF !important;
  }

  .hamburger {
    font-size: 24px;
    cursor: pointer;
    display: none;
  }

  nav {
    display: flex;
    align-items: center;
  }

  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
  }

  nav li {
    padding: 10px;
  }

  .main {
    display: flex;
    flex-wrap: wrap;
  }

  .sidebar {
    background-color: #f2f2f2;
    position: sticky;
    top: 60px;
    bottom: 0;
    min-height: calc(100vh - 60px);
    width: 250px;
  }

  .content {
    flex: 1;
    padding: 20px;
  }

  /* MAPA */
  .map-container {
    position: relative;
  }

  #map {
    width: 100%;
    height: 30vh;
  }

  /* DENUNCIAS */
  .ultimas_denuncias {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 5px;
    height: 100%;
  }

  .container_denuncias {
    margin: 10px;
  }

  .denuncia_item {
    padding: 10px;
    border: 2px solid #cccccc;
    border-radius: 8px;
    -webkit-box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
    box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
  }

  .denuncia_conteudo {
    display: flex;
    flex-direction: column;
    gap: 10px;
    justify-content: space-between;
    height: 100%;
  }

  .img {
    position: relative;
  }

  .card-img-top {
    object-fit: cover;
    height: 300px;
    border-radius: 8px;
  }

  .categoria {
    font-size: 12px;
    max-width: max-content;
    position: absolute;
    right: 10px;
    bottom: 5px;
  }

  .modal-header .btn-close {
    font-size: 1rem;
  }

  .grafico-container canvas {
    max-width: 100%;
  }

  .grafico-container h2 {
    margin-top: auto;
    margin-bottom: auto;
  }

  @media (max-width: 992px) {
    .denuncia_item {
      flex-basis: 100%;
      max-width: 100%;
    }
  }

  @media (max-width: 1330px) {
    .ultimas_denuncias {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 890px) {
    .ultimas_denuncias {
      display: grid;
      grid-template-columns: repeat(1, 1fr);
    }
  }



  /* Estilos para tornar o layout responsivo */

  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: center;
    }

    .hamburger {
      display: block;
    }

    nav {
      display: none;
      width: 100%;
      background-color: #333;
      color: #fff;
      text-align: center;
    }

    nav ul {
      flex-direction: column;
    }

    nav li:first-child {
      margin-top: 10px;
    }

    nav li:last-child {
      margin-bottom: 10px;
    }

    .main {
      flex-direction: column;
    }

    .sidebar {
      width: 100%;
      position: static;
      top: 0;
      min-height: auto;
    }

    .content {
      order: 1;
    }

    .sidebar.collapsed {
      display: none;
    }

    .header-mobile-visible {
      display: flex;
    }
  }

  /* SOBRE */
  @media(max-width:900px) {

    .sobre,
    .quem-sou {
      grid-template-columns: 1fr;
    }

    .sobre-info-titulo {
      font-size: 2rem;
    }

    .sobre-info-content {
      max-width: 100%;
    }

    .mais-detalhes-content {
      grid-template-columns: 1fr;
      gap: 10px;

      padding: 0;
    }

  }

  @media(max-width:450px) {
    .quem-sou-img img {
      max-width: 100%;
    }
  }

  @media(max-width:300px) {
    .mais-detalhes-content {
      display: none;
    }

    .hidden {
      display: block;
    }

    .sobre,
    .quem-sou {
      padding: 5px;
    }
  }
</style>