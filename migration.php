<?php
// migration.php — Roda UMA vez para criar o banco de dados

class Migration {
    public function run(): void {
        // PDO conecta ao SQLite. O arquivo .sqlite é criado automaticamente se não existir.
        $pdo = new PDO('sqlite:' . __DIR__ . '/database.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS alunos (
                id     INTEGER PRIMARY KEY AUTOINCREMENT,
                nome   TEXT    NOT NULL,
                idade  INTEGER NOT NULL,
                curso  TEXT    NOT NULL
            )
        ");

        echo "✅ Banco de dados criado com sucesso! Tabela 'alunos' está pronta.\n";
    }
}

$migration = new Migration();
$migration->run();
