Notificações de Lembrete de Reserva-Sistema de gerenciamento Restaurante com franquia

Documento para Especificação de requisitos

Versão 1.0

Data 25/08/2025

Nome: Matheus de Farias 802.539, Enzo Rafael Squisiato 802.212, Vitor nascimento 802.585, Enio Lopes Pinheiro 802.480

**Histórico de Revisões**

| Data | Versão | Descrição | Autor |
| :---: | :---: | :---: | :---: |
| 25/08/2025 | 1.0 | Formulação do Documento | Matheus |
| 01/09/2025 | 1.1 | Conclusão dos RF e adição dos RNs | Victor e Enio  |
| 06/10/2025 | 1.1.1 | adição de um requisito especificando a criação do modulo de estoque | Enzo |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |

		**Sumário**

Introdução.......................................................................................................x

1. Escopo............................................................................................................x  
2. Público-alvo....................................................................................................x  
3. Padrões e Convenções..................................................................................x  
4. Requisitos funcionais......................................................................................x  
5. Requisitos não funcionais...............................................................................x  
6. Requisitos de negócio....................................................................................x

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

   

Introdução

O projeto está sendo desenvolvido durante as aulas de Gerência de Configuração com o objetivo de trabalhar conceitos como versionamento, gerenciamento de configuração, tratamento de requisitos e simulações de mudança

1. Escopo

O projeto visa alcançar uma versão estável de um software de gerenciamento com foco na consistência, usabilidade e integração cliente/restaurante


2. Público-alvo

O público alvo são donos e franquias de restaurantes com uma ou mais unidades que precisem de um sistema de gerenciamento robusto que permita uma gestão dinâmica possibilitando o empreendimento de energia para a tomada de decisões mais importantes para o crescimento do negócio 

3. Padrões e Convenções

Idioma Principal: Toda a documentação oficial do projeto será redigida em Português do Brasil (pt-BR).

#### Formatação de Documentos

Fonte:

* Tipo: Arial  
  * Tamanho (Corpo do texto): 12pt

Ex. **Tipos de requisito:**   
RF \= Requisitos Funcionais   
RNF \= Requisitos Não-Funcionais   
RN \= Requisitos de Negócios   
**Nº Identificador:**   
ID 001 a 100, em sequência numérica crescente por tipo de requisito.

4. Requisitos funcionais

| ID | Descrição do Requisito |
| :---- | :---- |
| RF001 | O sistema deve permitir o cadastro de clientes com CPF, nome, data de nascimento, telefone e e-mail. |
| RF002 | O sistema deve gerenciar bonificações automáticas para clientes em seus aniversários. |
| RF003 | O sistema deve gerenciar bonificações automáticas para clientes com base em metas de consumo. |
| RF004 | O sistema deve permitir o registro e a consulta de alergias alimentares dos clientes. |
| RF005 | O sistema deve exibir de forma clara os dias e horários disponíveis para reserva. |
| RF006 | O sistema deve permitir o pagamento de um sinal para confirmar a reserva. |
| RF007 | O sistema deve enviar notificações automáticas (e-mail ou SMS) para confirmar as reservas. |
| RF008 | O sistema deve enviar notificações automáticas (e-mail ou SMS) para lembrar os clientes de suas reservas. |
| RF009 | O sistema deve gerar relatórios de quantidade de reservas por período. |
| RF010 | O sistema deve permitir o cadastro detalhado de pratos e bebidas, incluindo preço e promoções. |
| RF011 | O sistema deve permitir a alteração do status de disponibilidade de um item do cardápio (disponível/indisponível). |
| RF012 | O sistema deve permitir vincular pratos do cardápio a alérgenos específicos. |
| RF013 | O sistema deve permitir que os garçons registrem os pedidos dos clientes. |
| RF014 | O sistema deve possuir um painel para a cozinha monitorar o status dos pedidos (em preparo, pronto, entregue). |
| RF015 | O sistema deve integrar o registro de pedidos com o painel da cozinha em tempo real. |
| RF016 | O sistema deve dar baixa automática dos ingredientes no estoque após a confirmação de um pedido. |
| RF017 | O sistema deve exibir alertas visuais sobre as alergias do cliente no momento do registro do pedido. |
| RF018 | O sistema deve processar pagamentos em diversas formas (cartão de crédito/débito, PIX, etc.). |
| RF019 | O sistema deve gerar comprovantes fiscais eletrônicos para cada transação. |
| RF020 | O sistema deve monitorar o consumo de ingredientes do estoque em tempo real. |
| RF021 | O sistema deve permitir o cadastro de ingredientes e seus respectivos fornecedores. |
| RF022 | O sistema deve enviar alertas automáticos quando o estoque de um item atingir um nível baixo. |
| RF023 | O sistema deve gerar relatórios de consumo de ingredientes por período. |
| RF024 | O sistema deve possuir uma funcionalidade para o fechamento diário do caixa. |
| RF025 | O sistema deve gerar relatórios financeiros de custos e um balanço por período. |
| RF026 | O sistema deve permitir o cadastro de funcionários e o gerenciamento de suas credenciais de acesso. |
| RF027 | O sistema deve permitir o armazenamento de informações de escalas de trabalho e folgas dos funcionários. |
| RF028 | O sistema deve gerar relatórios de dias trabalhados e faltas dos funcionários. |
| RF029 | criação do Modulo de Estoque |

