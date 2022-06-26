CREATE DATABASE IF NOT EXISTS sistemafarmaciav2
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;


USE sistemafarmaciav2;

CREATE TABLE usuarios(
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(80),
senha VARCHAR(50),
email VARCHAR(90),
fk_acesso_usuario INT,
controleAcesso INT,
recuperarSenha VARCHAR(230),
CONSTRAINT usuario_nivel FOREIGN KEY (fk_acesso_usuario) REFERENCES nivel(id_nivel)
) ENGINE = InnoDB;

CREATE TABLE nivel(
id_nivel INT PRIMARY KEY AUTO_INCREMENT,
nome_nivel VARCHAR(50)
)ENGINE = InnoDB;


CREATE TABLE caixa(
id_caixa INT PRIMARY KEY AUTO_INCREMENT,
abertura DECIMAL(10,2),
fechamento DECIMAL(10,2),
caixaData DATE,
caixaStatus INT,
fk_usuario_caixa INT,
CONSTRAINT usuario_caixa FOREIGN KEY (fk_usuario_caixa) REFERENCES usuarios(id_usuario)
)ENGINE = InnoDB;


CREATE TABLE fabricante(
id_fabricante INT PRIMARY KEY AUTO_INCREMENT,
nomeFabricante VARCHAR(100),
cidade VARCHAR(50),
pais VARCHAR(50),
fk_usuario_fabricante INT,
CONSTRAINT usuario_fabricante FOREIGN KEY (fk_usuario_fabricante) REFERENCES usuarios(id_usuario)
)ENGINE = InnoDB;


CREATE TABLE funcionarios(
id_funcionario INT PRIMARY KEY AUTO_INCREMENT,
nomeFuncionario VARCHAR(90),
telefone INT(20),
emailFuncionario VARCHAR(90),
endereco VARCHAR(80),
cargo VARCHAR(50),
fk_usuario_funcionario INT,
CONSTRAINT usuario_funcionario FOREIGN KEY (fk_usuario_funcionario) REFERENCES usuarios(id_usuario)
)ENGINE = InnoDB;

CREATE TABLE logger(
id_log INT PRIMARY KEY AUTO_INCREMENT,
tipo VARCHAR(20),
descricao VARCHAR(100),
criandoLogger DATE,
fk_usuario_logger INT,
CONSTRAINT usuario_logger FOREIGN KEY (fk_usuario_logger) REFERENCES usuarios(id_usuario)
)ENGINE = InnoDB;

/*
CREATE TABLE logusuario(
id_logus INT PRIMARY KEY,
fk_logger INT,
fk_usuario_logusuario INT,
CONSTRAINT logger_logusuario FOREIGN KEY (fk_logger) REFERENCES logger(id_log),
CONSTRAINT usuario_logusuario FOREIGN KEY (fk_usuario_logusuario) REFERENCES usuarios(id_usuario)
)ENGINE = InnoDB;
*/

CREATE TABLE vendas(
id_venda INT PRIMARY KEY AUTO_INCREMENT,
vendaTotal DECIMAL(10,2),
vendaDesconto DECIMAL(10,2),
vendaCliente VARCHAR(60),
vendaPagCliente DECIMAL(10,2),
vendaTroco DECIMAL(10,2),
vendaData DATE,
fk_usuario_venda INT,
fk_tipopag_venda INT,
CONSTRAINT usuario_venda FOREIGN KEY (fk_usuario_venda) REFERENCES usuarios(id_usuario),
CONSTRAINT tipopag_venda FOREIGN KEY (fk_tipopag_venda) REFERENCES tipopag(id_pag)
)ENGINE = InnoDB;

CREATE TABLE tipopag(
id_pag INT PRIMARY KEY AUTO_INCREMENT,
pagamento VARCHAR(40)
)ENGINE = InnoDB;

CREATE TABLE produtos(
id_produto INT PRIMARY KEY AUTO_INCREMENT,
barcode VARCHAR(45),
nomeProduto VARCHAR(50),
precoProduto DECIMAL(10,2),
qtdProduto INT,
qtdCompraProduto INT,
criandoProduto DATE,
dataExpProduto DATE,
fk_categoria_produto INT,
 fk_fabricante_produto INT,
CONSTRAINT categoria_produto FOREIGN KEY (fk_categoria_produto) REFERENCES categoria(id_categoria),
constraint fabricante_produto foreign key (fk_fabricante_produto) references fabricante(id_fabricante)
)ENGINE = InnoDB;

CREATE TABLE categoria(
id_categoria INT PRIMARY KEY AUTO_INCREMENT,
nomeCategoria VARCHAR(50)
) ENGINE = InnoDB;


CREATE TABLE estoque(
id_estoque INT PRIMARY KEY AUTO_INCREMENT,
estrada INT,
saida INT,
fk_produto_estoque INT,
CONSTRAINT produto_estoque FOREIGN KEY (fk_produto_estoque) REFERENCES produtos(id_produto)
) ENGINE = InnoDB;

CREATE TABLE carrinho_temp(
id_carrinho INT PRIMARY KEY AUTO_INCREMENT,
qtdVenda INT,
precoVenda DECIMAL(10,2),
subtotalVenda DECIMAL(10,2),
fk_vendas_carrinho INT,
fk_produtos_carrinho INT,
CONSTRAINT vendas_carrinho FOREIGN KEY (fk_vendas_carrinho) REFERENCES vendas(id_venda),
CONSTRAINT produtos_carrinho FOREIGN KEY (fk_produtos_carrinho) REFERENCES produtos(id_produto)
)ENGINE = InnoDB;

