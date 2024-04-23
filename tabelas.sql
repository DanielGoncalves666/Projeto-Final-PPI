CREATE TABLE pessoa
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(100),
   sexo varchar(10),
   email varchar(50),
   telefone varchar(15),
   cep char(10),
   logradouro varchar(100),
   cidade varchar(40),
   estado varchar(20)
)ENGINE=InnoDB;

/*
   Talvez seja bom colocar email como UNIQUE
*/

CREATE TABLE funcionario
(
   dataContrato date,
   salario float,
   senhaHash varchar(255),
   codigo int PRIMARY KEY,
   FOREIGN KEY (codigo) REFERENCES pessoa(codigo)
)ENGINE=InnoDB;

CREATE TABLE medico
(
   especialidade varchar(50),
   crm varchar(15),
   codigo int PRIMARY KEY,
   FOREIGN KEY (codigo) REFERENCES funcionario(codigo)
)ENGINE=InnoDB;

CREATE TABLE paciente
(
   peso float,
   altura int,
   tiposanguineo varchar(3),
   codigo int PRIMARY KEY,
   FOREIGN KEY (codigo) REFERENCES pessoa(codigo)
)ENGINE=InnoDB;

CREATE TABLE agenda
(
   codigo int PRIMARY KEY auto_increment,
   dia date,
   horario int,
   nome varchar(100),
   sexo varchar(10),
   email varchar(50),
   codigoMedico int not null,
   FOREIGN KEY (codigoMedico) REFERENCES medico(codigo)
   
)ENGINE=InnoDB;

CREATE TABLE base_enderecos
(
   cep char(10),
   logradouro varchar(100),
   cidade varchar(40),
   estado varchar(20)
)ENGINE=InnoDB;


INSERT INTO base_enderecos VALUES ("38400-100", "Avenida Floriano Peixoto","Uberlândia","MG");
INSERT INTO base_enderecos VALUES ("38408-100", "Avenida João Naves de Ávila","Uberlândia","MG");
INSERT INTO base_enderecos VALUES ("38402-018", "Rua Ceará","Uberlândia","MG");
INSERT INTO base_enderecos VALUES ("38701-002", "Rua Padre Pavoni","Patos de Minas","MG");
INSERT INTO base_enderecos VALUES ("38747-792", "Avenida Liria Terezinha Lassi Capuano","Patrocínio","MG");


/*
A inserção na tabela funcionario com código 1 funciona se a tabela 'pessoa' acabou de ser criada ou o
auto_increment foi reiniciado:
   ALTER TABLE pessoa AUTO_INCREMENT = 1;
*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
            VALUES ("Teste Testador", "Masculino", "testador@email.com", "(34)99999-9999",
                     "38408-100", "Avenida João Naves de Ávila","Uberlândia","MG");

/*
A senha correspondente ao hash colocado abaixo é 123456
*/
INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
                  VALUES("2024-04-15",2000.50,"$2y$10$kKfH4/DHbLCKmqfjq2MDlutzdGMHSiYmnESXSkjapOt9HGUt6tFNu",1);

