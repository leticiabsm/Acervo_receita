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
