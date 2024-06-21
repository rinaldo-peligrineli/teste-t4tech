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
docker-compose up -d ou docker compose up -d 
```

Para utilizar o servidor interno do laravel (Antes de iniciar Instalar as dependencias do projeto)
```sh
php artisan serve --port 8989
```

Acessar o container
```sh
docker exec -it {nome-da-pasta}-app-1 bash
```

Instalar as dependências do projeto
```sh
(caso tenha problema com permissão na pasta executar 
sudo chmod 777 -R ./t4tech-validation-teste/)

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
php artisan balldontlie-teams
```

Importar Balldontlie Player 
```sh
php artisan balldontlie-players
```

Json para Postman
```sh
Importar o arquivo Apis-t4tech-teste_collection.json para o postman
```

X-Authorization
```sh
9dc44621-e11a-437e-a685-ef3d6089ced9
```
