<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do produto</title>
</head>
<body>
<h4>Detalhes do  {{ $produtos->data->produto->tipo }}</h4>
<p>Id: {{ $produtos->data->produto->id }}</p>
<p>Categoria: {{ $produtos->data->produto->categoria }}</p>
<p>Nome: {{ $produtos->data->produto->nome }}</p>
<p>Descricao: {{ $produtos->data->produto->descricao }}</p>
<p>Preço: {{ $produtos->data->produto->preco}}</p>

@if($produtos->data->produto->tipo == 'KIT')
    <h4>Itens do kit</h4>
    <hr>
    @foreach($produtos->data->itensKit as $itens)
        <p>Id: {{ $itens->id }}</p>
        <p>Categoria: {{ $itens->categoria }}</p>
        <p>Nome: {{ $itens->nome }}</p>
        <p>Descricao: {{ $itens->descricao }}</p>
        <p>Preço: {{ $itens->preco}}</p>
        <hr>
        @endforeach
        @endif
    </body>
</html>
