# Todolist com Laravel 😁

O foco desse projeto foi entender como o laravel faz algumas coisas, e por isso eu fiz esse projeto tão comum entre a galera.

![as rotas desse projeto](.github\rotas.png)

# O foco foi entender e aprender:

-   Models
-   Factorys
-   Controller
-   Validação de request
-   Migrations

# CLI e algumas explicações

```bash
# cria as tabelas no banco, baseado nos arquivos da pasta migations
php artisan migrate
```

```bash
php artisan make:migration
```

```bash
# -m cria um arquivo de migration
# -f cria um arquivo de factory
php artisan make:model Task -m -f
```

```bash
php artisan make:request TaskRequest
```

`make:request`: gera um arquivo que tem duas funções:

-   `authorize`: Onde eu posso colar regras de acesso.
-   `rules`: É onde se coloca a regra para a requisição para a rota.

```php
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
	//exemplo: só vai ter acesso a essa rota caso o dia seja 25/12 vulgo natal.
	public function autorize()
	{
		return date("d/m") === '25/12';
	}

	public function rules()
	{
		return [
      'title' => ['required', 'string'],
      'body' => ['required', 'string'],
    ];
	}
}
```

# PSR-4

pelo que entendi é necessario informar no arquivo `composer.json` a pasta que voce for utilziar fora da comum que é a `/app`.

Se não fizer isso o laravel não consegue encontrar as classes criada.

Lembrando que tem toda uma convenção na criação de classes e pastas que se deve ser seguida.

Caso queira saber mais sobre essa e outras convenções [PSR-4 a recomendação de autoload do PHP](https://www.treinaweb.com.br/blog/psr-4-a-recomendacao-de-autoload-do-php).

```json
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/",
            "Todolist\\": "Todolist/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/",
            "Todolist\\": "Todolist/"
        }
    },
```

# pasta routes - lembretes

se vc colocar suas rotas no arquivo `web` em caso de algum tipo de erro não tratado vai acontecer um redirecionamento para a rota `/`.

para poder usar rotas de `api` é ncessario usar o comando:

```bash
php artisan install:api
```

com isso o laravel cria o arquivo `api.php` dentro da pasta `routes`.

outra coisa, uma rota dentro desse arquivo tem um prefixo `api`, por exemplo, se voce tiver criar uma rota `task/{id}` ela vai ficar `api/task/{id}`.

na duvida usa o seguinte comando para mostrar todas as rotas da sua aplicação (todas mapeadas pelo laravel).

```bash
php artisan route:list
```

# TaskRouterProvider

Usando dessa meneira o laravel provavelmente vai ver essa api como do tipo WEB, ainda não entendi como usar a middmiddleware padrão do laravel pra mudar isso, mas fica ai o aviso.

```php
class TaskRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
      //aqui pode ter mais de uma rota
        Route::post('/task',
            [TaskController::class, 'nome da função responsavel por essa rota']
        )->name('aqui vc da um nome para a rota(muito util)');
        
        Route::delete('/task/{id}',
            [TaskController::class, 'nome da função responsavel por essa rota']
        )->name('aqui vc da um nome para a rota(muito util)');
    }
}
```

# AppServiceProvider

Não sei bem explicar como isso aqui funciona, mas pelo que vi, caso vc use uma implementação em uma classe, é necessario informar a interface e a classe dentro de `register`.

Tambem é onde voce informar as rotas da sua aplicação caso voce faça fora da pasta comum do laravel.

```php
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      //um exemplo de como vc informa as rotas
        $this->app->register(TaskRouteProvider::class);
        // interface // reopository
        $this->app->bind(ProductRepository::class, ProductEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

```
