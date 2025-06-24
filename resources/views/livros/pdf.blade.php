<!-- filepath: resources/views/livros/pdf.blade.php -->
<h1>{{ $livro->titulo }}</h1>
<p><strong>ISBN:</strong> {{ $livro->isbn }}</p>
<p><strong>Editor:</strong> {{ $livro->editor ?? 'Sem editor' }}</p>
<p><strong>Data de Criação:</strong> {{ $livro->created_at ? $livro->created_at->format('d/m/Y') : '' }}</p>

<h2>Receitas</h2>
<ul>
@foreach($livro->receitas as $receita)
    <li>
        <strong>{{ $receita->titulo }}</strong><br>
        {{ $receita->descricao }}
    </li>
@endforeach
</ul>