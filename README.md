<<<<<<< HEAD
Funcionalidades ✨
Gerenciamento de Receitas:

Adicionar Receita: Crie novas receitas com detalhes como nome, cozinheiro responsável, categoria, data de criação, modo de preparo, quantidade de porções, se é inédita, nível de dificuldade e tempo de preparo.
Gerenciamento de Ingredientes: Adicione múltiplos ingredientes a cada receita, especificando a quantidade, a unidade de medida e observações.
Upload de Fotos: Inclua uma foto da receita com uma descrição.
Visualizar Receitas: Veja todas as receitas cadastradas.
Editar Receitas: Modifique os detalhes de receitas existentes.
Excluir Receitas: Remova receitas do sistema.
Gerenciamento de Entidades Relacionadas:

Cozinheiros: Cadastro de cozinheiros que podem criar receitas. 👨‍🍳
Categorias: Cadastro de categorias para organizar as receitas (ex: Sobremesas, Pratos Principais, Lanches). 📚
Ingredientes: Cadastro de ingredientes disponíveis para uso nas receitas. 🥕
Medidas: Cadastro de unidades de medida para os ingredientes (ex: gramas, xícaras, colheres). ⚖️
Tecnologias Utilizadas 🛠️
Backend:

PHP 8.x
Laravel 10.x: Framework MVC para o desenvolvimento da aplicação. 🚀
MySQL/PostgreSQL (ou outro banco de dados compatível): Para armazenamento dos dados. 💾
Frontend:

Blade: Motor de templates do Laravel.
HTML5
CSS3
JavaScript (Vanilla JS): Para interações dinâmicas, como a adição de campos de ingredientes. ⚡
Bootstrap 5.3: Framework CSS para design responsivo e componentes de UI. 🎨
Instalação e Configuração ⚙️
Para configurar e rodar o projeto em sua máquina local, siga os passos abaixo:

Clone o Repositório:

Bash

git clone [URL_DO_SEU_REPOSITORIO]
cd nome-do-repositorio
Instale as Dependências do Composer:

Bash

composer install
Copie o Arquivo de Configuração de Ambiente:

Bash

cp .env.example .env
Gere a Chave da Aplicação:

Bash

php artisan key:generate
Configure o Banco de Dados:

Abra o arquivo .env e configure suas credenciais de banco de dados:
Snippet de código

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco_de_dados
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
Crie o banco de dados (nome_do_seu_banco_de_dados) em seu servidor de banco de dados (ex: phpMyAdmin, MySQL Workbench).
Execute as Migrações e Seeder (Opcional):

Rode as migrações para criar as tabelas no banco de dados:
Bash

php artisan migrate
Se você tiver seeders para popular o banco de dados com dados de exemplo (cozinheiros, categorias, ingredientes, medidas), execute-os:
Bash

php artisan db:seed
(Se você tiver seeders específicos, como DatabaseSeeder.php, você pode rodar php artisan db:seed --class=SeuSeeder se necessário)
Crie o Link Simbólico para Armazenamento (para uploads de fotos):

Bash

php artisan storage:link
Inicie o Servidor de Desenvolvimento:

Bash

php artisan serve
O aplicativo estará disponível em http://127.0.0.1:8000 (ou outra porta indicada). 🌐

Estrutura do Projeto (Pastas Principais) 📂
app/Models: Contém os modelos Eloquent que interagem com o banco de dados (ex: Receita.php, Ingrediente.php).
app/Http/Controllers: Armazena os controladores que lidam com a lógica da requisição e resposta.
database/migrations: Define a estrutura do banco de dados.
database/seeders: Contém dados de exemplo para popular o banco de dados.
resources/views: Contém os arquivos de template Blade (.blade.php).
resources/views/layouts: Layouts base (ex: receitas.blade.php).
resources/views/receitas: Views específicas para as operações de receita (ex: create.blade.php, index.blade.php).
resources/views/receitas/partials: Partials para reutilização de código (ex: ingrediente_form_field.blade.php).
public: Contém os ativos compilados (CSS, JavaScript, imagens) e é a raiz pública do servidor web.
routes/web.php: Define as rotas da aplicação.
storage/app/public: Onde as fotos das receitas serão armazenadas. 🖼️
Como Contribuir 🤝
Faça um fork do repositório.
Crie uma nova branch (git checkout -b feature/minha-nova-funcionalidade).
Faça suas alterações e commit-as (git commit -am 'Adiciona nova funcionalidade X').
Envie suas alterações para a branch (git push origin feature/minha-nova-funcionalidade).
Abra um Pull Request.
Licença 📜
Este projeto está licenciado sob a licença MIT License.
=======
<<<<<<< HEAD

# Conexao com o banco é pelo arquivo .env

# ORM com eloquent para implementar o crud

# para adicionar tabelas e com o versionamento do banco usamos a migration
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
>>>>>>> degustacao

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

<<<<<<< HEAD
- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
=======
- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
>>>>>>> degustacao
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

<<<<<<< HEAD
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)
=======
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> degustacao
>>>>>>> origin/main
