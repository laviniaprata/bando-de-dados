<?php
// model.php — Única camada que fala com o banco de dados

class AlunoModel {
    // Propriedades privadas: só a própria classe pode acessar diretamente
    private string $nome;
    private int    $idade;
    private string $curso;

    // --- GETTERS (leitura) ---
    public function getNome():  string { return $this->nome;  }
    public function getIdade(): int    { return $this->idade; }
    public function getCurso(): string { return $this->curso; }

    // --- SETTERS (escrita) ---
    public function setNome(string $nome):   void { $this->nome  = $nome;  }
    public function setIdade(int $idade):    void { $this->idade = $idade; }
    public function setCurso(string $curso): void { $this->curso = $curso; }

    // Salva o aluno no banco usando Prepared Statements (proteção contra SQL Injection)
    public function save(): void {
        $pdo = new PDO('sqlite:' . __DIR__ . '/database.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // O :nome, :idade, :curso são placeholders — nunca texto do usuário direto
        $stmt = $pdo->prepare("
            INSERT INTO alunos (nome, idade, curso)
            VALUES (:nome, :idade, :curso)
        ");

        $stmt->execute([
            ':nome'  => $this->nome,
            ':idade' => $this->idade,
            ':curso' => $this->curso,
        ]);
    }
}
