@extends('site.template')
@section('conteudo')
    <style>
        .dataTables_empty, .dataTables_info, #table_id_paginate{
            display: none;
        }

    </style>
    <div class="container mt-5">
        <p class="text-primary"><b>Listando de 3 em 3 | a páginação só vai aparece quando tiver mais de 3 itens</b></p>
        <table class="display w-100">

            <tr  style="border-bottom: 1px solid #000000!important;">
                <th class='text-center py-2'>ID</th>
                <th class='text-center  py-2'>Nome Produto</th>
                <th class='text-center  py-2'>Categoria</th>
                <th class='text-center  py-2'>Imagem</th>
                <th class='text-center  py-2'>Preço</th>
                <th class='text-center  py-2'>Tipo</th>
                <th class='text-center  py-2'>Detalhes</th>
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
                <th class='text-center  py-2'>Detalhes</th>
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
                var url = "{{ env('DOMINIO_API')}}/api/produtos/list";
            }else{
                var url = "{{ env('DOMINIO_API')}}/api/produtos/list?page="+page;
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
                            "<th class='text-center  py-2'><a onclick='teste("+produto.id+")' href='#'  class='btn btn-success'> <i class='far fa-eye'></i> <b>Detalhes</b></a> </th>"+
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
                    if(response.from != null){
                        var cal = response.total  - response.to;

                        if(cal == 0 && response.next_page_url == null && response.from == 1){

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
                                $("#paginacao").append(paginacao);
                            }
                        }
                    }else{
                        $("#paginacao").append("<h4 class='text-danger'> Sem produtos para serem exibidos</h4>");
                    }



                }
            });
        }
        $(document).ready(function() {
            carregarItens();
        });


        function teste(id) {
            window.open('{{ env('DOMINIO_FRONT')}}/produtos/show/'+id+'',    '_blank', 'location=yes,height=600,width=600, left='+(window.innerWidth-600)/2+', top='+(window.innerHeight-600)/2+', scrollbars=yes,status=yes');
        }


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
