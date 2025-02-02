# Ideasoft Case Study

Author : Furkan Çelik

## [Postman Collection]()

## Requirements
- Docker
- Docker Compose
- Any SQL Client Software - To display pgsql database - optional

## Setup
- Copy .env-example as .env
    - macOS/Linux: `cp .env.example .env`
    - Windows: `cp .\.env.example .\.env`

- Run the commands below to initialize the docker containers 

```
docker-compose build
docker-compose run php composer install
```

- To deploy the development server

```
docker-compose up -d
```

- After this is completed, your services should look like below
    - app: main application service
        - host -> http://127.0.0.1
        - port -> 8000

    - pgsql: main database service
        - host -> http://127.0.0.1
        - port -> 5432

- To connect to your application service, run the command below.
```
docker exec -it app sh
```

- Run the command below to generate the application key
```
php artisan key:generate
```

- While you are still connected to your application service via sh, run the command below to run the migrations.
```
php artisan migrate
```

- While you are still connected to your application service via sh, run the command below to generate products.
```
 php artisan db:seed
```