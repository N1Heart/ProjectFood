# Relatório de Atividades Semanais

**Data de Entrega:** 03/11/2025
**Nome do Projeto:** Sistema de Gestão (Módulo de Clientes - CRUD)
**Integrantes:**
* Matheus de Farias Lampugnani
* ENIO LOPES PINHEIRO NETO
* Enzo Rafael
* Vitor Nascimento Nunes da Silva

---

### 1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo concluiu o desenvolvimento do **CRUD (Create, Read, Update, Delete)** completo para o módulo de Clientes. O trabalho foi dividido em quatro arquivos principais: `clientes_novo.php` (criação), `clientes.php` (listagem/leitura), `clientes_editar.php` (edição/atualização) e `clientes_apagar.php` (exclusão).

Um ponto crucial desta entrega foi a identificação e **correção de um bug crítico de "headers already sent"**. Isso nos levou a refatorar a arquitetura de todos os arquivos que processam formulários, movendo toda a lógica PHP (processamento de dados, `INSERT`, `UPDATE`, e redirecionamentos `header()`) para o topo do arquivo, antes de qualquer saída HTML ser renderizada.

### 2. Planejamento e Cronograma de Desenvolvimento (Semana de 28/10 a 03/11)

| Tarefa | Responsável(is) | Status | Data de Início | Data de Conclusão | Branch Git |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Criar página de listagem `clientes.php` (SELECT all) | Grupo | Concluído | 28/10/2025 | 29/10/2025 | `feature/crud-clientes` |
| Implementar formulário e lógica de `clientes_novo.php` (INSERT) | Grupo | Concluído | 29/10/2025 | 30/10/2025 | `feature/crud-clientes` |
| Implementar formulário e lógica de `clientes_editar.php` (SELECT one + UPDATE) | Grupo | Concluído | 30/10/2025 | 01/11/2025 | `feature/crud-clientes` |
| Implementar script `clientes_apagar.php` (DELETE) | Grupo | Concluído | 01/11/2025 | 01/11/2025 | `feature/crud-clientes` |
| Adicionar confirmação JS `(onclick="return confirm...")` para exclusão | Grupo | Concluído | 01/11/2025 | 01/11/2025 | `feature/crud-clientes` |
| **Correção Crítica:** Refatorar lógica PHP para o topo dos arquivos (Fix "headers already sent") | Grupo | Concluído | 02/11/2025 | 02/11/2025 | `feature/crud-clientes` |
| Testes integrados do CRUD e Merge na `main` | Matheus de Farias | Concluído | 03/11/2025 | 03/11/2025 | `main` |
| Preparar o relatório semanal de atividades | Matheus de Farias | Concluído | 03/11/2025 | 03/11/2025 | - |

### 3. Relatório Individual de Atividades

[O desenvolvimento do CRUD foi um esforço colaborativo, com a integração e correção de bugs liderada por Matheus de Farias.]

**Matheus de Farias Lampugnani**

* **O que você fez?**
    * R: Liderei a implementação do fluxo completo do CRUD de Clientes. Desenvolvi o `clientes_novo.php` (formulário e lógica `INSERT`), o `clientes.php` (tabela de listagem com `SELECT *`), o `clientes_editar.php` (formulário pré-preenchido com `SELECT...WHERE` e lógica `UPDATE`) e o `clientes_apagar.php` (`DELETE`). Também integrei o pop-up de confirmação em JavaScript para exclusão.
* **Deixou de fazer alguma da atividade proposta?**
    * R: Não, todas as quatro operações do CRUD foram concluídas e estão funcionais.
* **Houve alguma dificuldade? Quais?**
    * R: Sim, a principal dificuldade foi um bug crítico de "headers already sent" no `clientes_novo.php`. Após submeter o formulário, o `INSERT` funcionava, mas o redirecionamento (`header("Location: clientes.php")`) falhava. [Imagem de um fluxograma mostrando a ordem incorreta do código (HTML antes do PHP)] Descobrimos que isso ocorria porque nosso `include('header.php')` enviava o HTML antes da lógica PHP tentar enviar o cabeçalho de redirecionamento. A solução foi refatorar todos os arquivos: agora, 100% da lógica PHP é executada no topo do arquivo, antes de qualquer linha de HTML ser enviada.

### 4. Relatório Geral do Grupo

* **O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?**
    * R: Sim, o fluxo foi bem-sucedido. Todo o módulo de CRUD foi desenvolvido na branch `feature/crud-clientes`. A maior dificuldade do grupo foi, sem dúvida, o bug "headers already sent". Ele quebrava a experiência do usuário, pois o usuário não era redirecionado após uma ação. A solução de mover toda a lógica PHP para o topo dos arquivos foi um grande aprendizado e estabeleceu um novo padrão de codificação para o projeto, que foi aplicado retroativamente também no módulo `funcionarios_novo.php` para garantir consistência.

### 6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

### 7. Observações

* A implementação da confirmação `onclick="return confirm('Tem certeza que deseja apagar?');"` foi uma adição simples de JavaScript que melhorou muito a usabilidade, evitando exclusões acidentais.
* A refatoração da lógica PHP (Processamento antes do HTML) foi o maior ganho desta entrega, tornando nosso código mais robusto e correto.