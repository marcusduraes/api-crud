
## Iniciando projeto

Clone o projeto do repositório

```bash
git clone https://gitlab.com/marcusduraes/api-crud-structure.git
```
## Iniciando banco de dados

```bash
docker run --name my-mysql -v "$(pwd)/api/db/data:/var/lib/mysql" -e MYSQL_ROOT_PASSWORD=my-secret-pw -d -p 3306:3306 mysql
```
Execute o script sql para criar a base de dados

```bash
docker exec -i my-mysql mysql -pmy-secret-pw < api/db/script.sql
```
Aqui esta um exemplo de como a sua base de dados deve estar:

![App Screenshot](https://i.imgur.com/d6pjGRW.png)





## Iniciando servidor

Já no host selecione o dirétorio onde está localizado o arquivo `index.php`

```bash
cd api/db
```

Execute o web-server built-in do php na porta 3000

```bash
php -S localhost:3000
```

Acesse o localhost no seu navegador

[http://localhost:3000](https://localhost:3000)

## Operações com API

#### Retorna todos os itens

```http
  GET localhost:3000
```
#### Adiciona um item

```http
  POST localhost:3000/?item={value}
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `item` | `string` | **Obrigatório**. Somente para requisições POST |

#### Exclui um item

```http
  DELETE localhost:3000/{id}/delete
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do item que você quer |



## Referência

 - [Web Server PHP](https://www.php.net/manual/pt_BR/features.commandline.webserver.php)
 - [Comandos básicos do MySQL no terminal](https://www.diegobrocanelli.com.br/mysql/comandos-basicos-mysql-no-terminal/)