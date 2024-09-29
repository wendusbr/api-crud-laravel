## Requisitos

* PHP 8.2 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo ".env-example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados <br>

Instalar as dependências do PHP
```
composer install
```

Gerar a chave no arquivo .env
```
php artisan key:generate
```

Executar as migration
```
php artisan migrate
```

Executar as seed
```
php artisan db:seed
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Para acessar a API, é recomendado utilizar o Postman para simular requisições:
```
127.0.0.1:8000/api/users
```

## Sequencia para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel project-name
```

Alterar no arquivo .env as credenciais do banco de dados<br>

Criar o arquivo de rotas para API
```
php artisan install:api
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Para acessar a API, é recomendado utilizar o Postman para simular requisições:
```
127.0.0.1:8000/api/users
```

Criar seed
```
php artisan make:seeder NomeDaSeeder
php artisan make:seeder UserSeeder
```

Executar as seed
```
php artisan db:seed
```

### Arquivos que foram modificados para criar a API
* .env (Configurações do projeto)
* api.php (Criação de rotas da api)
* User.php (Model)
* UserController.php (Controller)
* UserSeeder.php (Apenas para caso queira deixar registros pré-definidos)
* DatabaseSeeder.php (Chama as Seeders)
* UserRequest.php (Opcional para Requests personalizadas; padrão: Request)