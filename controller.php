<?php
require_once 'model.php';
require_once 'service.php';

// controller.php — O maestro: recebe dados, chama o Service, chama o Model

class MatriculaController {

    public function processarMatricula(array $dados): void {
        $nome  = $dados['nome']  ?? '';
        $idade = (int)($dados['idade'] ?? 0);
        $curso = $dados['curso'] ?? '';

        try {
            // 1. Chama o Service para aplicar as regras de negócio
            $service   = new MatriculaService();
            $resultado = $service->processar($nome, $idade, $curso);

            // 2. Se passou nas regras, salva no banco via Model
            $aluno = new AlunoModel();
            $aluno->setNome($resultado['nome']);
            $aluno->setIdade($resultado['idade']);
            $aluno->setCurso($resultado['curso']);
            $aluno->save();

            // 3. Resposta de sucesso para o usuário
            $bolsaMsg = $resultado['tem_bolsa']
                ? '<p style="color:green">🎉 Parabéns! Você recebeu uma <strong>bolsa de estudos</strong>!</p>'
                : '';

            echo "
            <!DOCTYPE html><html><head><meta charset='UTF-8'>
            <title>Matrícula</title>
            <style>body{font-family:sans-serif;max-width:500px;margin:60px auto;padding:20px}</style>
            </head><body>
            <h2>✅ Matrícula realizada!</h2>
            <p><strong>Nome:</strong> {$resultado['nome']}</p>
            <p><strong>Curso:</strong> {$resultado['curso']}</p>
            <p><strong>Idade:</strong> {$resultado['idade']}</p>
            $bolsaMsg
            <a href='/'>← Voltar</a>
            </body></html>";

        } catch (Exception $e) {
            // Qualquer erro do Service aparece aqui de forma amigável
            echo "
            <!DOCTYPE html><html><head><meta charset='UTF-8'>
            <title>Erro</title>
            <style>body{font-family:sans-serif;max-width:500px;margin:60px auto;padding:20px}</style>
            </head><body>
            <h2>❌ Matrícula recusada</h2>
            <p style='color:red'>{$e->getMessage()}</p>
            <a href='/'>← Tentar novamente</a>
            </body></html>";
        }
    }
}
