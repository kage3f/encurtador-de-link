<?php

class CreateAccessesTable {
    public function up($mysqli) {
        $sql = "CREATE TABLE IF NOT EXISTS accesses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            link_id INT NOT NULL,
            accessed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (link_id) REFERENCES links(id)
        )";

        if ($mysqli->query($sql) === TRUE) {
            echo "Tabela 'accesses' criada com sucesso\n";
        } else {
            echo "Erro ao criar tabela 'accesses': " . $mysqli->error . "\n";
        }
    }
}
?>
