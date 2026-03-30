-- ESTRUTURA DA TABELA 'usuarios'
-- Finalidade: Armazenar os perfis de clientes e operadores do sistema da barbearia.

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuarioscol` int NOT NULL AUTO_INCREMENT COMMENT 'Chave primária: Identificador único do registro.',
  `nome` varchar(45) NOT NULL COMMENT 'Nome completo do cliente ou usuário.',
  `email` varchar(110) NOT NULL COMMENT 'E-mail para login e contato (único para autenticação).',
  `telefone` varchar(15) NOT NULL COMMENT 'Telefone de contato com DDD.',
  `genero` varchar(15) NOT NULL COMMENT 'Identificação de gênero para perfil demográfico.',
  `data_nasc` date NOT NULL COMMENT 'Data de nascimento (formato YYYY-MM-DD).',
  `cidade` varchar(100) NOT NULL COMMENT 'Cidade de residência do cliente.',
  `estado` varchar(100) NOT NULL COMMENT 'Estado (UF) de residência.',
  `endereco` varchar(100) NOT NULL COMMENT 'Endereço completo (Rua, Número, Bairro).',
  PRIMARY KEY (`idusuarioscol`)
) 
ENGINE=InnoDB 
AUTO_INCREMENT=4 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_520_ci 
COMMENT='Tabela central de usuários: Base para o CRUD de gestão da barbearia.';