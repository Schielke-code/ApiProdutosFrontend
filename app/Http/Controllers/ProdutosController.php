<?php

namespace App\Http\Controllers;

use App\Model\Produtos;
use Illuminate\Http\Request;
use League\CommonMark\Inline\Element\Image;

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
                    '_method' => 'PUT',
                    'fileImage'=> new \CURLFILE($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name'])
                ];
            }else{
                $post = [
                    'nomeProduto' => $request->nomeProduto,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                    'preco' => $request->preco,
                    'kit' => $request->kit,
                    '_method' => 'PUT',
                    'fileImage'=> new \CURLFILE($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name'])
                ];
            }
        }
        $headers = array(
            "cache-control: no-cache",
            "Authorization: Bearer $request->token"
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:8000/api/produtos/store",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        $response = json_decode($response);
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
