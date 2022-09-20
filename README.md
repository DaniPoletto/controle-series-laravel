# Controle de Séries com Laravel
Projeto Desenvolvido durante o curso de Laravel da Alura

## Mostra todos os comandos
```
php artisan
``` 
## Subir um servidor
```
php artisan serve
```

> Para criar um controler é preciso acessar a pasta App-Http-Controllers

## Para criar uma rota
[nome da classe, metodo]
```
Route::get('/series', [SeriesController::class, 'listarSeries']);
```

## Outra forma de criar um controller - pelo terminal
```
php artisan make:controller SeriesController
```

## Criar um controller com todos os métodos
```
php artisan make:controller PhotoController --resource
```

> Não dar o echo direto de um controler

## Usando Respose:
Posso retornar :
```
return response($resposta, '201', []); sendo o segundo o http status code e o 3 os cabeçalhos
```

>Por padrão já é retornado o codigo 200
```
return $resposta
```

> Se retornar um objeto, array, ele vai automaticamente retornar um json

## Usando o Request
```
   public function index(Request $request)
   {
      //pega o id da url
      $request->get('id');
```

## Pegar url do request
```
$request->url();
```

## Pega o method usado no request
```
$request->method();
```

## Pega inputs do formulario
```
$request->input();
```

## Redireciona pra url
```
return redirect("google.com.br");
```

## Exibir uma view
1 - arquivo
2 - dados (variavel - array)
```
return view('listar-series');
```

é o mesmo que 
```
return view('listar-series', compact('series'));
```

## Blade
```
{{$serie}} = echo $serie

      @foreach($series as $serie)
        <li>{{$serie}}</li>
      @endforeach
```

é o mesmo que
```
      <?php foreach ($series as $serie) {?>
        <li><?=$serie?></li>
      <?php } ?>
```

tbm posso usar
```
return view('listar-series')->with('series', $series);
```

> Por padrão se cria uma pasta dento de resources>view>pasta>index e no controller se chama series.index

## Component Blade
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

por comando:
```
php artisan make:component Alerta
```
> Isso tbm cria uma classe em  App>View>Component

Para ignorar e enviar tudo
```
@{{nome}}
```

## Transforma uma variavel php em json pra ser usado no javascript
```
<script>
const series = {{Js::from($series)}}
<script>
```

## Webpack - configurações do que fazer no front-end
- [x] Laravel Mix - pacote javascript

Para baixar o pacote laravel mix:
```
npm install
```

> É preciso ter instalado o node /npm - NPM é um gerenciador de dependencia

## Instalar bootstrap

```
npm install bootstrap
```

incluir a linha
@import "~bootstrap/scss/bootstrap"; em resources>css>scss

Rodar 
```
npm run dev
```

## Cria a migration
```
php artisan make:migration serie
```

## Roda a migration
```
php artisan migrate
```

## Desfazer migration
```
php artisan migrate:rollback 
```

> @csrf - evita ataque Cross-site request Forgery

> dd - dump and die

## Cria model

```
php artisan make:model Serie
```