CREATE TABLE itens_venda(
id_itens INT PRIMARY KEY AUTO_INCREMENT,
qtdVendaItens INT,
precoVendaItens DECIMAL(10,2),
subtotalVendaItens DECIMAL(10,2),
fk_vendas_itens INT,
fk_produtos_itens INT,
CONSTRAINT vendas_itens FOREIGN KEY (fk_vendas_itens) REFERENCES vendas(id_venda),
CONSTRAINT produtos_itens FOREIGN KEY (fk_produtos_itens) REFERENCES produtos(id_produto)
)ENGINE = InnoDB;


/* INSERINDO ...*/

INSERT INTO usuarios (nome,senha,email,fk_acesso_usuario,controleAcesso,recuperarSenha) VALUES 
('Sakala Simão','1234','sakalasimao@gmail.com',3,0,''),
('Maria Lopes','1234','sakalasimao@gmail.com',2,1,''),
('Lemba Pires','1234','sakalasimao@gmail.com',1,1,'');


INSERT INTO nivel (id_nivel,nome_nivel) VALUES 
(1,'Administrador'),
(2,'Gerente'),
(3,'Farmaceutico');

INSERT INTO funcionarios (nomeFuncionario, telefone, emailFuncionario, endereco, cargo) VALUES
('Sakala Simão', 923984989, 'sakalasimao@gmail.com','Sequele,rua 01','Farmaceutico');


select barcode, nomeProduto, precoVenda, qtdVenda, subtotalVenda from 
carrinho_temp inner join produtos on carrinho_temp.fk_produtos_carrinho = produtos.id_produto;


SELECT * FROM produtos ;

INSERT INTO carrinho_temp (qtdVenda, precoVenda, subtotalVenda,fk_produtos_carrinho) VALUES 
(1,500,500,2);

select * from carrinho_temp;


INSERT INTO categoria (id_categoria, nomeCategoria) VALUES
(1, 'Comprimidos'),
(2, 'Cápsulas'),
(3, 'Drágeas'),
(4, 'Granulados'),
(5, 'Pomadas'),
(6, 'Cremes'),
(7, 'Pastas'),
(8, 'Soluções'),
(9, 'Gotas'),
(10, 'Xaropes'),
(11, 'Suspensões'),
(12, 'Elixires');


INSERT INTO tipopag (pagamento) VALUES 
('Dinheiro'),
('Bancario');

/*  SELETE DE VENDAS */
SELECT nome, vendaTotal, vendaDesconto, vendaCliente, vendaTroco, vendaPagCliente  FROM vendas v JOIN usuarios s 
ON v.fk_usuario_venda = s.id_usuario
JOIN tipopag t 
ON s.id_usuario = t.id_pag where nome LIKE '%%';

SELECT IFNULL(SUM(vendaTotal), 0) as vtotal From vendas WHERE vendaData = '2022-06-10';

UPDATE caixa SET fechamento = 500 WHERE fk_usuario_caixa = 1 and caixaData = '2022-06-09';

select * from caixa;



/*  SELETE DE PRODUTOS */

select nomeProduto, nomeCategoria, precoProduto, qtdProduto, dataExpProduto from produtos JOIN categoria 
ON produtos.fk_categoria_produto = categoria.id_categoria where  precoProduto LIKE '%5%';

select id_venda, vendaTotal, vendaDesconto, vendaCliente, vendaPagCliente, vendaTroco, vendaData from vendas order by id_venda desc;


/*SELECT DE ITENS VENDAS*/

select  barcode, nomeProduto ,qtdVendaItens , subtotalVendaItens  from itens_venda it join produtos p
on it.fk_produtos_itens = p.id_produto  where fk_vendas_itens = 13;


SELECT barcode, nomeProduto ,precoProduto, qtdProduto, qtdCompraProduto, criandoProduto, dataExpProduto FROM estoque e Join produtos p
on e.fk_produto_estoque = p.id_produto;

SELECT nomeProduto FROM produtos WHERE nomeProduto LIKE '%ami%';

-- SELECT DO LOG

SELECT nome, tipo, descricao, criandoLogger FROM logger l JOIN usuarios s
ON l.fk_usuario_logger = s.id_usuario;


SELECT nome as Operador, vendaTotal, vendaDesconto, vendaCliente, fk_tipopag_venda as tipoPag, vendaTroco, vendaData FROM vendas v JOIN usuarios s 
                          ON v.fk_usuario_venda = s.id_usuario;

/*
ALTER TABLE users ADD grade_id SMALLINT UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE users ADD CONSTRAINT fk_grade_id FOREIGN KEY (grade_id) REFERENCES grades(id)
*/

alter table produtos add fk_fabricante_produto int;
alter table produtos add constraint fabricante_produto foreign key (fk_fabricante_produto) references fabricante(id_fabricante);

INSERT INTO fabricante (nomeFabricante, cidade, pais) values
('EMS CORP','','Brazil');

/*PRODUTOS MAIS VENDIDOS */

SELECT nomeProduto, sum(fk_vendas_itens) FROM itens_venda i JOIN produtos p 
ON i.fk_produtos_itens = p.id_produto group by nomeProduto order by sum(fk_vendas_itens) desc
                          
