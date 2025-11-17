Relatório de Atividades Semanais

Data de Entrega: 17/11/2025
Nome do Projeto: Sistema de Gestão (Módulo de Estoque)
Integrantes:

Matheus de Farias Lampugnani

ENIO LOPES PINHEIRO NETO

Enzo Rafael

Vitor Nascimento Nunes da Silva

1. Resumo Semanal das Atividades Executadas

Nesta semana, o grupo focou na correção e reestruturação do banco de dados, em resposta a falhas identificadas em entregas anteriores. O objetivo foi estabelecer uma base de dados sólida e relacional para o sistema. Implementamos as tabelas centrais: funcionarios (para o módulo de login), clientes (entrega de 03/nov) e fornecedores (entrega de 10/nov). Concluímos o módulo de estoque com as tabelas produtos e estoque, garantindo a correta aplicação das chaves estrangeiras (FOREIGN KEYs) para ligar os produtos aos fornecedores e o estoque aos produtos.

2. Planejamento e Cronograma de Desenvolvimento (Semana de 10/11 a 17/11)

Tarefa

Responsável(is)

Status

Data de Início

Data de Conclusão

Branch Git

Correção: Estruturar Tabela funcionarios (Login)

Grupo

Concluído (Correção)

11/11/2025

12/11/2025

feature/db-schema

Correção: Estruturar Tabela clientes

Grupo

Concluído (Correção)

12/11/2025

13/11/2025

feature/db-schema

Correção: Estruturar Tabela fornecedores

Grupo

Concluído (Correção)

13/11/2025

14/11/2025

feature/db-schema

Implementar Tabela produtos (com FK para fornecedor)

Grupo

Concluído

15/11/2025

16/11/2025

feature/db-schema

Implementar Tabela estoque (com FK para produto)

Grupo

Concluído

16/11/2025

17/11/2025

feature/db-schema

Realizar merge da feature/db-schema na main

Matheus de Farias

Concluído

17/11/2025

17/11/2025

main

Preparar o relatório semanal de atividades

Matheus de Farias

Concluído

17/11/2025

17/11/2025

-

3. Relatório Individual de Atividades

[Conforme a necessidade de correção das entregas anteriores, as atividades de banco de dados foram centralizadas para garantir consistência. O responsável pela integração foi Matheus de Farias Lampugnani.]

Matheus de Farias Lampugnani

O que você fez?

R: Fui responsável por revisar, corrigir e implementar o esquema do banco de dados. Modelei e criei as cinco tabelas principais: funcionarios (essencial para o login), clientes e fornecedores (corrigindo as entregas de 03/nov e 10/nov), e finalizei o módulo de estoque com produtos e estoque. O foco principal foi garantir o relacionamento correto entre as tabelas, aplicando a FOREIGN KEY de fornecedor_id na tabela produtos e de produto_id na tabela estoque.

Deixou de fazer alguma da atividade proposta?

R: Não, todas as tabelas planejadas para esta etapa de correção e implementação foram concluídas.

Houve alguma dificuldade? Quais?

R: A principal dificuldade foi reestruturar o trabalho anterior, que não possuía a integridade relacional necessária. Garantir que as chaves estrangeiras fossem implementadas corretamente, [Imagem de um diagrama de entidade-relacionamento de banco de dados] conectando o estoque ao produto e o produto ao fornecedor, exigiu mais testes para assegurar que os dados não ficassem órfãos.

4. Relatório Geral do Grupo

O grupo conseguiu realizar toda integração do código-fonte usando corretamente a criação de branch's e merge? Quais foram as dificuldades do grupo de modo geral?

R: Sim, desta vez o processo foi mais controlado. Devido à natureza crítica da correção (a "falha na entrega original"), centralizamos o desenvolvimento do script SQL em uma única branch (feature/db-schema) para evitar conflitos. Após a validação do script por todos, ele foi integrado (merge) à main. A dificuldade geral foi a reorganização após a falha anterior. A falta de definição clara do esquema do banco foi o que causou o atraso inicial. Aprendemos que a modelagem de dados precisa ser uma etapa prioritária e bem definida antes do desenvolvimento.

6. Link do Repositório do Projeto

https://github.com/N1Heart/ProjectFood.git

7. Observações

Esta entrega consiste na correção das entregas atrasadas (módulos clientes e fornecedores) e na conclusão do módulo de estoque (produtos e estoque).

Com a base de dados estruturada, o próximo passo é o desenvolvimento das interfaces (CRUD) para interagir com essas tabelas.