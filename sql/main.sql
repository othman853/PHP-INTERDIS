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
crm bigint not null,
nome varchar(80),
telefone varchar(10),
celular varchar(10),
cod_espec bigint not null,

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

INSERT INTO USUARIO (usuario, senha) VALUES ('usuario', md5('senha'));

INSERT INTO PACIENTE (nome, endereco, telefone, email, dt_nascimento ) 
VALUES ('Mohammed Mamebud', 'Av. Assis Brasil, 1568', '5130479896', 'mohammed.mamebud@gmail.com', '1990-09-05');

INSERT INTO PACIENTE (nome, endereco, telefone, email, dt_nascimento ) 
VALUES ('Najla Rachid', 'Av. Plínio Brasil Milano, 400', '5134589657', 'najla.rachid@gmail.com', '1993-10-04');