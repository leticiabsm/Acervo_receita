# 🧩 Módulo de Cargos

Este módulo faz parte do sistema de gerenciamento de acervo de receitas e é responsável pelo **controle de cargos** atribuídos aos usuários do sistema (como administrador, editor, cozinheiro, degustador etc).

---

## 📋 Funcionalidades

- ✅ Cadastro de novos cargos com nome, descrição e datas.
- ✏️ Edição de cargos existentes.
    - 🟢 Pop-up informando sucesso na atualização.
    - 🔴 Pop-up alertando nenhuma alteração detectada.
- 🗑️ Desativação lógica de cargos (sem exclusão do banco).
- 🔄 Reativação automática com limpeza da data de fim.
- 📆 Controle de datas: início, fim e verificação de validade.

---

## 🖼️ Interface

> Exemplo da listagem de cargos:

| Nome       | Descrição     | Início     | Fim        | Ativo |
|------------|---------------|------------|------------|--------|
| Cozinheiro | Responsável por preparar receitas | 01/01/2025 | - | ✅ |
| Editor     | Gerencia conteúdos do acervo       | 02/01/2025 | 05/01/2025 | ❌ |

---

## 🧠 Validações implementadas

- ❗ **Data Fim** não pode ser menor que a **Data Início**.
- 🚫 Não é possível cadastrar um cargo desativado diretamente.
- 🔄 Ao reativar, a **data_fim** é automaticamente limpa.

---

## 🛠️ Tecnologias Utilizadas

- Laravel 11 ⚙️
- Blade + Bootstrap 🎨
- MySQL 🐬
- PHP 8.2 🐘

---

## 📁 Estrutura Básica