| ID \- RF001 | Cadastro de clientes |
| :---- | :---- |
| **Descrição** | **cadastro do cliente mediante coleta de informações básicas** |
| **Tamanho** |  |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | Fluxo de eventos principal O usuário (atendente/gerente) seleciona a opção "Clientes" no menu principal e, em seguida, clica no botão "Adicionar Novo Cliente". O sistema exibe o formulário "Cadastro de Cliente" com os campos: CPF, Nome Completo, Data de Nascimento, Telefone e E-mail. O usuário preenche todos os campos com dados válidos. O usuário clica no botão "Salvar". O sistema valida os dados inseridos (ex: formato do CPF, formato do e-mail). O sistema verifica se o CPF informado já não existe na base de dados. O sistema armazena as informações do novo cliente no banco de dados. O sistema exibe a mensagem "Cliente cadastrado com sucesso\!" e redireciona o usuário para a tela de listagem de clientes, onde o novo cliente já aparece na lista.  |
| **Fluxos secundários**   | **Fluxo Alternativo (FA01) \- Cancelar Cadastro:** No passo 4 do fluxo principal, o usuário clica no botão "Cancelar". O sistema descarta todas as informações inseridas. O sistema retorna o usuário para a tela de listagem de clientes. **Fluxo de Exceção (FE01) \- Dados Inválidos ou Faltantes:** No passo 5 do fluxo principal, o sistema detecta que um ou mais campos obrigatórios não foram preenchidos ou contêm um formato inválido (ex: CPF com menos de 11 dígitos). O sistema não salva o registro. O sistema exibe o formulário novamente, destacando os campos com erro e mostrando uma mensagem de ajuda ao lado de cada um (ex: "Formato de CPF inválido", "Campo obrigatório"). **Fluxo de Exceção (FE02) \- Cliente Duplicado:** No passo 6 do fluxo principal, o sistema detecta que o CPF informado já pertence a um cliente cadastrado. O sistema não salva o registro. O sistema exibe uma mensagem de erro na tela: "Já existe um cliente cadastrado com este CPF. Verifique os dados inseridos."  |
| **Interfaces associadas**   | Tela de Listagem de Clientes: Interface que exibe todos os clientes cadastrados e contém o botão "Adicionar Novo Cliente". Formulário de Cadastro de Cliente: Interface para a entrada dos dados do novo cliente. Pop-up de Confirmação/Erro: Janela modal para exibir mensagens de sucesso ou de erro ao usuário.  |
| **Entradas e pré-condições** | Entradas: Dados do cliente (CPF, nome, data de nascimento, telefone, e-mail). Pré-condições: O usuário deve estar autenticado no sistema e possuir permissão para cadastrar novos clientes.  |
| **Saídas e condições esperadas** | Saídas: Mensagem de sucesso ou erro. Pós-condições (em caso de sucesso): Um novo registro de cliente deve existir no banco de dados do sistema, contendo todas as informações fornecidas.  |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Matheus de Farias lampugnani** |
| **Data da última atualização** | 25/08/2025 |
| **Responsável pela última atualização** | **Matheus de Farias Lampugnani** |
| **Histórico de modificações** | **1.0 Formulação inicial do requisito** |

   

   

   

   

   

   

   

 


| ID \- RF002 | Bonificações de aniversário  |
| :---- | :---- |
| **Descrição** | **O sistema deve conferir bonificações automaticamente para clientes aniversariantes.** |
| **Tamanho** | **Médio (Requer um processo automatizado \- "job" \- e regras de negócio para a bonificação)** |
| **Prioridade** | **Média (Agrega valor e fideliza, mas não impede o funcionamento básico)** |
| **Status** | **A Fazer** |
|  **Fluxo de eventos principal**   | Diariamente, em um horário pré-determinado (ex: 00:01), o sistema executa uma rotina automática. A rotina verifica no banco de dados todos os clientes cujo aniversário corresponde à data atual. Para cada cliente aniversariante, o sistema aplica uma bonificação pré-configurada (ex: cupom de desconto, um item de cortesia) à sua conta. O sistema pode, opcionalmente, disparar uma notificação (e-mail/SMS) parabenizando o cliente e informando sobre o bônus. A rotina registra a concessão do bônus no histórico do cliente.  |
| **Fluxos secundários**   | Fluxo de Exceção (FE01) \- Sem aniversariantes: Caso a rotina não encontre clientes aniversariando no dia, ela é encerrada sem executar nenhuma ação. Fluxo de Exceção (FE02) \- Bônus desativado: Se a regra de negócio para o bônus de aniversário estiver desativada nas configurações, a rotina não é executada. Interfaces associadas  |
| **Interfaces associadas**   | Painel de Configuração de Promoções: Tela onde o administrador define qual é o bônus de aniversário e se a promoção está ativa. Perfil do Cliente: Tela onde o cliente ou atendente pode visualizar os bônus ativos.  |
| **Entradas e pré-condições** | Entradas: Data atual. Pré-condições: O cliente deve ter a data de nascimento corretamente cadastrada. A regra de bonificação de aniversário deve estar criada e ativa no sistema.  |
| **Saídas e condições esperadas** | Saídas: Log da execução da rotina. Notificação para o cliente (opcional). Pós-condições: Clientes aniversariantes do dia possuem um novo bônus associado às suas contas.  |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Matheus de Farias lampugnani** |
| **Data da última atualização** | 25/08/2025 |
| **Responsável pela última atualização** | **Matheus de Farias Lampugnani** |
| **Histórico de modificações** | **1.0 Formulação inicial do requisito** |

   

 


