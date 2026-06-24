create database loja;
use loja;
create TABLE Produto (
    id INT PRIMARY KEY,
    nome VARCHAR(100),
    preco DECIMAL(10,2),
    estoque INT
);

INSERT INTO Produto VALUES (1, 'Mouse', 59.90, 20);
INSERT INTO Produto VALUES (2, 'Teclado', 120.00, 15);
INSERT INTO Produto VALUES (3, 'Monitor', 899.90, 8);

ALTER TABLE jogo
AUTO_INCREMENT = 0 ;

select * from produto where preco < 200;

select * from produto order by nome;

update produto set estoque = 25 where id = 1;