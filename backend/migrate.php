<?php

$servername = "localhost";
$username = "root";
$password = "91034161";
$database = "encurta";

// Conectar ao servidor MySQL
$mysqli = new mysqli($servername, $username, $password);

// Verificar conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Criar o banco de dados se ele não existir
if ($mysqli->query("CREATE DATABASE IF NOT EXISTS $database") === TRUE) {
    echo "Banco de dados criado com sucesso ou já existe\n";
} else {
    echo "Erro ao criar banco de dados: " . $mysqli->error . "\n";
}

// Conectar ao banco de dados
$mysqli->select_db($database);

// Cria a tabela de migrations se ela não existir
$mysqli->query("CREATE TABLE IF NOT EXISTS migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Aqui, você deve listar todas as suas migrations
$migrations = [
    '01_create_links_table.php',
    '02_create_accesses_table.php',
    // Adicione mais arquivos de migration conforme necessário
];

// Verifica quais migrations já foram aplicadas
$appliedMigrations = [];
$result = $mysqli->query("SELECT migration FROM migrations");
while ($row = $result->fetch_assoc()) {
    $appliedMigrations[] = $row['migration'];
}

foreach ($migrations as $migration) {
    if (in_array($migration, $appliedMigrations)) {
        continue; // Esta migration já foi aplicada
    }

    require_once 'migrations/' . $migration;
    $className = "CreateAccessesTable"; // Se o nome da classe é CreateLinksTable
    $instance = new $className();
    $instance->up($mysqli);

    $stmt = $mysqli->prepare("INSERT INTO migrations (migration) VALUES (?)");
    $stmt->bind_param("s", $migration);
    $stmt->execute();
    echo "Aplicada migration: " . $migration . "\n";
}


$mysqli->close();
?>