| ID \- RF003 | Bonificação por Metas de Consumo |
| :---- | :---- |
| **Descrição** | **O sistema deve gerenciar bonificações automáticas para clientes com base em metas de consumo e histórico de reservas.** |
| **Tamanho** | **Grande (Requer um motor de regras complexo e análise de histórico)** |
| **Prioridade** | **Média** |
| **Status** | **A Fazer** |
|  **Fluxo de eventos principal**   | Após o fechamento de um pedido e confirmação do pagamento, o sistema acessa o histórico do cliente. O sistema calcula o valor total consumido ou a quantidade de reservas do cliente em um período pré-configurado. O sistema compara o resultado com as regras de bonificação ativas (ex: "A cada R$ 500,00 consumidos, ganhe um voucher de R$ 25,00"). Se o cliente atingir uma meta, o sistema aplica o bônus correspondente à sua conta. O sistema notifica o cliente (via app, e-mail ou no próprio comprovante) sobre o novo bônus adquirido. |
| **Fluxos secundários**   | Fluxo de Exceção (FE01) \- Meta não atingida: Se o consumo do cliente não atingir nenhuma meta, o fluxo é encerrado sem aplicar bônus. Interfaces associadas Painel de Configuração de Promoções: Onde o administrador cria as metas (ex: valor, quantidade de visitas) e os bônus correspondentes.  |
| **Interfaces associadas**   | **Painel de Configuração de Promoções:** Onde o administrador cria as metas (ex: valor, quantidade de visitas) e os bônus correspondentes. |
| **Entradas e pré-condições** | Entradas: ID do Cliente, valor do último consumo. Pré-condições: O cliente deve estar identificado no pedido. As regras de metas de consumo devem estar ativas. |
| **Saídas e condições esperadas** | **Saídas:** Bônus aplicado à conta do cliente. **Pós-condições:** O cliente que atingiu a meta tem um bônus disponível para uso futuro. O contador para a próxima meta é reiniciado ou atualizado.  |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Matheus de Farias lampugnani** |
| **Data da última atualização** | 25/08/2025 |
| **Responsável pela última atualização** | **Matheus de Farias Lampugnani** |
| **Histórico de modificações** | **1.0 Formulação inicial do requisito** |

   

 


| ID \- RF004 | Registro de Alergias Alimentares do Cliente |
| :---- | :---- |
| **Descrição** | **Permitir o registro e consulta de alergias alimentares dos clientes para garantir a segurança no preparo dos pedidos.** |
| **Tamanho** | **Pequeno** |
| **Prioridade** | **Alta (Crucial para a segurança do cliente)** |
| **Status** | **A Fazer** |
|  **Fluxo de eventos principal**   | O usuário acessa o cadastro de um cliente existente. O usuário localiza a seção "Alergias Alimentares". O usuário adiciona uma ou mais alergias a partir de uma lista pré-definida ou por texto livre. O usuário salva as alterações no cadastro do cliente. O sistema armazena as informações de alergia vinculadas ao cliente.  |
| **Fluxos secundários**   | Fluxo Alternativo (FA01) \- Remover Alergia: O usuário pode remover uma alergia previamente registrada no perfil do cliente. Interfaces associadas Formulário de Cadastro/Edição de Cliente: Deve conter um campo ou seção específica para o registro das alergias. Entradas e pré-condições |
| **Interfaces associadas**   |  **Formulário de Cadastro/Edição de Cliente:** Deve conter um campo ou seção específica para o registro das alergias. |
| **Entradas e pré-condições** | **Entradas: Descrição da(s) alergia(s). Pré-condições: O usuário precisa estar na tela de edição de um cliente específico. Saídas e condições esperadas**  |
| **Saídas e condições esperadas** | Mensagem de sucesso ("Informações do cliente atualizadas."). |
| **Data de criação** | **Matheus de Farias lampugnani** |
| **Responsável pela criação** | 25/08/2025 |
| **Data da última atualização** | **Matheus de Farias Lampugnani** |
| **Responsável pela última atualização** | **1.0 Formulação inicial do requisito** |
| **Histórico de modificações** | **Matheus de Farias lampugnani** |

   

 


