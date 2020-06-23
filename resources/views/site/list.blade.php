@extends('site.template')
@section('conteudo')
    <style>
        .dataTables_empty, .dataTables_info, #table_id_paginate{
            display: none;
        }

    </style>
    <div class="container mt-5">
        <p class="text-primary"><b>Listando de 5 em 5 | a páginação só vai aparece quando tiver mais de 5 itens</b></p>
        <table class="display w-100">

            <tr  style="border-bottom: 1px solid #000000!important;">
                <th class='text-center py-2'>ID</th>
                <th class='text-center  py-2'>Nome Produto</th>
                <th class='text-center  py-2'>Categoria</th>
                <th class='text-center  py-2'>Imagem</th>
                <th class='text-center  py-2'>Preço</th>
                <th class='text-center  py-2'>Tipo</th>
                <th class='text-center  py-2'>Descricao</th>
                <th class='text-center  py-2'>Delete</th>
            </tr>

            <tbody id="listaClientes">
            </tbody>
            <tfoot style="border-top: 1px solid #000000!important;">
            <tr>
                <th class='text-center  py-2'>ID</th>
                <th class='text-center  py-2'>Nome Produto</th>
                <th class='text-center  py-2'>Categoria</th>
                <th class='text-center  py-2'>Imagem</th>
                <th class='text-center  py-2'>Preço</th>
                <th class='text-center  py-2'>Tipo</th>
                <th class='text-center  py-2'>Descricao</th>
                <th class='text-center  py-2'>Delete</th>
            </tr>
            </tfoot>
        </table>
        <div id="paginacao">

        </div>

    </div>
    <script>
        function carregarItens(){
            var url_string = window.location.href //window.location.href
            var url = new URL(url_string);
            var page = url.searchParams.get("page");
            if(!page){
                var url = "http://127.0.0.1:8000/api/produtos/list";
            }else{
                var url = "http://127.0.0.1:8000/api/produtos/list?page="+page;
            }

            //Capturar Dados Usando Método AJAX do jQuery
            $.ajax({
                type: "GET",
                url: url,
                timeout: 3000,
                datatype: 'JSON',
                contentType: "application/json; charset=utf-8",
                cache: false,
                error: function() {
                    $("h2").html("O servidor não conseguiu processar o pedido");
                },
                success: function(response) {
                    console.log(response.data);
                    console.log(response);


                    // Interpretando retorno JSON...
                    var produtos = response.data;

                    // Listando cada cliente encontrado na lista...
                    $.each(produtos,function(i, produto){
                        var produto = "<tr><th class='text-center  py-2'>"+produto.id+"</th>" +
                            "<th class='text-center  py-2'>"+produto.nome+"</th>" +
                            "<th class='text-center  py-2'>"+produto.categoria+"</th>" +
                            "<th class='text-center  py-2'><img style='width:100px' src='" +'{{ env('DOMINIO_API')}}'+"/storage/imagens/produtos/" +produto.image+"'></th>" +
                            "<th class='money text-center  py-2'>"+produto.preco+"</th>" +
                            "<th class='text-center  py-2'>"+produto.tipo+"</th>" +
                            "<th class='text-center  py-2'>"+produto.descricao+"</th>" +
                            "<th class='text-center  py-2'><a href='" +'{{ env('DOMINIO_FRONT')}}'+"/produtos/delete/"+produto.id+"'  class='btn btn-danger'> <i class='fas fa-trash-alt'></i> <b>Delete</b></a> </th>"+
                            "</tr>";
                        $("#listaClientes").append(produto);
                    });

                    //lógica d páginação
                    if(page == null){
                        var  prev = 1;
                        var  next = 2;
                    }else{
                        var  prev = parseInt(page) - 1;
                        var  next = parseInt(page) + 1;
                    }

                    var cal = response.total  - response.to;
                    if(cal == 0 && response.next_page_url == null && response.from == 1){
                        var paginacao = " <a class='btn btn-primary' href='#' style='pointer-events: none;  opacity: 0.5;'>Anterio</a> <a class='btn btn-primary' href='#' style='pointer-events: none;  opacity: 0.5;'>Proxíma</a>"
                        $("#paginacao").append(paginacao );
                    }else{
                        console.log('agora ta aqui');
                        if(cal > 0 && response.next_page_url != null && response.current_page != 1){
                            var paginacao = " <a class='btn btn-primary' href='" +'{{ env('DOMINIO_FRONT')}}' +"/produtos/list?page="+prev+"'>Anterio</a> <a class='btn btn-primary' href='" +'{{ env('DOMINIO_FRONT')}}'+"/produtos/list?page="+next+"' disable>Proxíma</a>"
                            $("#paginacao").append(paginacao );
                        }

                        if(cal == 0 && response.next_page_url == null){
                            var paginacao = " <a class='btn btn-primary' href='" +'{{ env('DOMINIO_FRONT')}}' +"/produtos/list?page="+prev+"'>Anterio</a> <a class='btn btn-primary' href='#' style='pointer-events: none;  opacity: 0.5;'>Proxíma</a>"
                            $("#paginacao").append(paginacao );
                        }

                        if(response.current_page == 1 && response.next_page_url != null){
                            var paginacao = " <a class='btn btn-primary' href='#' style='pointer-events: none;  opacity: 0.5;'>Anterio</a> <a class='btn btn-primary' href='" +'{{ env('DOMINIO_FRONT')}}'+"/produtos/list?page="+next+"' disable>Proxíma</a>"
                            $("#paginacao").append(paginacao );
                        }
                    }


                }
            });
        }
        $(document).ready(function() {
            carregarItens();
        });


        function delet(id){
            var url = '/api/produtos/delete/'+id;
            alert(url);
            $.ajax({
                type: "DELETE",
                url: url,
                timeout: 3000,
                datatype: 'JSON',
                contentType: "application/json; charset=utf-8",
                cache: false,
                error: function(error) {
                   console.log(error);
                },
                success: function(response) {
                    console.log(response);
                    if(response.sucesso) {
                        window.location.href = "/produtos/list";
                    }else{
                        alert('Houve um erro')
                    }

                }
            });
        }
    </script>

@stop
