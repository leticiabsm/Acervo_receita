📖 Gerenciador de Acervo de Receitas - Módulo de Ingredientes e Medidas
Este módulo é parte integrante de um sistema mais amplo de gerenciamento de acervo de receitas. Ele é focado no controle de Medidas e Ingredientes que podem ser atribuídos e utilizados pelos usuários do sistema, especialmente aqueles com o perfil de Cozinheiro.

🚀 Funcionalidades Principais
As principais funcionalidades deste módulo incluem:

Ingredientes 🥦
✅ Criação: Adição de novos ingredientes com Nome (obrigatório) e Descrição (opcional).
✏️ Edição: Atualização de informações de ingredientes existentes.
🗑️ Exclusão: Remoção de ingredientes diretamente do banco de dados.
🔍 Pesquisa: Barra de pesquisa para filtrar ingredientes por nome ou descrição.
🔔 Pop-ups de Feedback:
🟢 Sucesso na atualização.
🔴 Alerta para nenhuma alteração realizada (bloqueada).
Medidas 📏
✅ Criação: Adição de novas medidas com Tipo, Item e Descrição (obrigatória).
✏️ Edição: Atualização de informações de medidas existentes.
🗑️ Exclusão: Remoção de medidas diretamente do banco de dados.
🔍 Pesquisa: Barra de pesquisa para filtrar medidas por tipo, item ou descrição.
🔔 Pop-ups de Feedback:
🟢 Sucesso na atualização.
🔴 Alerta para nenhuma alteração realizada (bloqueada).
Relacionamento Avançado 🤝
Associação Dinâmica: Um ingrediente pode ter múltiplas medidas associadas (Ex: "Farinha" pode ser medida em "xícaras", "gramas" ou "colheres") e uma medida pode ser usada por vários ingredientes.
Tabela Pivô: Utiliza uma tabela intermediária (gmg_ingrediente_medida) para armazenar detalhes específicos da relação, como a quantidade e observação (Ex: "2" de "xícaras" de "farinha", "rasas").
🧠 Validações e Regras de Negócio Inovadoras
Embora as validações a seguir sejam mais comuns em um módulo de "cargas" ou "cargos" (que você mencionou no exemplo), elas representam uma abordagem de validação robusta que pode ser aplicada e adaptada a outras partes do sistema, como o gerenciamento de receitas ou usuários.

❗ Data Fim: A data de término não pode ser anterior à data de início.
🚫 Cadastro Desativado: Não é possível cadastrar um item (ou "carga") diretamente em um estado desativado inicial.
🔄 Reativação Inteligente: Ao reativar um item, o campo data_fim (data de término) é automaticamente limpo, indicando que a atividade está ativa por tempo indeterminado.
💻 Tecnologias Utilizadas
Laravel 11 ⚙️ - Framework PHP para desenvolvimento web robusto.
Blade + Bootstrap 🎨 - Motor de templates do Laravel e framework CSS para uma interface responsiva e estilizada.
MySQL 🐬 - Sistema de gerenciamento de banco de dados relacional.
PHP 8.2 🐘 - Linguagem de programação back-end.
Composer 🎶 - Gerenciador de dependências para PHP.
📋 Pré-requisitos
Para configurar e executar o projeto, você precisará ter:

PHP 8.2+
Composer
MySQL (ou outro SGBD compatível com Laravel)
Servidor Web (Apache, Nginx ou o servidor embutido do Laravel)
🚀 Instalação e Configuração
Siga estes passos para colocar o projeto em funcionamento:

Clone o Repositório:

Bash

git clone <URL_DO_SEU_REPOSITORIO>
cd <nome_do_seu_projeto>
Instale as Dependências:

Bash

composer install
Configure o Ambiente:

Bash

cp .env.example .env
php artisan key:generate
Edite o arquivo .env com suas credenciais de banco de dados (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Execute as Migrations e Seeders:

Bash

php artisan migrate:fresh --seed
Este comando limpa o banco de dados, executa todas as migrações (criando as tabelas de gmg_ingredientes, gmg_medidas e gmg_ingrediente_medida) e popula com dados de teste.

⚙️ Como Usar
Inicie o Servidor de Desenvolvimento:

Bash

php artisan serve
A aplicação estará disponível em http://127.0.0.1:8000.

Acesse as Interfaces:

Lista de Ingredientes: http://127.0.0.1:8000/ingredientes
Lista de Medidas: http://127.0.0.1:8000/medidas
Utilize as barras de pesquisa para filtrar os resultados nas listas.

Teste os Relacionamentos (via Tinker):
Abra o console do Laravel:

Bash

php artisan tinker
E interaja com os modelos:

PHP

use App\Models\Ingrediente;
use App\Models\Medida;

$farinha = Ingrediente::first(); // Pega o primeiro ingrediente
$xicara = Medida::first();     // Pega a primeira medida

if ($farinha && $xicara) {
    $farinha->medidas()->attach($xicara->idMedida, ['quantidade' => 250.5, 'observacao' => 'gramas']);
    echo "Medida anexada com sucesso!\n";

    // Exibir medidas do ingrediente
    echo "Medidas para " . $farinha->nome . ":\n";
    foreach ($farinha->medidas as $medida) {
        echo "- " . $medida->pivot->quantidade . " " . $medida->tipo . " (" . $medida->item . ")\n";
    }
} else {
    echo "Crie ingredientes e medidas primeiro com db:seed ou manualmente.\n";
}
📂 Estrutura de Diretórios Básica
.
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── IngredienteController.php # Lógica CRUD e pesquisa para Ingredientes
│   │       └── MedidaController.php      # Lógica CRUD e pesquisa para Medidas
│   └── Models/
│       ├── Ingrediente.php             # Modelo Eloquent para 'gmg_ingredientes'
│       └── Medida.php                  # Modelo Eloquent para 'gmg_medidas'
├── database/
│   ├── migrations/
│   │   ├── ..._create_gmg_ingredientes_table.php
│   │   ├── ..._create_gmg_medidas_table.php
│   │   └── ..._create_gmg_ingrediente_medida_table.php # Tabela pivô
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── IngredienteMedidaSeeder.php   # Dados de teste para Ingredientes e Medidas
├── resources/
│   └── views/
│       ├── ingredientes/                 # Views para o CRUD de Ingredientes
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── medidas/                      # Views para o CRUD de Medidas
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
└── routes/
    └── web.php                       # Definição das rotas web
🔮 Próximos Passos (Possíveis Melhorias)
Módulo de Receitas: Desenvolver a funcionalidade principal para criar e gerenciar receitas, utilizando os ingredientes e medidas cadastrados.
Autenticação e Autorização: Implementar um sistema de usuários e papéis (Cozinheiro, Editor, etc.) para controle de acesso.
Otimização de UI/UX: Aprimorar a interface com frameworks CSS mais avançados ou componentes de UI.
Paginção: Adicionar paginação às listagens para grandes volumes de dados.
Testes Automatizados: Escrever testes unitários e de funcionalidade para garantir a robustez do sistema.
