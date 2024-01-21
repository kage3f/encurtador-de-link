<?php
include '../config/Database.php'; // Assegure-se que o caminho está correto

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$mysqli = Database::getConnection(); // Estabeleça a conexão aqui

switch ($method) {
    case 'POST':
        handlePostRequest($mysqli);
        break;
    case 'GET':
        handleGetRequest($mysqli);
        break;
    case 'DELETE':
        handleDeleteRequest($mysqli);
        break;
    default:
        http_response_code(405); // Método não permitido
        echo json_encode(["error" => "Método não permitido"]);
        break;
}

function handlePostRequest($mysqli) {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    if (isset($input['long_url'])) {
        $longUrl = filter_var($input['long_url'], FILTER_SANITIZE_URL);

        if (!filter_var($longUrl, FILTER_VALIDATE_URL) || strlen($longUrl) > 2048) {
            http_response_code(400);
            echo json_encode(["error" => "URL inválida ou muito longa"]);
            exit;
        }

        $shortCode = substr(md5(uniqid(rand(), true)), 0, 6);
        $stmt = $mysqli->prepare("INSERT INTO links (long_url, short_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $longUrl, $shortCode);
        $stmt->execute();

        echo json_encode(["short_url" => "https://tiagotech.xyz/" . $shortCode], JSON_UNESCAPED_SLASHES);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Dados ausentes"]);
    }
} 


function handleGetRequest($mysqli) {
    $query = "SELECT l.id, l.long_url, l.short_code, COUNT(a.id) AS access_count 
    FROM links l 
    LEFT JOIN accesses a ON l.id = a.link_id 
    GROUP BY l.id";

$result = $mysqli->query($query);

$links = [];
while ($row = $result->fetch_assoc()) {
$links[] = [
  'id' => $row['id'],
  'long_url' => $row['long_url'],
  'short_code' => $row['short_code'],
  'access_count' => $row['access_count']
];
}

echo json_encode($links);
}

function handleDeleteRequest($mysqli) {
    // Verificando se o ID foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $stmt = $mysqli->prepare("DELETE FROM links WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($mysqli->affected_rows > 0) {
            http_response_code(200);
            echo json_encode(["message" => "Link deletado com sucesso"]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Link não encontrado"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "ID não fornecido"]);
    }
}
