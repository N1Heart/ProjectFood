/* ------------------------------------------------------------------------- */
/* Arquivo: sql/schema.sql                                                   */
/* Descrição: Contém todos os comandos CREATE TABLE para o projeto.          */
/* ------------------------------------------------------------------------- */


/* --- TABELA 1: funcionarios --- */
/* Armazena os usuários que podem logar no sistema (ex: admin, estoquista) */

CREATE TABLE IF NOT EXISTS `funcionarios` (
    
    /* ID único para cada funcionário */
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    
    /* Nome completo do funcionário */
    `nome` VARCHAR(100) NOT NULL,
    
    /* Email usado para login. Deve ser único (ninguém pode ter o email igual) */
    `email` VARCHAR(100) NOT NULL UNIQUE,
    
    /* Senha. NUNCA guarde a senha pura. Guarde o HASH dela. 
       VARCHAR(255) é o padrão para o resultado do password_hash() do PHP. */
    `senha` VARCHAR(255) NOT NULL,
    
    /* Ex: 'Admin', 'Estoquista', 'Vendedor'. Ajuda a definir permissões. */
    `cargo` VARCHAR(50) DEFAULT 'Indefinido',
    
    /* Data e hora que o registro foi criado. Útil para auditoria. */
    `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* --- TABELA 2: clientes --- */
/* Armazena as informações dos clientes finais (que compram). */
/* A entrega era 03/nov. */

CREATE TABLE IF NOT EXISTS `clientes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE,
    `telefone` VARCHAR(20),
    `endereco` VARCHAR(255),
    `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* --- TABELA 3: fornecedores --- */
/* Armazena as informações dos fornecedores (de quem você compra). */
/* A entrega era 10/nov. */

CREATE TABLE IF NOT EXISTS `fornecedores` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome_empresa` VARCHAR(150) NOT NULL,
    `cnpj` VARCHAR(20) UNIQUE,
    `contato_nome` VARCHAR(100),
    `telefone` VARCHAR(20),
    `email` VARCHAR(100),
    `endereco` VARCHAR(255),
    `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* --- TABELA 4: produtos --- */
/* Tabela principal para o módulo de estoque. */
/* A entrega é 17/nov. */

CREATE TABLE IF NOT EXISTS `produtos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    
    /* Chave estrangeira: linka com a tabela 'fornecedores'. 
       Assim sabemos quem nos forneceu o produto. */
    `fornecedor_id` INT,
    
    `nome` VARCHAR(150) NOT NULL,
    `descricao` TEXT,
    
    /* Preço que você paga pelo produto (preço de custo). */
    `preco_custo` DECIMAL(10, 2) DEFAULT 0.00,
    
    /* Preço que você vende o produto. */
    `preco_venda` DECIMAL(10, 2) DEFAULT 0.00,

    `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    /* Define a relação entre produtos.fornecedor_id e fornecedores.id */
    FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores`(`id`)
        ON DELETE SET NULL /* Se o fornecedor for deletado, o campo fica nulo */
        ON UPDATE CASCADE  /* Se o ID do fornecedor mudar, atualiza aqui */

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* --- TABELA 5: estoque --- */
/* Controla a quantidade de cada produto. */
/* Parte da entrega de 17/nov. */

CREATE TABLE IF NOT EXISTS `estoque` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    
    /* Chave estrangeira: linka com a tabela 'produtos'. */
    `produto_id` INT NOT NULL UNIQUE, /* UNIQUE: Só pode haver UMA linha de estoque por produto */
    
    `quantidade` INT DEFAULT 0,
    
    /* Data da última vez que a quantidade foi atualizada. */
    `data_atualizacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`id`)
        ON DELETE CASCADE  /* Se o produto for deletado, o registro de estoque dele some. */
        ON UPDATE CASCADE
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;