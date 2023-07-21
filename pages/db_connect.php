<!-- db_coonect.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itaqua_alerta";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
// if ($conn->connect_error) {
//   die("Erro na conexão com o banco de dados: " . $conn->connect_error);
// }
// Verifica a conexão
if ($conn->connect_error) {
  die("Erro na conexão com o banco de dados: " . $conn->connect_error);
} else {

}
// Função para obter as denúncias do banco de dados
function getDenuncias()
{
  global $conn; // Torna a variável $conn globalmente acessível dentro da função

  if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
    // O usuário está autenticado
    $usuario_id = $_SESSION["usuarioId"];

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Consultar as 3 últimas denúncias feitas pelo usuário
      $sql = "SELECT titulo, descricao,categoria, foto FROM denuncias WHERE usuario_id = '$usuario_id' ORDER BY id DESC LIMIT 3";
      $resultado = $conn->query($sql);

      $denuncias = array();

      if ($resultado && $resultado->num_rows > 0) {
        while ($denuncia = $resultado->fetch_assoc()) {
          $denuncias[] = $denuncia;
        }
      }

      return $denuncias;
    } else {
      echo "Erro ao conectar ao banco de dados.";
    }
  }

  return array(); // Caso o usuário não esteja autenticado ou não tenha denúncias, retorna um array vazio
}
?>