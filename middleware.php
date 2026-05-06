<?php
// middleware.php — Segurança: valida antes de chegar no Controller

class Middleware {

    public function validar(array $dados): void {
        $nome  = trim($dados['nome']  ?? '');
        $idade = trim($dados['idade'] ?? '');
        $curso = trim($dados['curso'] ?? '');

        // Regra 1: todos os campos obrigatórios
        if (empty($nome) || empty($idade) || empty($curso)) {
            $this->encerrarComErro("⚠️ Todos os campos são obrigatórios!");
        }

        // Regra 2: idade deve ser um número inteiro positivo
        if (!ctype_digit($idade) || (int)$idade <= 0) {
            $this->encerrarComErro("⚠️ A idade deve ser um número válido!");
        }
    }

    private function encerrarComErro(string $mensagem): void {
        // Interrompe tudo e mostra o aviso — nunca chega no Controller
        echo "
        <!DOCTYPE html><html><head><meta charset='UTF-8'>
        <title>Aviso</title>
        <style>body{font-family:sans-serif;max-width:500px;margin:60px auto;padding:20px}</style>
        </head><body>
        <h2>⚠️ Validação falhou</h2>
        <p style='color:orange'>$mensagem</p>
        <a href='/'>← Voltar e corrigir</a>
        </body></html>";
        exit; // Encerra o script aqui mesmo
    }
}
