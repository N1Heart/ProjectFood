# Relatório de Atividades: Módulo de Cadastro (20/10/2025)

**Data de Entrega:** 20/10/2025
**Nome do Projeto:** Sistema de Gestão (Módulo de Cadastro)
**Integrantes:**
* Matheus de Farias Lampugnani
* ENIO LOPES PINHEIRO NETO
* Enzo Rafael
* Vitor Nascimento Nunes da Silva

---

### 1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo focou no desenvolvimento do módulo de gerenciamento de usuários. O objetivo principal foi implementar a funcionalidade de **criação de novos funcionários**, permitindo que um usuário administrador possa cadastrar novos acessos diretamente de dentro do painel administrativo. A atividade central foi a criação e implementação do arquivo `funcionarios_novo.php`, que contém o formulário HTML e o script PHP para processar os dados e inseri-los no banco de dados.

### 2. Planejamento e Cronograma de Desenvolvimento (Semana de 14/10 a 20/10)

| Tarefa | Responsável(is) | Status | Data de Início | Data de Conclusão | Branch Git |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Estruturar o formulário HTML para `funcionarios_novo.php` | Grupo | Concluído | 15/10/2025 | 16/10/2025 | `feature/cadastro-func` |
| Implementar script PHP para receber dados (POST) | Grupo | Concluído | 16/10/2025 | 17/10/2025 | `feature/cadastro-func` |
| Criar lógica de inserção (INSERT) no banco de dados | Grupo | Concluído | 17/10/2025 | 18/10/2025 | `feature/cadastro-func` |
| Adicionar tratamento de senha com hash (password_hash) | Grupo | Concluído | 18/10/2025 | 19/10/2025 | `feature/cadastro-func` |
| Realizar testes de cadastro e fazer merge na `main` | Matheus de Farias | Concluído | 20/10/2025 | 20/10/2025 | `main` |
| Preparar o relatório semanal de atividades | Matheus de Farias | Concluído | 20/10/2025 | 20/10/2025 | - |

### 3. Relatório Individual de Atividades

[Seguindo o rodízio de responsabilidades, as tarefas desta semana foram focadas na implementação do back-end, com a integração feita por Matheus de Farias.]

**Matheus de Farias Lampugnani**

* **O que você fez?**
    * R: Liderei a implementação da funcionalidade `funcionarios_novo.php`. Fui responsável por desenhar o formulário HTML e desenvolver o script PHP que o processa. Isso incluiu capturar os dados enviados via POST, validá-los e, o mais importante, implementar a query `INSERT` para salvar o novo funcionário na tabela `funcionarios` do banco de dados.
* **Deixou de fazer alguma da atividade proposta?**
    * R: Não, a funcionalidade principal planejada para esta entrega (cadastro de novo funcionário) foi concluída e está operacional.
* **Houve alguma dificuldade? Quais?**
    * R: A principal dificuldade técnica foi garantir que a senha fosse armazenada de forma segura. Implementamos a função `password_hash()` do PHP para criar o hash da senha antes de salvá-la no banco. [Imagem de um fluxo de processamento de formulário PHP] Isso exigiu um ajuste no script de login (feito em outra etapa) para que ele usasse `password_verify()` para autenticar o usuário, garantindo a compatibilidade.

### 4. Relatório Geral do Grupo

* **O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?**
    * R: Sim, o fluxo foi seguido corretamente. Toda a funcionalidade de cadastro foi desenvolvida na branch `feature/cadastro-func`. Após os testes confirmarem que o novo usuário era salvo no banco e conseguia fazer login, realizamos o Pull Request, que foi revisado e integrado (merged) à branch `main` sem conflitos.
    * A dificuldade geral foi o alinhamento inicial entre os nomes dos campos do formulário HTML (os atributos `name=""`) e os nomes exatos das colunas no banco de dados, o que causou algumas falhas na query `INSERT` durante os primeiros testes.

### 6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

### 7. Observações

* O grupo manteve comunicação constante via WhatsApp para alinhar os campos do banco e do formulário.
* Com a funcionalidade de "Criar" (Create) concluída, o próximo passo natural no CRUD de funcionários é desenvolver as páginas de "Ler" (Listar) e "Editar" (Update).

---
---