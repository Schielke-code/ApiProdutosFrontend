@extends('site.template')
@section('conteudo')


    <section id="buttom">
        <div class="container text-center pt-5 mt-5">
            <h1 class="mb-4">API de produtos/Kit - Mercado livre</h1>
            <h6 class="d-block mb-5">Link Para gitHub <a href="#"> clique aqui </a></h6>
            <a class="btn btn-primary d-inline-block" href="{{ route('produtos.create') }}">Cadastro</a>
            <a class="btn btn-primary d-inline-block" href="{{ route('produtos.list') }}">Listagem</a>
            <div class="d-block">
                <img  style="width: 400px" src="/imagem/online_store_.png">

            </div>
        </div>
    </section>

@stop
