# Setup Docker Para o teste t4tech com Laravel 10, php 8.3 , mysql e Nginx



Clone os Arquivos do Laravel
```sh
git clone https://github.com/rinaldo-peligrineli/teste-t4tech.git
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Para utilizar docker suba os containers do projeto
```sh
docker-compose up -d
```

Para utilizar o servidor interno do laravel (Antes de iniciar Instalar as dependencias do projeto)
```sh
php artisan serve --port 8989
```

Acessar o container
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Exectuar as migrations
```sh
php artisan migrate
```

Executar as seeds
```sh
php artisan db:seed
```

Importar Balldontlie Team 
```sh
php artisan balldontlie-teams:get
```

Importar Balldontlie Player 
```sh
php balldontlie-players:get
```

Json para Postman
```sh
Importar o arquivo Apis-t4tech-teste.json para o postman

X-Authorization
```sh
9dc44621-e11a-437e-a685-ef3d6089ced9
