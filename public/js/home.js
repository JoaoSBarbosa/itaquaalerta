function initMap(latitude, longitude) {
  const map = L.map("map").setView([latitude, longitude], 12);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  L.marker([latitude, longitude]).addTo(map);
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        initMap(latitude, longitude);
      },
      function (error) {
        console.error("Erro ao obter a localização do usuário:", error);
        const defaultLatitude = -23.543;
        const defaultLongitude = -46.736;
        initMap(defaultLatitude, defaultLongitude);
      }
    );
  } else {
    console.error("Geolocalização não é suportada neste navegador.");
    const defaultLatitude = -23.543;
    const defaultLongitude = -46.736;
    initMap(defaultLatitude, defaultLongitude);
  }
}

function getDenuncias(callback) {
  $.ajax({
    url: "get_denuncias.php",
    method: "GET",
    dataType: "json",
    success: function (denuncias) {
      callback(denuncias);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Erro ao obter denúncias:", textStatus, errorThrown);
      console.log(jqXHR.responseText); // Exibe a resposta recebida no console para depuração
      callback(null);
    },
  });
}

function displayDenuncias(denuncias) {
  const sliderInner = document.querySelector(
    "#denuncias-slider .carousel-inner"
  );
  sliderInner.innerHTML = ""; // Limpa o conteúdo anterior do slider

  denuncias.forEach((denuncia, index) => {
    const isActive = index === 0 ? "active" : ""; // Define a classe "active" para o primeiro slide
    const slide = `
      <div class="carousel-item ${isActive}">
        <img src="../upload/${denuncia.foto}" class="d-block w-100" alt="${denuncia.titulo}">
        <div class="carousel-caption">
          <h3>${denuncia.titulo}</h3>
          <p>${denuncia.descricao}</p>
        </div>
      </div>
    `;
    sliderInner.insertAdjacentHTML("beforeend", slide);
  });
}

$(document).ready(function () {
  getLocation();

  // Obtém as denúncias e exibe no slider ao carregar a página
  getDenuncias(function (denuncias) {
    if (denuncias) {
      displayDenuncias(denuncias);
    } else {
      console.error("Erro ao obter denúncias.");
    }
  });
});
