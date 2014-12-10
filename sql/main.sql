CREATE DATABASE JOHAN_YASSER_INTERDIS;

USE JOHAN_YASSER_INTERDIS;

CREATE TABLE USUARIO(
cod_usuario bigint not null auto_increment,
usuario varchar(50),
senha varchar(100),

constraint PK_USUARIO primary key (cod_usuario)
);

CREATE TABLE PACIENTE(
cod_paciente bigint not null auto_increment,
nome varchar(150) not null,
endereco varchar(250),
telefone varchar(10),
email varchar(50),
dt_nascimento date,

constraint PK_PACIENTE primary key(cod_paciente)
);

CREATE TABLE ESPECIALIDADE_MEDICA(
cod_espec bigint not null auto_increment,
descricao varchar(50),

constraint PK_ESPEC_MEDICA primary key(cod_espec)
);

CREATE TABLE MEDICO(
crm bigint not null auto_increment,
nome varchar(80),
telefone varchar(10),
celular varchar(10),
email varchar(60),

constraint PK_MEDICO primary key (crm)
);

CREATE TABLE AGENDA(
crm bigint not null,
data_disponivel date,
periodo_disponivel tinyint,

constraint FK_CRM_AGENDA foreign key (crm) references MEDICO (crm)
);

CREATE TABLE ESPEC_MEDICO(
cod_espec bigint not null,
crm bigint not null,

constraint FK_CRM_ESPEC_MEDICO foreign key(crm) references MEDICO (crm),
constraint FK_ESPEC_ESPEC_MEDICO foreign key (cod_espec) references ESPECIALIDADE_MEDICA (cod_espec)
);

CREATE TABLE CONSULTA(
crm_medico bigint not null,
cod_paciente bigint not null,
data_consulta date not null,
hora_consulta time not null,

constraint FK_CRM_CONSULTA foreign key (crm_medico) references MEDICO (crm),
constraint FK_COD_PACIENTE_CONSULTA foreign key (cod_paciente) references PACIENTE(cod_paciente)
);

CREATE VIEW VW_ESPECIALIDADE_CRM(crm, especialidade) AS
	SELECT m.crm, e.descricao
	FROM MEDICO as m
	INNER JOIN ESPEC_MEDICO as em on  em.crm = m.crm
	INNER JOIN ESPECIALIDADE_MEDICA e on e.cod_espec = em.cod_espec;

INSERT INTO USUARIO (usuario, senha) VALUES ('usuario', md5('senha'));

INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Pediatra');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Neurologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Cardiologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Obstetra');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Ginecologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Pneumologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Geral');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Traumatologista');

INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (2520, 'Carlos Machado Silva', '5139486791', '5195345769', 'carlos.machado@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (1781, 'Mariana Cardoso Souto', '5134386521', '5195323775', 'mariana.souto@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (2241, 'Marcia Silva Peixoto', '5133487632', '5196434889', 'marcia.peixoto.@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (0111, 'Abílio Santos', '5134598251', '5196434889', 'abilio.santos@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (3592, 'Abelardo Moura Santos', '5133918251', '5196788950', 'abel.santos@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (9447, 'Leonel Padilha Morimoto', '5132348678', '5194438576', 'leonel.morimoto@gmail.com');
INSERT INTO MEDICO(crm, nome, telefone, celular, email) VALUES (3698, 'Antonia Martins Brasil', '5133597689', '5192364578', 'antonia.brasil@gmail.com');

INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(1781,1); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2241,3);
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(0111,7); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(3592,2); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2520,5); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2520,4); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(3698,6); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(9447,8); 

INSERT INTO PACIENTE (nome, endereco, telefone, email, dt_nascimento ) 
VALUES ('Mohammed Mamebud', 'Av. Assis Brasil, 1568', '5130479896', 'mohammed.mamebud@gmail.com', '1990-09-05');

INSERT INTO PACIENTE (nome, endereco, telefone, email, dt_nascimento ) 
VALUES ('Najla Rachid', 'Av. Plínio Brasil Milano, 400', '5134589657', 'najla.rachid@gmail.com', '1993-10-04');