| ID \- RF005, | Exibição de Disponibilidade de Reservas |
| :---- | :---- |
| **Descrição** | **Exibir de forma clara os horários e dias disponíveis para reserva.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | 1\. O usuário acessa a tela de reservas. 2\. O usuário seleciona um dia e a quantidade de pessoas. 3\. O sistema consulta a ocupação e as regras de horário. 4\. O sistema exibe uma grade de horários, marcando visualmente quais estão disponíveis, parcialmente disponíveis ou indisponíveis. |
| **Fluxos secundários**   |  **FA01 \- Mudar data/pessoas: O usuário altera os parâmetros da busca e a grade de horários é atualizada. FE01 \- Dia sem disponibilidade: O sistema exibe uma mensagem informando que não há horários disponíveis para a data selecionada.** |
| **Interfaces associadas**   | "Tela de Gestão de Reservas. |
| **Entradas e pré-condições** | Entradas: Data, quantidade de pessoas. Pré-condições: Regras de capacidade e horários de funcionamento devem estar configurados. |
| **Saídas e condições esperadas** | Saídas: Grade de horários com status de disponibilidade.  Pós-condições: O usuário tem uma visão clara de quando pode fazer uma reserva." |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **VItor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **Criação inicial do requisito** |

   

 


| ID \- RF006 | Pagamento de Sinal para Reserva |
| :---- | :---- |
|  |  |
| **Descrição** | **Coletar pagamento de sinal para a confirmação da reserva.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A fazer**  |
|  **Fluxo de eventos principal**   | Após selecionar um horário para a reserva, o sistema informa sobre a necessidade de um sinal. O usuário clica em "Confirmar e Pagar". O sistema redireciona para um gateway de pagamento com o valor do sinal. O usuário efetua o pagamento. O gateway de pagamento retorna a confirmação. O sistema atualiza o status da reserva para "Confirmada".  |
| **Fluxos secundários**   | ***FE01 \- Pagamento recusado:* O gateway informa a recusa e o sistema exibe uma mensagem de erro. A reserva não é confirmada. *FE02 \- Tempo esgotado:* Se o usuário não completar o pagamento em um tempo pré-determinado, a pré-reserva é cancelada.** |
| **Interfaces associadas**   | Tela de Gestão de Reservas, Gateway de Pagamento. |
| **Entradas e pré-condições** | Integração com o gateway de pagamento configurada. Valor do sinal definido nas regras de negócio. Status: "Status da reserva".  |
| **Saídas e condições esperadas** | Reserva confirmada no sistema. Transação financeira registrada.  |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF007 | Notificações de Confirmação de Reserva |
| :---- | :---- |
| **Descrição** | **enviar notificações automáticas (e-mail ou SMS) aos clientes para confirmar suas reservas.** |
| **Tamanho** | **pequeno** |
| **Prioridade** | **alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | Após a reserva ser confirmada no sistema (por pagamento de sinal ou confirmação manual), o sistema dispara um evento de "Reserva Confirmada". O sistema envia automaticamente um e-mail e/ou SMS para o cliente com os detalhes da reserva.  |
| **Fluxos secundários**   | ***FE01 \- Falha no envio:* Se o serviço de notificação falhar, o sistema registra o erro e tenta reenviar posteriormente.** |
| **Interfaces associadas**   | Serviço de E-mail/SMS |
| **Entradas e pré-condições** | ID da reserva Dados do cliente Templates de mensagem configurados  |
| **Saídas e condições esperadas** | Cliente formalmente notificado Mensagem enviada com dados válidos  |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF008 | Notificações de Lembrete de Reserva |
| :---- | :---- |
| **Descrição** | **Enviar notificações automáticas (e-mail ou SMS) aos clientes para lembrá-los de suas reservas.** |
| **Tamanho** | **Pequeno** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer,** |
|  **Fluxo de eventos principal**   | **1\. Uma rotina automática é executada periodicamente (ex: a cada hora). 2\. A rotina busca por reservas confirmadas que ocorrerão em um futuro próximo (ex: nas próximas 24 horas). 3\. Para cada reserva encontrada, o sistema envia um e-mail/SMS de lembrete para o cliente. 4\. A notificação contém os detalhes da reserva e, opcionalmente, um link para cancelamento.** |
| **Fluxos secundários**   | **FE01 \- Falha no envio: O sistema registra o erro e tenta reenviar.** |
| **Interfaces associadas**   | **Serviço de E-mail/SMS** |
| **Entradas e pré-condições** | **Entradas: Data/hora atual. Pré-condições: Templates de lembrete configurados. Intervalo de lembrete definido.** |
| **Saídas e condições esperadas** | Saídas: E-mail/SMS enviado Pós-condições: Cliente é lembrado sobre sua reserva, reduzindo a chance de ""no-show"” |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF009 | Relatórios de Reservas |
| :---- | :---- |
| **Descrição** | **Gerar relatórios sobre a quantidade de reservas por período, facilitando a análise de fluxo de clientes.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **1\. O usuário (gerente) acessa a área de relatórios e seleciona ""Relatório de Reservas"". 2\. O sistema exibe filtros como ""Período (data inicial e final)"", ""Status da reserva"", etc. 3\. O usuário preenche os filtros e clica em ""Gerar Relatório"". 4\. O sistema processa os dados de reservas do período e exibe um relatório com totais, gráficos de fluxo por dia/hora e outras métricas. 5\. O sistema permite exportar o relatório (PDF, Excel).** |
| **Fluxos secundários**   |  **FA01 \- Período sem dados: Se não houver reservas no período selecionado, o sistema exibe uma mensagem informativa.** |
| **Interfaces associadas**   | **Tela de Relatórios** |
| **Entradas e pré-condições** | **Entradas: Filtros de período e status. Pré-condições: Usuário com permissão para acessar relatórios** |
| **Saídas e condições esperadas** | Saídas: Relatório em tela ou arquivo exportado. Pós-condições: Gestor tem acesso a dados consolidados para tomada de decisão. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF010 | Cadastro de Itens do Cardápio |
| :---- | :---- |
| **Descrição** | **Permitir o cadastro detalhado de pratos e bebidas, incluindo preço e promoções.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **1\. O usuário acessa o módulo de ""Cardápio"" e seleciona ""Adicionar Novo Item"". 2\. O sistema exibe um formulário para cadastro do item (nome, descrição, categoria, preço, foto). 3\. O usuário preenche as informações do item. 4\. O usuário pode, opcionalmente, associar o item a uma promoção ativa. 5\. O usuário clica em ""Salvar"". 6\. O sistema armazena o novo item do cardápio no banco de dados** |
| **Fluxos secundários**   | **FA01 \- Editar Item: Usuário pode selecionar um item existente para editar suas informações.** |
| **Interfaces associadas**   | **Formulário de Cadastro/Edição de Item do Cardápio.** |
| **Entradas e pré-condições** |  **Entradas: Dados do item (nome, preço, etc.). Pré-condições: Usuário com permissão para gerenciar o cardápio.** |
| **Saídas e condições esperadas** | Saídas: Mensagem de sucesso. Pós-condições: Um novo item está disponível para ser adicionado em pedidos. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF011 | Gestão de Disponibilidade de Itens do Cardápio |
| :---- | :---- |
| **Descrição** | **Permitir a alteração do status de disponibilidade de um item do cardápio (disponível/indisponível).** |
| **Tamanho** | **Pequeno** |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **1\. O usuário acessa a listagem de itens do cardápio. 2\. Ao lado de cada item, existe um controle (ex: um botão toggle) para alterar seu status de disponibilidade. 3\. O usuário clica no controle para marcar um item como ""Indisponível"". 4\. O sistema atualiza o status do item em tempo real. O item não poderá mais ser selecionado em novos pedidos.** |
| **Fluxos secundários**   | **FA01 \- Marcar como Disponível: O usuário clica novamente no controle para reverter o status para ""Disponível"".** |
| **Interfaces associadas**   | **Tela de Gestão do Cardápio** |
| **Entradas e pré-condições** | **Entradas: ID do Item, novo status. Pré-condições: Usuário logado com permissão.** |
| **Saídas e condições esperadas** | Saídas: Confirmação visual da mudança de status. Pós-condições: O status do item é atualizado para todos os terminais de atendimento. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF012 | Vincular Itens do Cardápio a Alérgenos |
| :---- | :---- |
| **Descrição** | **Permitir vincular pratos a alérgenos específicos para que a equipe de atendimento possa alertar os clientes sobre o risco.** |
| **Tamanho** | **Pequeno** |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **1\. O usuário acessa a tela de edição de um item do cardápio. 2\. O sistema exibe uma seção ""Alérgenos"". 3\. O usuário seleciona, a partir de uma lista pré-definida (glúten, lactose, nozes, etc.), quais alérgenos estão presentes no item. 4\. O usuário salva as alterações.** |
| **Fluxos secundários**   | **FA01 \- Desvincular Alérgeno: O usuário pode desmarcar um alérgeno previamente associado.** |
| **Interfaces associadas**   | **Formulário de Cadastro/Edição de Item do Cardápio.** |
| **Entradas e pré-condições** |  **Entradas: ID do Item, lista de alérgenos. Pré-condições: Lista de alérgenos comuns deve estar pré-cadastrada no sistema.** |
| **Saídas e condições esperadas** | Saídas: Mensagem de sucesso.  Pós-condições: A informação de alérgenos do item é armazenada e pode ser consultada. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF013 | Registro de Pedidos |
| :---- | :---- |
| **Descrição** | **O sistema deve permitir que os garçons registrem os pedidos dos clientes.** |
| **Tamanho** | **Medio** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Garçom acessa a interface de pedidos. Seleciona a mesa/cliente. Escolhe os itens do cardápio. Confirma o pedido. Pedido é registrado no sistema e enviado para a cozinha.** |
| **Fluxos secundários**   | Alteração/cancelamento de pedido antes do envio para cozinha. Erro de conexão impede registro temporário (usar fila offline).  |
| **Interfaces associadas**   |  **Interface de Pedidos (Garçom).** |
| **Entradas e pré-condições** | **Mesa/cliente deve estar cadastrado.** |
| **Saídas e condições esperadas** | Pedido registrado e disponível para cozinha |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF014 | Painel da Cozinha |
| :---- | :---- |
| **Descrição** | **O sistema deve possuir um painel para a cozinha monitorar o status dos pedidos (em preparo, pronto, entregue).** |
| **Tamanho** | **Medio** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Pedido chega ao painel da cozinha. Cozinheiro atualiza o status (em preparo → pronto → entregue). Status atualizado é refletido para garçom/cliente.** |
| **Fluxos secundários**   | **Pedido cancelado antes da finalização.** |
| **Interfaces associadas**   | **Painel da Cozinha.** |
| **Entradas e pré-condições** | **Pedido deve estar registrado.** |
| **Saídas e condições esperadas** | Status atualizado em tempo real. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF015 | Integração Pedidos/Cozinha |
| :---- | :---- |
| **Descrição** |  **O sistema deve integrar o registro de pedidos com o painel da cozinha em tempo real.** |
| **Tamanho** | **Alto** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Pedido registrado pelo garçom. Sistema envia automaticamente para o painel da cozinha. Cozinha recebe notificação instantânea.** |
| **Fluxos secundários**   | **Falha de rede → sincronização assim que reconexão ocorrer.** |
| **Interfaces associadas**   | **Interface de Pedidos, Painel da Cozinha.** |
| **Entradas e pré-condições** | **Conexão ativa entre módulos.** |
| **Saídas e condições esperadas** | Pedido refletido imediatamente na cozinha. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF016 | Baixa no Estoque |
| :---- | :---- |
| **Descrição** | **O sistema deve dar baixa automática dos ingredientes no estoque após a confirmação de um pedido.** |
| **Tamanho** | **Alto** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Pedido confirmado. Sistema identifica os ingredientes necessários. Estoque atualizado automaticamente.** |
| **Fluxos secundários**   | **Ingrediente insuficiente → alerta exibido.** |
| **Interfaces associadas**   | **Painel de Pedidos, Módulo de Estoque.** |
| **Entradas e pré-condições** |  **Ingredientes cadastrados no sistema.** |
| **Saídas e condições esperadas** | Estoque atualizado em tempo real. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF017 | Alertas de Alergia |
| :---- | :---- |
| **Descrição** | **O sistema deve exibir alertas visuais sobre as alergias do cliente no momento do registro do pedido.** |
| **Tamanho** | **Media** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Garçom seleciona cliente. Sistema exibe alergias registradas. Ao adicionar item com alérgeno, alerta visual é exibido.** |
| **Fluxos secundários**   | **Cliente sem alergias → fluxo segue normal.** |
| **Interfaces associadas**   | **Interface de Pedidos.** |
| **Entradas e pré-condições** | **Alergias cadastradas no perfil do cliente.** |
| **Saídas e condições esperadas** | Alerta exibido ao garçom. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF018 | Pagamentos |
| :---- | :---- |
| **Descrição** | **O sistema deve processar pagamentos em diversas formas (cartão de crédito/débito, PIX, etc.).** |
| **Tamanho** | **Alto** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Cliente solicita pagamento. Garçom/caixa seleciona forma de pagamento. Sistema processa a transação. Status confirmado.** |
| **Fluxos secundários**   | **Pagamento negado → solicitar nova forma de pagamento.** |
| **Interfaces associadas**   | **Tela de Pagamento.** |
| **Entradas e pré-condições** | **Pedido finalizado.** |
| **Saídas e condições esperadas** | Pagamento confirmado. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF019 | Comprovante Fiscal |
| :---- | :---- |
| **Descrição** | **O sistema deve gerar comprovantes fiscais eletrônicos para cada transação.** |
| **Tamanho** | **Medio** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Pagamento aprovado. Sistema gera NF-e. Cliente recebe cópia impressa ou digital.** |
| **Fluxos secundários**   | **Falha na emissão → fila de reprocessamento.** |
| **Interfaces associadas**   | **Tela de Pagamento, Módulo Fiscal.** |
| **Entradas e pré-condições** | **Pagamento concluído.** |
| **Saídas e condições esperadas** | Nota fiscal gerada. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF020 | Monitoramento Estoque |
| :---- | :---- |
| **Descrição** | **O sistema deve monitorar o consumo de ingredientes do estoque em tempo real.** |
| **Tamanho** | **Medio** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Pedido registrado. Sistema calcula consumo. Estoque atualizado automaticamente.** |
| **Fluxos secundários**   | **Estoque inconsistente → alerta enviado ao administrador.** |
| **Interfaces associadas**   |  **Painel de Estoque.** |
| **Entradas e pré-condições** | **Ingredientes cadastrados.** |
| **Saídas e condições esperadas** |  Relatórios e alertas atualizados. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF021 | Cadastro de Ingredientes |
| :---- | :---- |
| **Descrição** | **Cadastro de Ingredientes e Fornecedores** |
| **Tamanho** | **Medio** |
| **Prioridade** | **Media** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Administrador acessa cadastro. Preenche dados do ingrediente e fornecedor. Salva informações.** |
| **Fluxos secundários**   | **Tentativa de cadastro duplicado → alerta exibido.** |
| **Interfaces associadas**   | **Tela de Cadastro de Ingredientes.** |
| **Entradas e pré-condições** | **Usuário com permissão de administrador.** |
| **Saídas e condições esperadas** | Ingrediente registrado. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Enio Lopes Pinheiro Neto** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Enio Lopes Pinheiro Neto** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

 


