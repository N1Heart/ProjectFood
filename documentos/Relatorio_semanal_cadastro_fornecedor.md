# Relatório de Atividades Semanais

**Data de Entrega:** 10/11/2025
**Nome do Projeto:** Sistema de Gestão (Módulo de Fornecedores - CRUD)
**Integrantes:**
* Matheus de Farias Lampugnani
* ENIO LOPES PINHEIRO NETO
* Enzo Rafael
* Vitor Nascimento Nunes da Silva

---

### 1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo implementou o **CRUD (Create, Read, Update, Delete)** completo para o módulo de Fornecedores. Seguindo a arquitetura definida na entrega anterior (lógica PHP antes do HTML), criamos os arquivos `fornecedores_novo.php`, `fornecedores.php` (listagem), `fornecedores_editar.php` e `fornecedores_apagar.php`.

O principal destaque técnico desta entrega foi a implementação de **tratamento de exceção (try...catch) no script de exclusão**. Isso foi feito para capturar erros de violação de chave estrangeira (Foreign Key) do banco de dados, impedindo que o sistema quebre caso o usuário tente apagar um fornecedor que já esteja vinculado a um produto cadastrado.

### 2. Planejamento e Cronograma de Desenvolvimento (Semana de 04/11 a 10/11)

| Tarefa | Responsável(is) | Status | Data de Início | Data de Conclusão | Branch Git |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Criar página de listagem `fornecedores.php` (SELECT all) | Grupo | Concluído | 04/11/2025 | 05/11/2025 | `feature/crud-fornecedores` |
| Implementar `fornecedores_novo.php` (Form + INSERT) | Grupo | Concluído | 05/11/2025 | 06/11/2025 | `feature/crud-fornecedores` |
| Implementar `fornecedores_editar.php` (SELECT one + UPDATE) | Grupo | Concluído | 06/11/2025 | 07/11/2025 | `feature/crud-fornecedores` |
| Implementar `fornecedores_apagar.php` (DELETE) | Grupo | Concluído | 08/11/2025 | 08/11/2025 | `feature/crud-fornecedores` |
| **Melhoria:** Adicionar `try...catch` para erro de FK em `_apagar.php` | Grupo | Concluído | 09/11/2025 | 09/11/2025 | `feature/crud-fornecedores` |
| Testes integrados do CRUD e Merge na `main` | Matheus de Farias | Concluído | 10/11/2025 | 10/11/2025 | `main` |
| Preparar o relatório semanal de atividades | Matheus de Farias | Concluído | 10/11/2025 | 10/11/2025 | - |

### 3. Relatório Individual de Atividades

[O grupo colaborou na construção do CRUD, com Matheus de Farias focando na integração e no tratamento de erros do banco de dados.]

**Matheus de Farias Lampugnani**

* **O que você fez?**
    * R: Fui responsável pela implementação do fluxo de dados do CRUD de Fornecedores, incluindo a criação dos formulários (`_novo` e `_editar`) e da listagem (`.php`). Meu foco principal foi o script `fornecedores_apagar.php`, onde implementei um bloco `try...catch` para capturar exceções de SQL (especificamente, erros de violação de chave estrangeira).
* **Deixou de fazer alguma da atividade proposta?**
    * R: Não, todas as funcionalidades do CRUD, incluindo o tratamento de erro, foram concluídas.
* **Houve alguma dificuldade? Quais?**
    * R: A dificuldade não foi um bug, mas sim um desafio de design: como lidar com a tentativa de exclusão de um fornecedor que possui produtos vinculados? [Imagem de um diagrama de chave estrangeira de banco de dados] A solução foi usar `try...catch` no PHP (PDO). Se o banco de dados retorna um erro de FK, o `catch` é ativado, e nós redirecionamos o usuário de volta para a lista com uma mensagem de erro amigável (ex: "Não é possível apagar este fornecedor, pois ele possui produtos cadastrados."), em vez de mostrar um erro fatal do PHP.

### 4. Relatório Geral do Grupo

* **O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?**
    * R: Sim, todo o desenvolvimento foi feito na branch `feature/crud-fornecedores` e mesclado à `main` após os testes. A maior dificuldade do grupo foi entender como o PHP interage com os erros do banco de dados. Com a implementação do `try...catch`, o grupo aprendeu a criar uma aplicação mais robusta e "à prova de falhas", que lida com exceções de forma controlada e melhora a experiência do usuário. A arquitetura (PHP antes do HTML) adotada na última entrega foi aplicada desde o início e funcionou perfeitamente.

### 6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

### 7. Observações

* O tratamento de erro de chave estrangeira é um passo importante para a integridade do sistema, garantindo que o banco de dados permaneça consistente.
* O próximo passo será aplicar esse mesmo padrão de CRUD ao módulo de Produtos/Estoque.
```eof