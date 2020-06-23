<h2 style="color:#F00">NOTA</h2>
Tutorial: http://codezeus.com.br/tutorial.mp4 | Para ver o projeto funcionando basta ir para o final do vídeo<br/> 
Este Projeto possui o Backend desacomplando deste repositório, para que possamos de fato testar a  API. configure primeiramente o Backend deste projeto <a href="https://github.com/Schielke-code/ApiProdutosBackend" target="_blank">clicando aqui</a>, o backend 
já esta onfigurado? então podemos seguir em frente...

<h2>Requisitos para rodar o projeto deste repositório(Front end)</h2>
<p>O projeto foi feito utilizando laravel 7, para que ele rode temos que seguir os requisitos da própia documentação <a href="https://laravel.com/docs/7.x/installation#server-requirements"> CLIQE AQUI P IR A DOCUMENTAÇÃO</a></p>
<p>
	Apos clonar o projeto do github (git clone https://github.com/Schielke-code/ApiProdutosFrontend.git) abra a pasta do projeto e rode os seguinte comando dentro do terminal:
	<code>composer install</code>
</p>
<p>
	Concluindo esta etapa copie o arquivo ".env.example" e cole renomeando para ".env (cole no mesmo diretório do .env.example)"
</p>

<p>
	Abra novamente o seu terminal e gere uma chave com o seguinte comando:  <code>php artisan key:generate</code>
</p>


<h2>Configurando o arquivo .env</h2>

<p>
	para facilitar a alteração das urls que serão feitas as requisição temos criar  dois novos campos no .env. no final do aquivo dê um espaço e adicione estes campos:<br/><br/>
	
	DOMINIO_API="http://127.0.0.1:8000"
    DOMINIO_FRONT="http://127.0.0.1:8001"
</p>
<p>execute novamente o comando <code>php artisan config:clear</code></p>
<span>se a posrta for diferente de  8000 e 8001 n esqueça de alteras no código acima</span>
<p>
    Esse valores podem ser obtidos rodando o comando <code>php artisan serve</code>  em seu terminal, o valor retornando no projeto onde esta o backend 
    deve ser adicionado no 'DOMINIO_API', e o valor obtido no projeto front end (este repositório) deve ser adicionado em DOMINIO_FRONT 
</p>

<h2 style="color:#F00">!important</h2>
Os dois projetos devem esta rodando ao mesmo tempo (php artisan serve)  e com DOMINIO_API(backend) e  DOMINIO_FRONT(front end) sendo executados de forma simultânea.
Vale lembrar que se o projeto estivesse rodando na web essa configuração do .env não seria necessária
