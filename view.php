<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodWear — Matrícula</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 60px auto; padding: 20px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; }
        button { margin-top: 20px; width: 100%; padding: 12px; background: #8b5a2b; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #734c29; }
    </style>
</head>
<body>
    <h2>📋 Formulário de Matrícula</h2>

    <!-- action="/" envia para a raiz, o router decide o que fazer -->
    <form method="POST" action="/">
        <label for="nome">Nome completo</label>
        <input type="text" id="nome" name="nome" placeholder="Seu nome">

        <label for="idade">Idade</label>
        <input type="number" id="idade" name="idade" placeholder="Ex: 17">

        <label for="curso">Curso</label>
        <select id="curso" name="curso">
            <option value="">Selecione...</option>
            <option value="programacao">Programação (mín. 16 anos)</option>
            <option value="design">Design (mín. 15 anos)</option>
            <option value="marketing">Marketing (mín. 18 anos)</option>
            <option value="administracao">Administração (mín. 18 anos)</option>
        </select>

        <button type="submit">Enviar matrícula</button>
    </form>
</body>
</html>
