<?php

namespace App\Http\Controllers;

use App\Model\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    public function index()
    {

        return view('site.index');
    }

    public function create()
    {
        $curl = curl_init('https://api.mercadolibre.com/sites/MLA/categories');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $jsonCategoriaMl = json_decode( $result );



        $headers = array(
            "cache-control: no-cache",
        );
        $curl = curl_init(env('DOMINIO_API').'/api/produtos/list/item');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,  $headers);
        $result  = curl_exec($curl);
        curl_close($curl);
        $produtos = json_decode( $result );
        return view('site.cadastro')->with(compact('jsonCategoriaMl','produtos'));
    }

    public function store(Request $request)
    {
        $file = new \CURLFile($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);

        if($_FILES['image']['size'] == 0){
            if(isset($request->produto)){
                $arrayData = $request->produto;
                $produtos = implode(",", $arrayData);
                $post = [
                    'nomeProduto' => $request->nomeProduto,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                    'preco' => $request->preco,
                    'produto' => $produtos,
                    'kit' => $request->kit,
                ];
            }else{
                $post = [
                    'nomeProduto' => $request->nomeProduto,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                    'preco' => $request->preco,
                    'kit' => $request->kit,
                ];
            }
        }else{
            if(isset($request->produto)){
                $arrayData = $request->produto;
                $produtos = implode(",", $arrayData);
                $post = [
                    'nomeProduto' => $request->nomeProduto,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                    'preco' => $request->preco,
                    'produto' => $produtos,
                    'kit' => $request->kit,
                    'fileImage' => $file
                ];
            }else{
                $post = [
                    'nomeProduto' => $request->nomeProduto,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                    'preco' => $request->preco,
                    'kit' => $request->kit,
                    'fileImage' => $file
                ];
            }
        }


        $headers = array(
            "cache-control: no-cache",
            "Authorization: Bearer $request->token"
        );

        $curl = curl_init(env('DOMINIO_API').'/api/produtos/store');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_HTTPHEADER,  $headers);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode( $result );
        return redirect()->route('produtos.list');

    }


    public function list()
    {

        return view('site.list');
    }

    public function destroy($id){

        $headers = array(
            "cache-control: no-cache",
        );
        $curl = curl_init(env('DOMINIO_API')."/api/produtos/delete/$id");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,  $headers);
        $result  = curl_exec($curl);
        curl_close($curl);
        $produtos = json_decode( $result );

        if(isset($produtos->sucesso)){
            $sucesso = $produtos->sucesso;
            return redirect()->route('produtos.list')->with(compact('sucesso'));
        }
    }


}
