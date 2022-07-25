# Desafio FullStack - To-do list

Nesse desafio eu tive que desenvolver um sistema de tarefas a fazer, onde será possível realizar filtros por status e por texto das tarefas já persistidas.

# Padrões e Tecnologias usados

* __PHP+Laravel__
* Paradigma OO,
* Padrão MVC (Model - View - Controller),
* Boas práticas em Git/Github,
* Padrões REST,
* `Blade`: Para criação das páginas frontend,
* `Bootstrap`: Para estilização das páginas e componentes,
* `DotEnv`: Para variáveis de ambiente,
* `Laravel Request`: Para validação e tratamento de erros dos dados recebidos pelas requisições,
* `JWT`: Para autenticação,
* `Mysql`: Banco de dados, 
* `Eloquent`: ORM responsável em manipular o banco de dados relacional usado no projeto,

# Observações

Com certeza esse código pode ser implementado e refatorado (Nada bom que não possa melhorar), faltaram alguns testes, rotas, funções que não consegui implementar por conta do tempo (dediquei cerca de 4 horas totais nesse projeto).

O código não está totalmente padronizado, algumas funções estão com caracteristicas diferentes, o objetivo foi demonstrar conhecimento com outras implementações e formas de codar.

# Como executar a aplicação:

1. Clone o repositório na sua máquina
  * `git clone https://github.com/miguelbrn/todo-laravel.git`
  * `cd todo-laravel`
2. Crie um arquivo `.env` na raiz do projeto,
  * `cp .env.example .env`
3. Suba as máquinas virtuais usando docker (OBS: O laravel possui um pacote chamado Sail, ele traz como benefício algumas interações entre o framework e as máquinas virtuais, por esse motivo ele foi usado no projeto)
  * `./vendor/bin/sail up`
  * `./vendor/bin/sail exec web bash`
4. Dentro da máquina virtual, instale os pacotes e rode as migrations
  * `composer install`
  * `php artisan migrate`
5. Acesse o projeto
  * <https://localhost/>
# Endpoints

### Login
* GET `/login`

### Registrar novo usuário
* GET `/register` 

#### listar todas as tasks
* GET `/tasks`

Os demais endpoints (Post/PUT/Delete) são interativos e seguem os padrões do MVC.

# Considerações

Quero agradecer a Wanderley e André pela oportunidade de participar desse projeto, o desafio foi bem legal. O fato de a empresa ser potiguar e eu ter a chance de contribuir, interagir e socializar com meus colegas de forma presencial tornaram esse processo seletivo muito importante pra mim.