| ID \- RF022 |  Alertas automáticos de estoque baixo |
| :---- | :---- |
| **Descrição** | **O sistema deve enviar alertas automáticos quando o estoque de um item atingir um nível baixo.** |
| **Tamanho** | **Pequeno** |
| **Prioridade** | **Alta** |
| **Status** | **Pendente** |
|  **Fluxo de eventos principal**   | **Monitoramento contínuo do estoque. Identificação do nível crítico de estoque. Envio automático de alerta para o responsável.** |
| **Fluxos secundários**   | **Possibilidade de configurar níveis de alerta personalizados.** |
| **Interfaces associadas**   | **Sistema de notificações.** |
| **Entradas e pré-condições** | **Configuração de níveis mínimos de estoque.** |
| **Saídas e condições esperadas** | Alerta enviado no momento correto para reposição do estoque. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF023 |  Relatórios de consumo de ingredientes por período |
| :---- | :---- |
| **Descrição** |  **O sistema deve gerar relatórios de consumo de ingredientes por período.** |
| **Tamanho** |  **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **Usuário seleciona o período desejado. Sistema compila os dados de consumo. Relatório é exibido e pode ser exportado.** |
| **Fluxos secundários**   | **Possibilidade de filtro por ingrediente ou fornecedor.** |
| **Interfaces associadas**   | **Interface de relatórios.** |
| **Entradas e pré-condições** | **Período definido para consulta.** |
| **Saídas e condições esperadas** | **Relatório detalhado e preciso gerado.** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF024 |  Fechamento diário do caixa |
| :---- | :---- |
| **Descrição** | **O sistema deve possuir uma funcionalidade para o fechamento diário do caixa.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **Usuário acessa a funcionalidade de fechamento do caixa. O sistema consolida todas as transações do dia. Apresenta resumo e confirma fechamento.** |
| **Fluxos secundários**   | **Possibilidade de estorno ou ajuste antes do fechamento.** |
| **Interfaces associadas**   | **Interface do caixa.** |
| **Entradas e pré-condições** | **Todas as transações do dia registradas.** |
| **Saídas e condições esperadas** | Caixa fechado com resumo disponível para consulta. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF025 | Relatórios financeiros de custos e balanço por período |
| :---- | :---- |
| **Descrição** | **O sistema deve gerar relatórios financeiros de custos e um balanço por período.** |
| **Tamanho** | **Grande** |
| **Prioridade** | **Média** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | Usuário seleciona o período para o relatório. Sistema compila custos e receitas. Gera e exibe o balanço financeiro.  |
| **Fluxos secundários**   | **Possibilidade de exportar o relatório.** |
| **Interfaces associadas**   | **Interface de relatórios financeiros.** |
| **Entradas e pré-condições** | **Dados financeiros registrados no sistema.** |
| **Saídas e condições esperadas** | Relatório financeiro detalhado e preciso gerado. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF026 | Cadastro e gerenciamento de funcionários e credenciais |
| :---- | :---- |
| **Descrição** | **O sistema deve permitir o cadastro de funcionários e o gerenciamento de suas credenciais de acesso.** |
| **Tamanho** | **Médio** |
| **Prioridade** |  **Alta** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **Usuário acessa o módulo de funcionários. Cadastra novo funcionário e define credenciais. Altera ou revoga credenciais quando necessário.** |
| **Fluxos secundários**   | **Validação das credenciais. Registro de logs de acesso.** |
| **Interfaces associadas**   | **Interface de gestão de usuários.** |
| **Entradas e pré-condições** | **Dados do funcionário e políticas de acesso.** |
| **Saídas e condições esperadas** | Funcionário cadastrado e credenciais configuradas corretamente. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF027 | Armazenamento de escalas de trabalho e folgas |
| :---- | :---- |
| **Descrição** | **O sistema deve permitir o armazenamento de informações de escalas de trabalho e folgas dos funcionários.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | **Usuário acessa o módulo de escalas. Insere ou altera escalas e folgas. Sistema armazena e disponibiliza essas informações para consulta** |
| **Fluxos secundários**   | **Validação de conflitos de escalas.** |
| **Interfaces associadas**   | **Interface de gestão de escalas.** |
| **Entradas e pré-condições** | **Dados corretos de escalas e folgas.** |
| **Saídas e condições esperadas** | Escalas armazenadas e disponíveis para consulta. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

 


