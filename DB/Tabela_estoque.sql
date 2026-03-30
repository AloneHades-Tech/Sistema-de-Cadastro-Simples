tb_contatos-- TABELA DE ESTOQUE: Gerencia produtos como pomadas e shampoos
CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(100) NOT NULL,
    quantidade INT DEFAULT 0,
    preco_venda DECIMAL(10,2),
    status VARCHAR(20) DEFAULT 'disponivel'
);

-- TABELA FINANCEIRO: Registra entradas (cortes) e saídas (contas)
CREATE TABLE financeiro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);