<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Livro Publicado - PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { color: #333; }
        .info { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>{{ $livroPublicado->titulo ?? 'Livro sem título' }}</h2>
    <div class="info"><strong>Editor:</strong> {{ $livroPublicado->editor ?? '-' }}</div>
    <div class="info"><strong>ISBN:</strong> {{ $livroPublicado->isbn ?? '-' }}</div>
    <div class="info"><strong>Cozinheiro:</strong> {{ $livroPublicado->funcionario->nome ?? '-' }}</div>
    <div class="info"><strong>Degustador:</strong> {{ $livroPublicado->degustacao->degustador ?? '-' }}</div>
    <div class="info"><strong>Conteúdo:</strong></div>
    <div>{{ $livroPublicado->conteudo ?? '-' }}</div>
</body>
</html>