| ID \- RF028 | Relatórios de dias trabalhados e faltas dos funcionários |
| :---- | :---- |
| **Descrição** | **O sistema deve gerar relatórios de dias trabalhados e faltas dos funcionários.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A fazer** |
|  **Fluxo de eventos principal**   | Usuário seleciona o funcionário e o período. Sistema compila dados de presença e ausências. Gera e exibe o relatório detalhado.  |
| **Fluxos secundários**   | Permitir filtro por tipo de ausência. |
| **Interfaces associadas**   | **Interface de relatórios.** |
| **Entradas e pré-condições** | **Registro correto das presenças e faltas.** |
| **Saídas e condições esperadas** | Relatório gerado corretamente com dados precisos. |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

   

   

   

   

   

5. Requisitos não funcionais

| ID | Descrição do Requisito |
| :---- | :---- |
| RNF001 | O sistema deve responder às consultas de disponibilidade de horários para reserva em menos de 2 segundos. |
| RNF002 | O sistema deve armazenar as credenciais de acesso (senhas) dos funcionários de forma criptografada. |
| RNF003 | A interface do sistema deve ser intuitiva e otimizada para uso em dispositivos do tipo tablet. |
| RNF004 | O sistema deve possuir uma API para permitir a integração com plataformas de delivery de terceiros. |

