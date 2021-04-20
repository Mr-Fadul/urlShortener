<h1>Encurtador de url. </h1>

Para o correto funcionamento rode o composer install 

npm install 

crie uma base de dados mysql 

aponte a conexão do banco no .ENV

php artisan migrate


A rota para encurtar a url é a baseUrl/api/short

Recebe como parâmetro a url a ser encurtada

e como opcional urlName para uma url customizada
lifeTime com um valor númerico para a quantidade de dias que a url estará disponivel

a rota retorna um json com o id, url, a url com o encurtador, e seus dias de validade.

para acessar a url basta jogar no navegar a shortUrl retornada

acessar a lista de urls, acesse a baseUrl clique no menu login ou registro, 
com o usuario autenticado você será redirecionado para a lista paginada das urls cadastradas. 
