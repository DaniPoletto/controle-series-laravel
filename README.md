# Controle de Séries com Laravel
Projeto Desenvolvido durante o curso de Laravel da Alura. 

## Projeto
Sistema para controle de séries com as seguintes funções:
- [x] CRUD de séries
- [x] Marcar série como assistida

### Tecnologias
- [x] PHP 7.3
- [x] Laravel 8.75
- [x] MySql

<!--
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

```

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
php artisan make:migration serie
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

> @csrf - evita ataque Cross-site request Forgery

> dd - dump and die
