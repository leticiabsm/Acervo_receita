🧩 Módulo de Ingredientes e Medidas
Este módulo faz parte do sistema de gerenciamento de acervo de receitas e é responsável pelo controle de Medidas e Ingredientes atribuídos aos usuários do sistema (Com :Cozinheiro).

📋 Funcionalidades
✅ Adicionar novas Medidas e Ingrediente, Descrição Medidas:(A descrição de Medidas e obrigatoria),Descrição Medidas:(A descrição de Ingrediente e opção).
✏️ Edição de Medidas e Ingredientes existentes.
🟢 Pop-up informando sucesso na atualização.
🔴 Pop-up alertando nenhuma alteração bloqueada.
🗑️ Exclusão de Medida e Ingrediente (exclusão do banco).
🖼️ Interface
Exemplo de listagem de cargas:

Nome	Descrição	Início	Fim	Ativo
Cozinheiro	Responsável por preparar receitas	01/01/2025	-	✅
Editor	Gerencia conteúdo do acervo	02/01/2025	05/01/2025	❌
🧠 Validações inovadoras
❗ Data Fim não pode ser menor que o Data Início .
🚫 Não é possível cadastrar uma carga desativada diretamente.
🔄 Ao reativar, o data_fim é automaticamente limpo.
🛠️ Tecnologias Utilizadas
Laravel 11 ⚙️
Lâmina + Bootstrap 🎨
MySQL 🐬
PHP 8.2 🐘
📁 Estrutura Básica