| ID \- RNF01 | Tempo de Resposta |
| :---- | :---- |
| **Descrição** | **O sistema deve responder às consultas de disponibilidade de horários para reserva em menos de 2 segundos.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

| ID \- RNF02 | Segurança de Credenciais |
| :---- | :---- |
| **Descrição** | **O sistema deve armazenar as credenciais de acesso (senhas) dos funcionários de forma criptografada.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

| ID \- RNF03 | Interface Responsiva |
| :---- | :---- |
| **Descrição** | **A interface do sistema deve ser intuitiva e otimizada para uso em dispositivos do tipo tablet.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Média** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

| ID \- RNF04 | Integração via API |
| :---- | :---- |
| **Descrição** | **O sistema deve possuir uma API para permitir a integração com plataformas de delivery de terceiros.** |
| **Tamanho** | **Grande** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

| ID \- RN01 |  Gestão de Recursos |
| :---- | :---- |
| **Descrição** | **Centralizar e otimizar a gestão de recursos (como estoque e equipes) entre as diversas unidades, visando maior eficiência operacional e redução de custos.** |
| **Tamanho** | **Grande** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

   

| ID \- RN02 | Relacionamento com o Cliente |
| :---- | :---- |
| **Descrição** | **Aprimorar a experiência do cliente com uma plataforma dinâmica e intuitiva, oferecendo ferramentas que facilitem suas decisões e fortaleçam o engajamento com a marca.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

   

