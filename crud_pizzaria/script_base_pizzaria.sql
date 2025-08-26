CREATE TABLE pedidos ( 
  id int AUTO_INCREMENT NOT NULL, 
  sabor1 varchar(30) NOT NULL,
  sabor2 varchar(30),
  sabor3 varchar(30),
  tamanho varchar(1) NOT NULL, /*M, G, F, X*/
  endereco varchar(50) NOT NULL,
  telefoneCliente varchar(50) NOT NULL,
  metodoPagamento varchar(1) NOT NULL,/*D, C, M*/ 
  
  id_atendente int NOT NULL,
  id_entregador int NOT NULL,
  id_sabor int,
  CONSTRAINT pk_pedidos PRIMARY KEY (id) 
);


CREATE TABLE atendente (
  id int AUTO_INCREMENT NOT NULL,
  nome varchar(50) NOT NULL,
  endereco varchar(50) NOT NULL,
  telefone varchar(50) NOT NULL,
  salarioBase int NOT NULL,
  comissao int,
  
  CONSTRAINT pk_atendente PRIMARY KEY (id) 
);

insert into atendente(nome, endereco, telefone, salarioBase, comissao) values ("Japa dzz7 100% focado", "Correndo no gramadão", "4591096457", "1518", "0");
insert into atendente(nome, endereco, telefone, salarioBase, comissao) values ("Gustavo Vieira Goularte", "Condominio Três lagoas", "4591176904", "1518", "0");
insert into atendente(nome, endereco, telefone, salarioBase, comissao) values ("Gabriel Soldado Guilhen", "Favela da batalha", "4598500488", "1518", "0");

CREATE TABLE entregador (
    
  id int AUTO_INCREMENT NOT NULL,
  nome varchar(50) NOT NULL,
  endereco varchar(50) NOT NULL,
  telefone varchar(50) NOT NULL,
  salarioBase int NOT NULL,
  comissao int,
  placaMoto varchar(7) NOT NULL,
  modeloMoto varchar(30) NOT NULL,
  
  CONSTRAINT pk_entregador PRIMARY KEY (id) 
);

insert into entregador(nome, endereco, telefone, salarioBase, comissao, placaMoto, modeloMoto) values ("Enzo Michel Barbosa Suco", "Rua Franca 670", "4591096457", "1518", "0", "BRA0S17", "Honda cg 125 fan");
insert into entregador(nome, endereco, telefone, salarioBase, comissao, placaMoto, modeloMoto) values ("Dj Kauã", "Fazendo tatuagem", "45999672452", "1518", "0", "GQK4D47", "Fazer 250");
insert into entregador(nome, endereco, telefone, salarioBase, comissao, placaMoto, modeloMoto) values ("Senhor Paulo", "Retifoz", "45938469068", "1518", "0", "JWK5R09", "Yamaha Mt-09");

CREATE TABLE sabores (

  id int AUTO_INCREMENT NOT NULL, 
  nome varchar(70) NOT NULL,
  CONSTRAINT pk_sabores PRIMARY KEY (id) 
    
);

insert into sabores (nome) values ("Manga");
insert into sabores (nome) values ("Frango com catupiry");
insert into sabores (nome) values ("Bacon com milho");
insert into sabores (nome) values ("Mostarda");
insert into sabores (nome) values ("Calabresa com cebola");
insert into sabores (nome) values ("4 queijos");
insert into sabores (nome) values ("Morango do amor");
insert into sabores (nome) values ("Chocolate");
insert into sabores (nome) values ("Chocolate Branco");

ALTER TABLE pedidos ADD CONSTRAINT    FOREIGN KEY (id_atendente) REFERENCES atendente (id);
ALTER TABLE pedidos ADD CONSTRAINT    FOREIGN KEY (id_entregador) REFERENCES entregador (id);
ALTER TABLE pedidos ADD CONSTRAINT    FOREIGN KEY (id_sabor) REFERENCES sabores (id);