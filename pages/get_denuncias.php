<?php
// get_denuncias.php
require_once 'db_connect.php'; // Inclua o arquivo de conexão com o banco de dados
require_once '../validator/validador_acesso.php';

// Consultar as denúncias feitas pelo usuário
function getDenunciasFromDatabase()
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];

  $sql = "SELECT titulo, descricao, foto FROM denuncias WHERE usuario_id = '$usuario_id' ORDER BY id DESC LIMIT 3";
  $result = $conn->query($sql);

  $denuncias = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $denuncias[] = $row;
    }
  }

  return $denuncias;
}

// Retorna as denúncias em formato JSON
header('Content-Type: application/json');
echo json_encode(getDenunciasFromDatabase());
?>