Instale as dependências

```bash
docker run --rm --interactive --tty -v $(pwd):/app composer install
```

Copie o arquivo de configuração

```bash
cp .env.example .env
```

Para rodar esse projeto, você vai precisar adicionar as seguintes variáveis de ambiente no seu .env

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

Inicie o servidor

```bash
./vendor/bin/sail up -d
```

Gere uma nova chave

```bash
./vendor/bin/sail artisan key:generate
```

Insira os tabelas e dados no banco

```bash
./vendor/bin/sail artisan migrate --seed
```