| ID \- RN03 | Praticidade no Agendamento |
| :---- | :---- |
| **Descrição** | **Simplificar o processo de agendamento de reservas para o cliente, tornando-o mais rápido e prático para garantir maior satisfação e conversão.** |
| **Tamanho** | **Médio** |
| **Prioridade** | **Alta** |
| **Status** | **A Fazer** |
| **Data de criação** | 25/08/2025 |
| **Responsável pela criação** | **Vitor Nascimento Nunes da Silva** |
| **Data da última atualização** | 01/09/2025 |
| **Responsável pela última atualização** | **Vitor Nascimento Nunes da Silva** |
| **Histórico de modificações** | **25/08/2025 | v1.0 | Criação inicial do requisito.** |

   

6. Requisitos de negócio

   (RN01) **Gestão de Recursos** Centralizar e otimizar a gestão de recursos (como estoque e equipes) entre as diversas unidades, visando maior eficiência operacional e redução de custos.

   (RN02) **Relacionamento com o Cliente** Aprimorar a experiência do cliente com uma plataforma dinâmica e intuitiva, oferecendo ferramentas que facilitem suas decisões e fortaleçam o engajamento com a marca.

   

   (RN03) **Praticidade no Agendamento** Simplificar o processo de agendamento de reservas para o cliente, tornando-o mais rápido e prático para garantir maior satisfação e conversão

   

		