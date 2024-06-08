$(document).ready(function () {
  // Função para manipular a classe "active" nos itens de menu
  function setActiveMenu() {
    var path = window.location.pathname;
    var currentPage = path.split("/").pop();

    $(".list-group-item").each(function () {
      var link = $(this).attr("href").split("/").pop();
      if (currentPage === link) {
        $(this).addClass("active");
      } else {
        $(this).removeClass("active");
      }
    });
  }

  // Chamando a função quando a página é carregada
  setActiveMenu();

  // Chamando a função sempre que um link da lista é clicado
  $(".list-group-item").on("click", function () {
    setActiveMenu();
  });
});
