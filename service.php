<?php
// service.php — Regras de negócio (sem HTTP, sem SQL, só lógica)

class MatriculaService {

    // Idades mínimas por curso
    private array $idadesMinimas = [
        'programacao'  => 16,
        'design'       => 15,
        'marketing'    => 18,
        'administracao'=> 18,
    ];

    // Cursos com bolsa automática para menores de 20 anos
    private array $cursosComBolsa = ['programacao', 'design'];

    public function processar(string $nome, int $idade, string $curso): array {
        // Regra 1: o curso precisa existir
        if (!array_key_exists($curso, $this->idadesMinimas)) {
            throw new Exception("Curso '$curso' não encontrado no sistema.");
        }

        // Regra 2: idade mínima por curso
        $idadeMinima = $this->idadesMinimas[$curso];
        if ($idade < $idadeMinima) {
            throw new Exception(
                "Idade mínima para o curso '$curso' é $idadeMinima anos. " .
                "Você tem $idade anos."
            );
        }

        // Regra 3: bolsa de estudos automática
        $temBolsa = in_array($curso, $this->cursosComBolsa) && $idade < 20;

        return [
            'nome'     => $nome,
            'idade'    => $idade,
            'curso'    => $curso,
            'tem_bolsa'=> $temBolsa,
        ];
    }
}
