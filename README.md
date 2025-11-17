# 🍔 Project Food

## 📝 Resumo do Projeto

O **Project Food** é um sistema de gestão completo para pequenos negócios de alimentação (como lanchonetes ou restaurantes). Construído em PHP puro e MySQL, o projeto é totalmente containerizado com Docker, facilitando a instalação e a portabilidade.

Ele oferece um painel administrativo interno onde funcionários podem gerenciar clientes, fornecedores, estoque de produtos e o cardápio (com upload de imagens). A funcionalidade principal é um sistema de Ponto de Venda (PDV) interno que permite aos funcionários registrarem novos pedidos, vinculando pratos do cardápio a clientes cadastrados.

---

## 🚀 Funcionalidades Principais

* **Autenticação:** Sistema de login e cadastro seguro para funcionários.
* **Gestão de Funcionários:** CRUD (Criar, Ler, Atualizar, Apagar) de usuários do sistema.
* **Gestão de Clientes:** CRUD de clientes (para registo de pedidos).
* **Gestão de Fornecedores:** CRUD de fornecedores.
* **Controle de Estoque:** CRUD de produtos/ingredientes, com funcionalidade de "Dar Entrada" e "Dar Baixa" nas quantidades.
* **Gestão de Cardápio:** CRUD de pratos (separado do estoque), com upload de imagens.
* **Cardápio Público:** Uma página de visualização pública (`/cardapio_publico.php`) que exibe os pratos e fotos para o cliente final.
* **Registo de Pedidos (PDV):** Um formulário dinâmico (com JavaScript) para o funcionário criar novos pedidos, adicionar múltiplos pratos e salvar no banco de dados.

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 8.1
* **Banco de Dados:** MySQL 8.0
* **Servidor Web:** Apache
* **Ambiente de Desenvolvimento:** Docker (com Docker Compose)
* **Administração do Banco:** phpMyAdmin

---

## 💻 Como Executar o Projeto

Siga estes passos para rodar o projeto em um novo computador (ex: para apresentação).

### Pré-requisitos

* **Docker Desktop** instalado e em execução.

### Passos

1.  **Copiar o Projeto:**
    Copie esta pasta de projeto inteira para o seu computador.

2.  **Iniciar os Containers:**
    Abra um terminal (PowerShell, CMD ou Terminal) na raiz desta pasta (onde está o `docker-compose.yml`) e execute o comando:
    ```bash
    docker-compose up -d --build
    ```
    Isso irá construir a imagem PHP (com os drivers) e iniciar todos os serviços.

3.  **Acessar os Serviços:**
    * **Site (Painel Admin):** `http://localhost:8080`
    * **Cardápio Público:** `http://localhost:8080/cardapio_publico.php`
    * **phpMyAdmin (Banco de Dados):** `http://localhost:8081`

4.  **IMPORTANTE: Importar o Banco de Dados:**
    O passo acima cria um banco de dados **vazio**. Você precisa importar seus dados (pratos, clientes, etc.).
    * Acesse o phpMyAdmin em `http://localhost:8081`.
    * Login: `root` / `senha_super_secreta_root` (definida no `docker-compose.yml`).
    * Na barra lateral esquerda, clique no banco **`meu_projeto_db`**.
    * Vá na aba **"Importar"**.
    * Clique em "Escolher arquivo" e selecione o seu arquivo de backup (ex: `meu_projeto_db.sql`) que você exportou e salvou na pasta `sql/`.
    * Clique em **"Importar"** (ou "Go").

5.  **Pronto!**
    Após a importação, atualize a página do site (`http://localhost:8080/login.php`). Você já pode logar com seu usuário (ex: `admin@admin.com`) e todos os seus dados, pratos e imagens estarão lá.

---

## 👥 Integrantes do Grupo

| Nome Completo | RGM |
| :---- | :---: |
| Matheus de Farias | 802.539 |
| Enzo Rafael Squisiato | 802.212 |
| Vitor Nascimento | 802.585 |
| Enio Lopes Pinheiro | 802.480 |
