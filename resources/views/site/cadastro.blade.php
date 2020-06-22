@extends('site.template')
@section('conteudo')

    <div class="container mt-5">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed w-100" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-plus"></i> Cadastra novo Produto
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="" style="position: relative">
                            <h4> Formulário para cadastro de Produtos </h4> <hr style="position: absolute; width: 100%; top: 0; z-index: 0;"><br/><br/>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <form id="cadastroProduto" action="{{route('produtos.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  mb-4">
                                                <label for="nomeProduto">NOME DO PRODUTO</label>
                                                <input  type="text" class="form-control pl-4" id="nomeProduto" name="nomeProduto"  value="{{old('nomeProduto')}}"  placeholder="ex: Console Playstation 4 Pro 1TB" required>
                                                <span class="text-center text-white" style="position: absolute; left: 10px; top: 40px;" ><i class="fas fa-file-signature" aria-hidden="true" style="color: #1F1F1F"></i></span>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label for="categoria">CATEGORIA</label>
                                                <select class="custom-select pl-4" id="categoria" name="categoria" required>
                                                    @foreach($jsonCategoriaMl as $categoria)
                                                        <option value="{{$categoria->name}}">{{ $categoria->name }}</option>
                                                    @endforeach]

                                                </select>
                                                <span class="text-center text-white" style="position: absolute; left: 10px; top: 40px;" ><i class="fas fa-box" aria-hidden="true" style="color: #1F1F1F"></i></span>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label>DESCRIÇÃO <i class="far fa-edit" aria-hidden="true"></i></label>
                                                <div id="descricao" style="position: relative">
                                                    <textarea name="descricao" class="form-control" placeholder="EX: Com o PS4 Pro 1 TB Preto Bivolt você vai ficar ainda mais próximo do jogo!" required></textarea>

                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label for="nascimento">Preço</label>
                                                <input style="padding-left: 30px" type="text"  class="form-control money" id="preco" name="preco" value="{{old('preco')}}" required>
                                                <span class="text-center" style="position: absolute; left: 10px; top: 40px;  color: #1F1F1F" >R$</span>
                                            </div>
                                            <input type="hidden" name="kit" value="0">

                                            <style>
                                                .miniatura-capa{
                                                    max-width: 100%;
                                                    width:100%;
                                                    height:  250px;
                                                    object-fit: scale-down
                                                }

                                                .img-capa{
                                                    width: 100%;
                                                    background-color: #3A3A3A;
                                                    display: inline-block;
                                                    box-sizing: border-box
                                                }

                                            </style>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <input type='file' id="imgInp" type="file" name="image" accept="image/png, image/jpeg" required/>
                                                <div class="img-capa">
                                                    <img id="blah" class="miniatura-capa"  style=" display: none" src="#" alt="" />
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label>Token</label>
                                                <input id="tokenField" name="toke" type="text" value="pmwememewm6151541" required>
                                            </div>
                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <input id="submit" style="background-color: #1F5CB2"  type="submit"   value="Cadastrar novo produto" class="btn btn-info"/><br/>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <img  style="width: 100%; " src="/imagem/shopping_cart.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed w-100" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fas fa-plus"></i>  Cadastrar novo KIT
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="" style="position: relative">
                            @if($produtos == null)
                                <h5 class="text-danger text-center w-100">Cadastre um produto para cadastra seu KIT</h5>
                            @else
                            <h4> Formulário para cadastro de Produtos </h4> <hr style="position: absolute; width: 100%; top: 0; z-index: 0;"><br/><br/>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <form action="{{route('produtos.store')}}" method="post" autocomplete="off"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  mb-4">
                                                <label for="nomeProduto">NOME DO PRODUTO</label>
                                                <input type="text" class="form-control pl-4" id="nomeProduto" name="nomeProduto"  value="{{old('nomeProduto')}}"  placeholder="ex: Console Playstation 4 Pro 1TB" required>
                                                <span class="text-center text-white" style="position: absolute; left: 10px; top: 40px;" ><i class="fas fa-file-signature" aria-hidden="true" style="color: #1F1F1F"></i></span>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label for="categoria">CATEGORIA</label>
                                                <select class="custom-select pl-4" id="categoria" name="categoria">
                                                    @foreach($jsonCategoriaMl as $categoria)
                                                        <option value="{{$categoria->name}}">{{ $categoria->name }}</option>
                                                    @endforeach]

                                                </select>
                                                <span class="text-center text-white" style="position: absolute; left: 10px; top: 40px;" ><i class="fas fa-box" aria-hidden="true" style="color: #1F1F1F"></i></span>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                                <label>DESCRIÇÃO <i class="far fa-edit" aria-hidden="true"></i></label>
                                                <div id="descricao" style="position: relative">
                                                    <textarea name="descricao" class="form-control" placeholder="EX: Com o PS4 Pro 1 TB Preto Bivolt você vai ficar ainda mais próximo do jogo!" required></textarea>

                                                </div>
                                            </div>
                                            <input type="hidden" name="kit" value="1">

                                            <style>
                                                .miniatura-capa{
                                                    max-width: 100%;
                                                    width:100%;
                                                    height:  250px;
                                                    object-fit: scale-down
                                                }

                                                .img-capa{
                                                    width: 100%;
                                                    background-color: #3A3A3A;
                                                    display: inline-block;
                                                    box-sizing: border-box
                                                }

                                            </style>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb-4 py-4 text-white">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <small class="text-danger">Listado apenas os itens que não estão incluidos em nenhum kit</small>
                                                        <p tabindex="-1" class="btn btn-default" >Clique na seta para lista os itens</p>
                                                        <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu w-">
                                                            @foreach($produtos as $produto)
                                                            <li class="ml-5">
                                                                <a href="#">
                                                                    <input type="checkbox" name="produto[]" value="{{ $produto->id}}" class="form-check-input" id="prod{{ $produto->id}}">
                                                                    <span class="lbl"> {{ $produto->nome}}</span>
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p class="text-black-50">Itens do kit</p>
                                                <textarea id="listaProdutos" type="text" class="form-control"></textarea>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <input type='file' id="imgInp" type="file" name="image" accept="image/png, image/jpeg" required/>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-4">
                                                <label>Token</label>
                                                <input id="tokenField" name="toke" type="text" value="pmwememewm6151541" required>
                                            </div>

                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <input id="submit" style="background-color: #1F5CB2"  type="submit"   value="Cadasstrar novo produto" class="btn btn-info"/><br/>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <img  style="width: 100%; " src="/imagem/combo.png">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="mb-5">
        <div class="container">

        </div>
    </section>
    <script>

        $(document).ready(function() {
            $("ul.dropdown-menu input[type=checkbox]").each(function() {
                $(this).change(function() {
                    var line = "";
                    $("ul.dropdown-menu input[type=checkbox]").each(function() {
                        if($(this).is(":checked")) {
                            line += $("+ span", this).text() + ";";
                        }
                    });
                    $("#listaProdutos").val(line);
                });
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    $('#blah').css('display','block');
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
        </script>


@stop
