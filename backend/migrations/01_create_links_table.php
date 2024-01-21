<?php
class CreateLinksTable {
    public function up($mysqli) {
        $sql = "CREATE TABLE IF NOT EXISTS links (
            id INT AUTO_INCREMENT PRIMARY KEY,
            long_url VARCHAR(2048) NOT NULL,
            short_code VARCHAR(255) NOT NULL UNIQUE
        )";

        if ($mysqli->query($sql) === TRUE) {
            echo "Tabela 'links' criada com sucesso\n";
        } else {
            echo "Erro ao criar tabela 'links': " . $mysqli->error . "\n";
        }
    }
}
?>
