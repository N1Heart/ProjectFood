# Relatório de Atividades Semanais

**Data de Entrega:** 17/11/2025
**Nome do Projeto:** Sistema de Gestão (Módulo de Estoque)
**Integrantes:**
* Matheus de Farias Lampugnani
* ENIO LOPES PINHEIRO NETO
* Enzo Rafael
* Vitor Nascimento Nunes da Silva

---

### 1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo concluiu o **Módulo de Estoque**, o núcleo do sistema. A atividade central foi a criação da listagem principal (`estoque.php`), que utiliza uma consulta `JOIN` complexa para exibir dados de três tabelas simultaneamente: `produtos` (nome, preço), `estoque` (quantidade) e `fornecedores` (nome da empresa).

Implementamos o CRUD de "Catálogo de Produtos" (`produtos_novo.php`, `_editar.php`, `_apagar.php`), destacando-se o uso de **Transações de Banco de Dados** (`beginTransaction`/`commit`/`rollBack`) em `produtos_novo.php`. Isso garante que, ao criar um produto, seu registro de estoque inicial (com "0") seja criado atomicamente; se uma operação falhar, ambas são desfeitas.

Por fim, desenvolvemos os controles de quantidade (`estoque_entrada.php`, `estoque_saida.php`) e implementamos uma **validação crítica** que impede a baixa de produtos caso a quantidade solicitada seja maior que a atual, **evitando estoque negativo**.

### 2. Planejamento e Cronograma de Desenvolvimento (Semana de 11/11 a 17/11)

| Tarefa | Responsável(is) | Status | Data de Início | Data de Conclusão | Branch Git |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Criar `estoque.php` (Listagem com `JOIN` triplo) | Grupo | Concluído | 11/11/2025 | 12/11/2025 | `feature/modulo-estoque` |
| Implementar `produtos_novo.php` (Dropdown dinâmico de fornecedor) | Grupo | Concluído | 12/11/2025 | 13/11/2025 | `feature/modulo-estoque` |
| **Melhoria:** Implementar Transação SQL (`beginTransaction`) em `produtos_novo.php` | Grupo | Concluído | 13/11/2025 | 14/11/2025 | `feature/modulo-estoque` |
| Implementar `produtos_editar.php` e `_apagar.php` (Teste do `ON DELETE CASCADE`) | Grupo | Concluído | 14/11/2025 | 15/11/2025 | `feature/modulo-estoque` |
| Criar `estoque_entrada.php` (UPDATE de soma) | Grupo | Concluído | 15/11/2025 | 16/11/2025 | `feature/modulo-estoque` |
| Criar `estoque_saida.php` (UPDATE de subtração) | Grupo | Concluído | 16/11/2025 | 16/11/2025 | `feature/modulo-estoque` |
| **Validação Crítica:** Adicionar lógica anti-estoque negativo em `_saida.php` | Grupo | Concluído | 17/11/2025 | 17/11/2025 | `feature/modulo-estoque` |
| Testes integrados e Merge na `main` | Matheus de Farias | Concluído | 17/11/2025 | 17/11/2025 | `main` |
| Preparar o relatório semanal de atividades | Matheus de Farias | Concluído | 17/11/2025 | 17/11/2025 | - |

### 3. Relatório Individual de Atividades

[Este módulo exigiu forte integração entre os membros. Matheus de Farias liderou a arquitetura de banco de dados e as lógicas de transação.]

**Matheus de Farias Lampugnani**

* **O que você fez?**
    * R: Fui responsável pela arquitetura do Módulo de Estoque. Implementei a consulta `JOIN` de três tabelas em `estoque.php`. Desenvolvi a lógica mais complexa em `produtos_novo.php`, usando um `<select>` dinâmico (buscando fornecedores no BD) e, o mais importante, uma **Transação SQL (beginTransaction, commit, rollBack)**. Essa transação garante que, ao criar um produto, seu registro de `estoque` com "0" seja criado junto. Se um falhar, ambos são desfeitos (`rollBack`). Também implementei a validação em `estoque_saida.php` que compara a `$quantidade_retirar` com a `$quantidade_atual` para impedir estoque negativo.
* **Deixou de fazer alguma da atividade proposta?**
    * R: Não, todas as funcionalidades planejadas para o módulo foram concluídas.
* **Houve alguma dificuldade? Quais?**
    * R: A maior dificuldade foi a lógica da Transação. Garantir que o `commit()` só fosse chamado se as duas queries (`INSERT em produtos` e `INSERT em estoque`) tivessem sucesso, e que o `rollBack()` fosse chamado em caso de qualquer falha, exigiu testes cuidadosos. [Imagem de um fluxograma de transação SQL] Outro desafio foi a consulta `JOIN` (`produtos` + `estoque` + `fornecedores`), que precisou de aliases para evitar nomes de colunas ambíguos.

### 4. Relatório Geral do Grupo

* **O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?**
    * R: Sim, todo o módulo foi desenvolvido na branch `feature/modulo-estoque` e mesclado à `main` após testes rigorosos. A dificuldade geral foi a complexidade das interações com o banco de dados. Diferente de um CRUD simples, este módulo exigiu `JOINs`, `Transações` para garantir a integridade dos dados (produto não pode existir sem estoque) e validações de lógica de negócio (não pode sair mais do que tem). O grupo também viu em ação a utilidade do `ON DELETE CASCADE`, que definimos no `schema.sql` (na entrega do BD) e que facilitou o script `produtos_apagar.php`, pois o BD cuidou da exclusão do `estoque` automaticamente.

### 6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

### 7. Observações

* A Transação SQL em `produtos_novo.php` é o destaque técnico da entrega, garantindo a **atomicidade** da operação (ou tudo, ou nada).
* A validação em `estoque_saida.php` é uma regra de negócio crítica para a integridade e o funcionamento correto do sistema de estoque.
```eof