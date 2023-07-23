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

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Consultar as 3 últimas denúncias feitas pelo usuário
      // $sql = "SELECT titulo, descricao,categoria, foto FROM denuncias WHERE usuario_id = '$usuario_id' ORDER BY id DESC LIMIT 3";
      $sql = "SELECT titulo, descricao, categoria, foto FROM denuncias ORDER BY id DESC LIMIT 6";
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
function getAllDenuncias($categoriaSelecionada = null)
{
  global $conn;

  if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
    // O usuário está autenticado
    $usuario_id = $_SESSION["usuarioId"];

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Monta a query para consultar as denúncias
      $sql = "SELECT id, titulo, descricao, categoria, bairro_da_ocorrencia, rua_da_ocorrencia, numero_aproximado, data_da_ocorrencia, foto FROM denuncias";

      // Se uma categoria foi selecionada, filtra as denúncias por categoria
      if ($categoriaSelecionada) {
        $categoriaSelecionada = $conn->real_escape_string($categoriaSelecionada); // Evita SQL injection
        $sql .= " WHERE categoria = '$categoriaSelecionada'";
      }

      $sql .= " ORDER BY id DESC";

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

  return array(); // Caso o usuário não esteja autenticado ou não haja denúncias, retorna um array vazio
}
function getAllCategorias()
{
  global $conn;

  if ($conn) {
    // Use DISTINCT para obter apenas categorias únicas da tabela de denúncias
    $sql = "SELECT DISTINCT categoria FROM denuncias";
    $resultado = $conn->query($sql);

    $categorias = array();

    if ($resultado && $resultado->num_rows > 0) {
      while ($categoria = $resultado->fetch_assoc()) {
        $categorias[] = $categoria;
      }
    }

    return $categorias;
  } else {
    echo "Erro ao conectar ao banco de dados.";
  }

  return array();
}
function getDenunciasById()
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];

  if ($conn) {
    $sql = "SELECT id, titulo, descricao, categoria, bairro_da_ocorrencia, rua_da_ocorrencia, numero_aproximado, data_da_ocorrencia, foto FROM denuncias WHERE usuario_id = '$usuario_id' ORDER BY id DESC";
    $resultado = $conn->query($sql);
    if ($resultado && $resultado->num_rows > 0) {
      return $resultado->fetch_all(MYSQLI_ASSOC);
    }
  }

  return array();
}

function atualizarUsuario($email, $celular, $senha)
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];

  if ($conn) {
    // Realiza a atualização dos dados do usuário
    $sql = "UPDATE usuarios SET email = '$email', celular = '$celular'";

    if (!empty($senha)) {
      // Se o campo Nova Senha estiver preenchido, atualizamos também a senha
      $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
      $sql .= ", senha = '$senha_hash'";
    }
    $sql .= " WHERE id = '$usuario_id'";

    if ($conn->query($sql) === TRUE) {
      return true; // Dados do usuário atualizados com sucesso
    } else {
      return false; // Erro ao atualizar os dados do usuário
    }
  }
  return false; // Erro ao conectar ao banco de dados
}

function getUsuarioData()
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];
  if ($conn) {
    $sql = "SELECT nome, email, senha, data_nascimento, celular, id, foto_path FROM usuarios WHERE id = '$usuario_id'";
    $resultado = $conn->query($sql);
    if ($resultado && $resultado->num_rows > 0) {
      return $resultado->fetch_assoc();
    }
  }

  return array();
}
function getFotoPerfil()
{
  $dadosUsuario = getUsuarioData();
  if (!empty($dadosUsuario['foto_path'])) {
    return $dadosUsuario['foto_path'];
  } else {
    return 'caminho_para_foto_padrao.jpg'; // Caminho para a foto padrão caso não haja foto do perfil
  }
}
// Função para obter as categorias com mais ocorrências
function getCategoriasMaisOcorrencias()
{
  global $conn;
  $sql = "SELECT categoria, COUNT(*) as total FROM denuncias GROUP BY categoria ORDER BY total DESC LIMIT 5";
  $resultado = $conn->query($sql);

  $dados = array();
  while ($row = $resultado->fetch_assoc()) {
    $dados[$row['categoria']] = $row['total'];
  }

  return $dados;
}

// Função para obter os bairros com mais ocorrências
function getBairrosMaisOcorrencias()
{
  global $conn;
  $sql = "SELECT bairro_da_ocorrencia, COUNT(*) as total FROM denuncias GROUP BY bairro_da_ocorrencia ORDER BY total DESC LIMIT 5";
  $resultado = $conn->query($sql);

  $dados = array();
  while ($row = $resultado->fetch_assoc()) {
    $dados[$row['bairro_da_ocorrencia']] = $row['total'];
  }

  return $dados;
}

// Função para obter as ruas com mais ocorrências
function getRuasMaisOcorrencias()
{
  global $conn;
  $sql = "SELECT rua_da_ocorrencia, COUNT(*) as total FROM denuncias GROUP BY rua_da_ocorrencia ORDER BY total DESC LIMIT 5";
  $resultado = $conn->query($sql);

  $dados = array();
  while ($row = $resultado->fetch_assoc()) {
    $dados[$row['rua_da_ocorrencia']] = $row['total'];
  }

  return $dados;
}
?>