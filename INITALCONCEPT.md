# Conceitos iniciais

Como foi citado anteriormente, esse projeto foi dividido em duas partes.
A primeira parte é a API onde concentramos todas as regras de negócio e validações.
A segunda parte é SPA (Single Page), onde interagimos com a API e exibimos
os dados para os usuários.

### Arquitetura da API

Na API trabalhamos com o framework laravel v8, aplicando o padrão arquitetural MCV.
Basicamente dividimos em algumas camadas, sendo elas: Model, View, Controller e Serivces.
É nos services que concentramos todas as regras de negócio.

Outro ponto importante para ressaltar é que não aplicamos validações no cliente,
toda validação de formulário foi concentrada no backend na nossa camada request (``app/Http/Requests``) .

Para autenticação utilizamos tokens de acesso pessoal que possuem um tempo de vida
ou seja, a cada solicitação enviamos esse token e quando o tempo
de vida terminar o cliente não terá mais acesso aos recursos.

### Arquitetura da SPA

Na SPA utilizamos o NUXT v4.5 para interegir com a nossa API. O Nuxt possibilita
maior velocidade no processo de desenvolvimento e baixa complexidade ferramental
,então decidimos por ele. Como precisamos controlar e diferenciar
usuários administradores criamos um middleware que nos ajuda a controlar as páginas
que podem se acessadas e para autenticação utilizamos o pacote auth que nos dá um
controle extremamente robusto e simples. Por fim, para interagir com a nossa API
utilizamos o pacote axois.

### Escolha do banco de dados

A escolha do banco de dados foi orientada pela familiaridade com a tecnologia.
Atualmente acabo trabalhando bastante com o banco Mysql então optei por ele.
