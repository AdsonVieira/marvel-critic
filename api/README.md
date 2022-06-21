# Configurando API

Para configurar a API e conseguir executar em seu amviente local será necessário
ter o Mysql instalado junto com Workbench. Eu vou partir do pressuposto que
você tem esse conhecimento ou já utiliza essas ferramentas.


#### Tecnologias utilizadas na API
```sql
# PHP 7.4.29
# Composer 1.10.1
# Mysql 8.0.21
# Laravel 8
```

#### Preparando o banco de dados

```sql
# Crie o banco de dados. Será necessário executar somente esse comando SQL.

$ create database marvel_critic;
```

#### Preparando a API

```bash
# Na pasta marvel-critc/api crie um arquivo .env e copie o conteudo do .env.example

$ cp .env.example .env

# Abaixo você pode ver o conteudo desse arquivo, é aqui que vamos configurar 
# o acesso ao nosso banco de dados.

APP_NAME="Marvel Critic"
APP_ENV=local
APP_KEY=base64:X5Xb/m6IJ7vnj9GrxzEY0l0HXaW8p6Tmxqs7NABxW5M=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marvel_critic
DB_USERNAME=root
DB_PASSWORD=root
```

```bash
# Ainda dentro da pasta marvel-critc/api será necessário instalar as depências
#do projeto com o compose.

$ composer install
```

```bash
# Após instalação execute o seguinte comando. Esse comando criará uma nova
# para sua aplicação (APP_KEY).

$ php artisan key:generate
```

```bash
# Limpe e carregue as novas configurações

$ php artisan config:cache
```

```bash
# Crie as tabelas necessárias para executar aplicação com sucesso.

$ php artisan migrate
```

```bash
# Popule o banco de dados com algumas informações básicas. 
# O comando abaixo criará um usuário admin e irá inserir 10 filmes na base de dados.

user: admin@gmail.com
senha: 123

$ php artisan db:seed
```

```bash
# Execute o projeto. O API ficará disponível no link http://127.0.0.1:8000

$ php artisan serve
```
