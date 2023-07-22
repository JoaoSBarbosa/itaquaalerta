function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  sidebar.classList.toggle("collapsed");

  // Oculta ou exibe o menu do header para dispositivos móveis
  const headerMobile = document.querySelector(".mobile-menu");
  headerMobile.classList.toggle("header-mobile-visible");
}

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

// Chamar a função getLocation() assim que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function () {
  getLocation();
});

function getDenuncias(callback) {
  $.ajax({
    url: "../pages/get_denuncias.php",
    method: "GET",
    dataType: "json",
    success: function (denuncias) {
      callback(denuncias);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Erro ao obter denúncias:", textStatus, errorThrown);
      callback(null);
    },
  });
}

function displayDenuncias(denuncias) {
  const denunciasContainer = document.getElementById("denuncias-container");
  denunciasContainer.innerHTML = ""; // Limpa o conteúdo anterior do container

  denuncias.forEach((denuncia) => {
    const { titulo, descricao, foto } = denuncia;
    const card = `
      <div class="col mb-4">
        <div class="card h-100">
          <img src="../upload/${foto}" class="card-img-top" alt="${titulo}">
          <div class="card-body">
            <h5 class="card-title">${titulo}</h5>
            <p class="card-text">${descricao}</p>
          </div>
        </div>
      </div>
    `;
    denunciasContainer.insertAdjacentHTML("beforeend", card);
  });
}

function getDenunciasAndDisplay() {
  getDenuncias(function (denuncias) {
    if (denuncias) {
      displayDenuncias(denuncias);
    } else {
      console.error("Erro ao obter denúncias.");
    }
  });
}

$(document).ready(function () {
  getLocation();
});
