<?php
include '../config/Database.php'; // Assegure-se que o caminho está correto

$mysqli = Database::getConnection(); // Estabeleça a conexão aqui

if (isset($_GET['code'])) {
    $shortCode = $_GET['code'];

    $stmt = $mysqli->prepare("SELECT id, long_url FROM links WHERE short_code = ?");
    $stmt->bind_param("s", $shortCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $linkId = $row['id'];

        // Registrar o acesso
        $stmtAccess = $mysqli->prepare("INSERT INTO accesses (link_id) VALUES (?)");
        $stmtAccess->bind_param("i", $linkId);
        $stmtAccess->execute();

        // Redirecionamento
        header("Location: " . $row['long_url']);
    } else {
        echo "URL curta não encontrada";
    }
} else {
    echo "Código curto não fornecido";
}
