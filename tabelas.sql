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
Para reiniciar o AUTO_INCREMENT
   ALTER TABLE pessoa AUTO_INCREMENT = 1;
*/
/*
A senha correspondente ao hash colocado abaixo é 123456
*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Teste Testador", "Masculino", "testador@email.com", "(34)99999-9999", "38408-100", "Avenida João Naves de Ávila","Uberlândia","MG");

INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
VALUES("2024-04-15",2000.50,"$2y$10$kKfH4/DHbLCKmqfjq2MDlutzdGMHSiYmnESXSkjapOt9HGUt6tFNu",LAST_INSERT_ID());

INSERT INTO medico (especialidade, crm, codigo)
VALUES ("Oftalmologista", "CRM/SP 123355", LAST_INSERT_ID());

/*Médico 2 - Senha 234567*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("João Paulo", "Masculino", "joao@email.com", "(34)86464-1233", "38402-018", "Rua Ceará","Uberlândia","MG");

INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
VALUES("2013-02-16",10350.50,"$2y$10$py6389HgTyflBk1w.vAVM.DwM.e.nFI7O2XMjW47RLzvowjwnr6fC",LAST_INSERT_ID());

INSERT INTO medico (especialidade, crm, codigo)
VALUES ("Cardiologista", "CRM/MG 123456", LAST_INSERT_ID());

/*Médico 3 - Senha 987654 */
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Daniela Fernandes", "Feminino", "daniela@email.com", "(34)12345-9876", "38747-792", "Avenida Liria Terezinha Lassi Capuano","Patrocínio","MG");

INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
VALUES("2002-03-29",22456.99,"$2y$10$LVbFSWOev6VX0sfdImE7o.MbdAwgl11a4jpxcxerOb8LxIQHg7d.W",LAST_INSERT_ID());

INSERT INTO medico (especialidade, crm, codigo)
VALUES ("Oftalmologista", "CRM/PE 987564", LAST_INSERT_ID());

/*Funcionário 1 - Senha 456231*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Fernando Álvaro Neto", "Masculino", "fernando@email.com", "(34)99999-9999", "38408-100", "Avenida João Naves de Ávila","Uberlândia","MG");

INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
VALUES("2020-01-12",5200.50,"$2y$10$a/UfAvqB5E2IXeSD/BLvoexKBTJouafiPzJccZkj142S/UyDdHnPm",LAST_INSERT_ID());

/*Funcionário 1 - Senha ufpfnem*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Maria José Neto", "Feminino", "maria@email.com", "(34)99999-9999", "38701-002", "Rua Padre Pavoni","Patos de Minas","MG");

INSERT INTO funcionario (dataContrato,salario,senhaHash,codigo)
VALUES("2018-12-29",9900.50,"$2y$10$/yEWgPwCI.rebhB4zkqsaei6WyEHKN9GWNXsVd3vQBVjU7Z5E4KHy",LAST_INSERT_ID());

/*Paciente 1*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Pedro Cabral", "Masculino", "pedro@email.com", "(34)63482-9999", "38408-100", "Avenida João Naves de Ávila","Uberlândia","MG");

INSERT INTO paciente (peso, altura, tiposanguineo, codigo)
VALUES (75.5, 175, "A+", LAST_INSERT_ID());

/*Paciente 2*/
INSERT INTO pessoa (nome,sexo,email,telefone,cep,logradouro,cidade,estado) 
VALUES ("Selene Dorneles", "Feminino", "selene@email.com", "(34)63482-1234", "38402-018", "Rua Ceará","Uberlândia","MG");

INSERT INTO paciente (peso, altura, tiposanguineo, codigo)
VALUES (61.2, 160, "AB-", LAST_INSERT_ID());