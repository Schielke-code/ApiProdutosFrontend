
<!DOCTYPE html>
<html>
<head>
    <title>Vendala API </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/300430e8b3.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow|Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style>

        .breadcrumbs h1 {
            padding: 0 0 30px;
            text-transform: uppercase;
            font-size: .9rem;
            font-weight: 600;
            letter-spacing: .01rem;
            color: #8093A7;
        }
        .breadcrumbs ul {
            list-style: none;
            display: inline-table;
        }
        .breadcrumbs ul li {
            display: inline;
        }
        .breadcrumbs ul li a {
            display: block;
            float: left;
            height: 40px;
            background: #1f1f1f;
            text-align: center;
            padding: 8px 15px 0 30px;
            position: relative;
            margin: 0 10px 0 0;
            font-size: 15px;
            text-decoration: none;
            color: #8093A7;
        }
        .breadcrumbs ul li a:after {
            content: "";
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid #1f1f1f;
            position: absolute;
            right: -20px;
            top: 0;
            z-index: 1;
        }
        .breadcrumbs ul li a:before {
            content: "";
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid #fff;
            position: absolute;
            left: 0;
            top: 0;
        }

        #crumbs ul li:first-child a {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        #crumbs ul li:first-child a:before {
            display: none;
        }

        #crumbs ul li:last-child a {
            padding-right: 20px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            background-origin: border-box right;
            radius: 10px;
            background-color: #ca3539;
            color: #fff;
        }

        #crumbs ul li:last-child a:after {
            display: none;
        }

        #crumbs ul li a:hover {
            background: #3658c7;
            color: #fff;
        }

        #crumbs ul li a:hover:after {
            border-left-color: #3658c7;
            color: #fff;
        }

    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>

</head>
<body class="font-body" style="font-size: 0.9rem!important;">

<section id="buttom">
    <div class="container text-center pt-5 mt-5">
        <h1 class="mb-4">API de produtos/Kit - Mercado livre</h1>
        <h6 class="d-block mb-5">Link Para gitHub <a href="https://github.com/Schielke-code/ApiProdutosBackend" target="_blank"> clique aqui </a></h6>
        <a class="btn btn-primary d-inline-block" href="{{ route('produtos.create') }}">Cadastro</a> <a class="btn btn-primary d-inline-block" href="{{ route('produtos.list') }}">Listagem</a>
    </div>
</section>
@yield('conteudo')

<script>
    $(document).ready(function(){
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.hora').mask('00:00'+'h');
        $('.date_time').mask('00/00/0000 00:00:00');
        $('.cep').mask('00000-000');
        $('.phone').mask('(00) 00000-0000');
        $('.phone_with_ddd').mask('(00) 0000-0000');
        $('.phone_us').mask('(000) 000-0000');
        $('.mixed').mask('AAA 000-S0S');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.money2').mask("#.##0,00", {reverse: true});
        $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/, optional: true
                }
            }
        });
        $('.ip_address').mask('099.099.099.099');
        $('.percent').mask('##0,00%', {reverse: true});
        $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
        $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
        $('.fallback').mask("00r00r0000", {
            translation: {
                'r': {
                    pattern: /[\/]/,
                    fallback: '/'
                },
                placeholder: "__/__/____"
            }
        });
        $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});


    });
</script>

</body>
</html>
