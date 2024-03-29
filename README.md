# Controle de Séries com Laravel

![Sistema](https://github.com/DaniPoletto/controle-series-laravel/blob/master/primeira-versao.gif)

> :construction: Projeto em construção :construction:

## Projeto
Projeto desenvolvido durante o curso de Laravel da Alura para controle de séries com as seguintes funções:
- [x] CRUD de séries
<!-- - [ ] Marcar série como assistida -->

### Tecnologias
- [x] PHP 7.3
- [x] Laravel 8.75
- [x] MySql

### Inicialização
1 - Instalando dependências de back-end
```
composer install
```

2 - Instalando dependências de front-end
```
npm install
```

2 - Configurando banco
Criar arquivo .env copiando as configurações do arquivo .env.example

3 - Rodar migrations
```
php artisan migrate
```

4 - Gerar chave de aplicação
```
php artisan key:generate
```

5 - Subir servidor
```
php artisan serve
```

<!---
### Versão em Symfony (em desenvolvimento)
https://github.com/DaniPoletto/controle-series-symfony -->

## Resumo de anotações de conteúdo de aula
### Criar um projeto
```
composer create-project laravel/laravel:^8.0 nome-do-projeto
```

### Mostra todos os comandos
```
php artisan
```

### Subir o servidor
```
php artisan serve
```

### Criar uma rota
Route::verboHTTP('rota', [nome da classe, metodo]);

```
Route::get('/series', [SeriesController::class, 'listarSeries']);
```

#### Utilizando grupo de rotas
```
Route::controller(SeriesController::class)->group(function () {
     Route::get('/series', 'index')->name('series.index');
     Route::get('/series/create', 'create')->name('series.create');
     Route::post('/series/salvar', 'store')->name('series.store');
});
```

#### Criando apenas algumas rotas
```
Route::resource('/series', SeriesController::class)
    ->only(['show']);
```

#### Utilizando o padrão e excluindo rotas desnecessárias
```
Route::resource('/series', SeriesController::class)
    ->except(['show']);
```

#### Nomeando rotas
```
Route::delete('/series/destroy/{serie}', [SeriesController::class, 'destroy'])
     ->name('series.destroy');
```

### Controller

> Para criar um controler é preciso acessar a pasta App/Http/Controllers

#### Padrões

|Verb	| URI	| Action | Route Name |
| --- | --- | --- | --- |
| GET |	/photos |	index |	photos.index | 
| GET |	/photos/create |	create |	photos.create |
| POST |	/photos |	store |	photos.store |
| GET |	/photos/{photo} |	show |	photos.show |
| GET |	/photos/{photo}/edit |	edit |	photos.edit |
| PUT/PATCH	|/photos/{photo} |	update |	photos.update |
| DELETE |	/photos/{photo}	| destroy |	photos.destroy |

#### Criar um controller por comando
```
php artisan make:controller SeriesController
```

#### Criar um controller por comando com todos os métodos
```
php artisan make:controller PhotoController --resource
```

> Boas práticas: Não dar o echo direto de um controler

### Request e Response
#### Usando Respose

> O segundo parametro corresponde ao HTTP status code e o 3 os cabeçalhos

```
return response($resposta, '201', []); 
```

>Por padrão já é retornado o codigo 200
```
return $resposta
```

> Se retornar um objeto, array, ele vai automaticamente retornar um JSON

#### Usando o Request
```
   public function index(Request $request)
   {
      //pega o id da url
      $request->get('id');
```

#### Pegar url do request
```
$request->url();
```

#### Pegar o method usado no request
```
$request->method();
```

#### Pegar inputs do formulário
```
$request->input();
```

#### Pegar todos os campos
```
$request->all();
```

#### Pegar apenas alguns campos
```
$request->only(['nome', 'descricao']);
```

#### Pegar todos com excessão de alguns campos
```
$request->except(['_token']);
```

### Redirecionar pra url
```
return redirect("google.com.br");
```

### Views
#### Exibir uma view

> 1 - arquivo
> 2 - dados (variaveis a serem passadas pra view - array)

```
return view('listar-series', [
    'series' => $series
]);
```

É o mesmo que 

```
return view('listar-series', compact('series'));
```

Que também é o mesmo que
```
return view('listar-series')->with('series', $series);
```

#### Blade

```
{{$serie}} = echo $serie
```

```
      @foreach($series as $serie)
        <li>{{$serie}}</li>
      @endforeach
```

É o mesmo que
```
      <?php foreach ($series as $serie) {?>
        <li><?=$serie?></li>
      <?php } ?>
```

> Por padrão se cria uma pasta dento de resources>view>pasta>index.blade.php e no controller se chama series.index. O ponto indica a separação de diretório. Ex: create.blade.php

##### Criar Component Blade
criar uma pasta components em resources>views 

```
<html>
<title>Series</title>
<body>
    <h1>{{$title}}</h1>
    {{$slot}}
</body>
</html>
```

> Title é um atributo que pode ser passado e slot o corpo sendo x-nome-do-component que é o nome do arquivo criado
```
<x-layout title="Séries">
    <ul>
      @foreach($series as $serie)
        <li>{{$serie}}</li>
      @endforeach
    </ul>
</x-layout>
```

##### Criar componente Blade por comando:

```
php artisan make:component Alerta
```

> Isso também cria uma classe em  App>View>Component

##### Para ignorar e enviar como está
> O Blade não irá parsear e enviará nome

```
@{{nome}}
```

##### Transforma uma variavel php em json pra ser usado no javascript
```
<script>
const series = {{Js::from($series)}}
<script>
```

##### Verifica se existe
```
@isset($mensagemSucesso)
...
@endisset
```

### Webpack - configurações do que fazer no front-end
- [x] Laravel Mix - pacote javascript

Para baixar o pacote laravel mix:
```
npm install
```

> É preciso ter instalado o node /npm - NPM é um gerenciador de dependencia

#### Instalar bootstrap

```
npm install bootstrap
```

incluir a linha
@import "~bootstrap/scss/bootstrap"; em resources>css>scss

Rodar 

```
npm run dev
```

### Migrations

#### Cria a migration

```
php artisan make:migration create_series_table
```

#### Rodar a migration

```
php artisan migrate
```

#### Desfazer migration

```
php artisan migrate:rollback 
```

### Models
#### Cria model

```
php artisan make:model Serie
```

> Ao utilizar comando acima, o laravel mapeia a model Serie para a tabela series. 
> Também posso definir a tabela caso não siga o padrão:

```
protected $table = 'seriados';
```

> @csrf - evita ataque Cross-site request Forgery

> dd - dump and die

#### Formas de puxar informações do banco de dados
 
```      
 $series = DB::select('SELECT nome FROM series;');
```

```
 $series = Serie::all();
```

```
Serie::query()->orderBy('nome')->get();
```

### Sessions

#### Inserindo informações em sessão
```
$request->session()->put('mensagem.sucesso', 'Série removida com sucesso.');
```

ou
```
session(['mensagem.sucesso' => 'Série removida com sucesso.']);
```

#### Verificação se existe parametro em sessão
```
$request->session()->has('mensagem.sucesso');
```

#### Retornar valor de parametro da sessão
```
$request->session()->get('mensagem.sucesso');
```

ou

```
session('mensagem.sucesso');
```

#### Remover parametro
```
$request->session()->forget('mensagem.sucesso');
```

#### Adicionar valor da sessão e remover logo em seguida após ser exibido (flash message)
```
$request->session()->flash('mensagem.sucesso', 'Série removida com sucesso');
```

#### Debugbar
```
composer require barryvdh/laravel-debugbar --dev
```

### E-mail

#### Criar e-mail
```
php artisan make:mail SeriesCreated
```

#### Testando
```
https://mailtrap.io/
```

#### Adicionando e-mails em uma fila
```
Mail::to($user)->queue($email);
```

#### Configurar para usar o banco como fila
no arquivo .env:
```
QUEUE_CONNECTION=database
```

#### Criar migration para fila
```
php artisan queue:table
```

#### Executar comandos php no terminal
```
php artisan tinker
```

#### Executando a fila
Utilizar em produção:
```
php artisan queue:work
```

Utilizar em tempo de desenvolvimento:
```
php artisan queue:listen
```

Colocar na fila para tentar reprocessar de novo
```
php artisan queue:retry "all"
```

```
php artisan queue:failed
```

Tentar 2 vezes em caso de falha com delay de 10 segundos entre uma tentativa e outra
```
php artisan serve queue:work --tries=2 --delay=10
```

Não é o ideal geralmente. 

Limpar a fila
```
php artisan queue:clear
```

### Criar um listener para um evento
```
php artisan make:listener EmailUsersAboutSeriesCreated
```

Criar listener informando qual evento ele vai escutar
```
php artisan make:listener LogSeriesCreated -e SeriesCreated
```

### Criar evento
```
php artisan make:event SeriesCreated
```

É necessário configurar em EventServiceProvider para que o evento seja executado
```
        SeriesCreated::class => [
            EmailUsersAboutSeriesCreated::class,
        ],
```

### Criação de log
```
Log::info("Série criada com sucesso");
```

### Salvar arquivo
```
$request->file('cover')->store('series_cover');
```

Salvar arquivo definindo um nome
```
$serie = $this->repository->add($request);
```

Escolher onde salvar o arquivo (public)
```
$request->file('cover')->store('series_cover', 'public');
```

Criar um link simbólico para deixar arquivo acessível
```
php artisan storage:link
```

### Executando teste
```
php artisan test
```

### Criando um teste
```
php artisan make:test SeriesRepositoryTest
```

