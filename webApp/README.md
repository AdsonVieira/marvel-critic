# Configurando SPA

O processo de execução da SPA é bem simples, basta executar os comandos abaixo.

#### Tecnologias utilizadas na SPA
```sql
# NODE 18.3.0
# NPM 8.11.0
# Nuxt 2.15.8
```

```bash
# Navegue até a pasta da SPA
$ cd webApp/
```

```bash
# Instalar as dependências do projeto
$ npm install

# Executar o servidor local, desse modo a aplicação ficará disponível no link 
# http://localhost:3000
$ npm run dev
```

```bash
# Caso receba o erro ERR_OSSL_EVP_UNSUPPORTED, execute o comando abaixo
$ export NODE_OPTIONS=--openssl-legacy-provider
```
