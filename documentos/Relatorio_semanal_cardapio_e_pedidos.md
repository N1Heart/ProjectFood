# Relatório de Atividades Semanais

**Data de Entrega:** 24/11/2025
**Nome do Projeto:** Sistema de Gestão (Módulo de Pedidos e Cardápio)
**Integrantes:**
* Matheus de Farias Lampugnani
* ENIO LOPES PINHEIRO NETO
* Enzo Rafael
* Vitor Nascimento Nunes da Silva

---

### 1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo concluiu o desenvolvimento do **Módulo de Pedidos** e a implementação do **Cardápio**. Esta foi a entrega mais complexa, pois integra todos os módulos anteriores.

Primeiro, criamos as tabelas `pedidos` e `pedidos_itens` no banco de dados. Em seguida, implementamos o formulário de registro (`pedidos_novo.php`), que é a peça central. Este formulário avançado permite que um funcionário logado selecione um cliente (opcional), adicione múltiplos pratos do cardápio (buscados dinamicamente) e tenha o **valor total calculado em tempo real com JavaScript**.

Para garantir a integridade dos dados, a gravação do pedido no banco de dados é feita usando uma **Transação SQL** (`beginTransaction`/`commit`/`rollBack`), que insere os dados na tabela `pedidos` e `pedidos_itens` de forma atômica.

### 2. Planejamento e Cronograma de Desenvolvimento (Semana de 18/11 a 24/11)

| Tarefa | Responsável(is) | Status | Data de Início | Data de Conclusão | Branch Git |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Modelar e criar tabelas `pedidos` e `pedidos_itens` no BD | Grupo | Concluído | 18/11/2025 | 18/11/2025 | `feature/modulo-pedidos` |
| Implementar módulo/CRUD do Cardápio (base para os pedidos) | Grupo | Concluído | 18/11/2025 | 19/11/2025 | `feature/modulo-pedidos` |
| Criar página de listagem `pedidos.php` (SELECT com JOINs) | Grupo | Concluído | 19/11/2025 | 20/11/2025 | `feature/modulo-pedidos` |
| Desenvolver front-end de `pedidos_novo.php` (HTML/JS) | Grupo | Concluído | 20/11/2025 | 21/11/2025 | `feature/modulo-pedidos` |
| Implementar JavaScript para adicionar itens e calcular total em tempo real | Grupo | Concluído | 21/11/2025 | 22/11/2025 | `feature/modulo-pedidos` |
| Implementar back-end de `pedidos_novo.php` com **Transação SQL** | Grupo | Concluído | 22/11/2025 | 23/11/2025 | `feature/modulo-pedidos` |
| Testes integrados (front-end + back-end) e Merge na `main` | Matheus de Farias | Concluído | 24/11/2025 | 24/11/2025 | `main` |
| Preparar o relatório semanal de atividades | Matheus de Farias | Concluído | 24/11/2025 | 24/11/2025 | - |

### 3. Relatório Individual de Atividades

[Este módulo exigiu uma forte colaboração entre o front-end (JavaScript) e o back-end (PHP/SQL), com a integração liderada por Matheus de Farias.]

**Matheus de Farias Lampugnani**

* **O que você fez?**
    * R: Liderei a arquitetura da funcionalidade mais complexa do sistema: `pedidos_novo.php`. Desenvolvi a lógica de back-end usando uma **Transação SQL**. Isso envolve iniciar (`beginTransaction`), tentar inserir o "cabeçalho" do pedido em `pedidos`, depois fazer um loop para inserir todos os `pedidos_itens`, e só então (`commit`) confirmar a operação. Se qualquer passo falhar, o `rollBack()` desfaz tudo, garantindo que nenhum pedido "fantasma" ou incompleto seja criado.
* **Deixou de fazer alguma da atividade proposta?**
    * R: Não, a funcionalidade de registro de pedidos com cálculo em tempo real e gravação transacional foi concluída com sucesso.
* **Houve alguma dificuldade? Quais?**
    * R: A maior dificuldade foi a integração do front-end com o back-end. No front-end, usar JavaScript para gerenciar uma lista dinâmica de itens (adicionar, remover, calcular total) foi complexo. No back-end, a lógica da Transação [Imagem de um fluxograma de transação SQL com commit e rollback] foi o desafio. Garantir que os dados enviados pelo JavaScript (que podem ser múltiplos itens) fossem corretamente processados em um loop dentro do bloco `try...catch` da transação exigiu muitos testes.

### 4. Relatório Geral do Grupo

* **O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?**
    * R: Sim, todo o desenvolvimento foi feito na branch `feature/modulo-pedidos`. A dificuldade geral do grupo foi a complexidade deste módulo, que não era um CRUD simples. Foi a primeira vez que tivemos que usar JavaScript de forma mais intensa para criar uma interface dinâmica (cálculo em tempo real). Além disso, a implementação da Transação SQL foi um aprendizado técnico crucial. O grupo entendeu que para operações que afetam múltiplas tabelas (como `pedidos` e `pedidos_itens`), uma transação não é opcional, é obrigatória para garantir a integridade dos dados.

### 6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

### 7. Observações

* O cálculo do total em tempo real com JavaScript melhora significativamente a usabilidade do sistema para o funcionário que está registrando o pedido.
* Este módulo finaliza o fluxo principal do sistema, conectando `Funcionários` (quem registra), `Clientes` (para quem é) e `Cardápio/Estoque` (o que é vendido).
```eof