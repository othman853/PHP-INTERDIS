-- DROP DATABASE JOHAN_YASSER_INTERDIS;
start transaction;

CREATE DATABASE JOHAN_YASSER_INTERDIS CHARSET='latin1' COLLATE='latin1_swedish_ci';

USE JOHAN_YASSER_INTERDIS;

CREATE TABLE USUARIO(
cod_usuario bigint not null auto_increment,
usuario varchar(50),
senha varchar(100),
nivel smallint,

constraint PK_USUARIO primary key (cod_usuario)
)CHARSET='utf8';

CREATE TABLE ADMINISTRADOR(
cod_admin bigint not null auto_increment,
nome varchar(200),
cod_usuario bigint,

constraint PK_ADMIN primary key(cod_admin),
constraint FK_ADMIN_USUARIO foreign key(cod_usuario) references USUARIO(cod_usuario) 
)CHARSET='utf8';

CREATE TABLE PACIENTE(
cod_paciente bigint not null auto_increment,
nome varchar(150) not null,
endereco varchar(250),
telefone varchar(10),
email varchar(50),
dt_nascimento date,
cod_usuario bigint,

constraint PK_PACIENTE primary key(cod_paciente),
constraint FK_PACIENTE_USUARIO foreign key (cod_usuario) references USUARIO(cod_usuario)
)CHARSET='utf8';

CREATE TABLE ATENDENTE(
	cod_atendente bigint not null auto_increment,
	nome varchar(90),
	cod_usuario bigint,

	constraint PK_ATENDENTE primary key (cod_atendente),
	constraint FK_ATENDENTE_USUARIO foreign key (cod_usuario) references USUARIO(cod_usuario)
)CHARSET='utf8';


CREATE TABLE ESPECIALIDADE_MEDICA(
cod_espec bigint not null auto_increment,
descricao varchar(50),

constraint PK_ESPEC_MEDICA primary key(cod_espec)
)CHARSET='utf8';

CREATE TABLE MEDICO(
crm bigint not null auto_increment,
nome varchar(80),
telefone varchar(10),
celular varchar(10),
email varchar(60),
cod_usuario bigint,

constraint PK_MEDICO primary key (crm),
constraint FK_MEDICO_USUARIO foreign key (cod_usuario) references USUARIO(cod_usuario)
)CHARSET='utf8';

CREATE TABLE AGENDA(
crm bigint not null,
dia date,
hora time,
estado tinyint,

constraint PK_AGENDA primary key (crm, dia, hora),
constraint FK_CRM_AGENDA foreign key (crm) references MEDICO (crm)
)CHARSET='utf8';

CREATE TABLE ESPEC_MEDICO(
cod_espec bigint not null,
crm bigint not null,

constraint FK_CRM_ESPEC_MEDICO foreign key(crm) references MEDICO (crm),
constraint FK_ESPEC_ESPEC_MEDICO foreign key (cod_espec) references ESPECIALIDADE_MEDICA (cod_espec)
)CHARSET='utf8';

CREATE TABLE CONSULTA(
cod_consulta bigint not null auto_increment,
crm_medico bigint not null,
cod_paciente bigint not null,
data_consulta date not null,
hora_consulta time not null,
situacao tinyint,

constraint PK_CONSULTA primary key(cod_consulta),
constraint FK_CRM_CONSULTA foreign key (crm_medico) references MEDICO (crm),
constraint FK_COD_PACIENTE_CONSULTA foreign key (cod_paciente) references PACIENTE(cod_paciente)
)CHARSET='utf8';

CREATE VIEW VW_ESPECIALIDADE_CRM(crm, especialidade) AS
	SELECT m.crm, e.descricao
	FROM MEDICO as m
	INNER JOIN ESPEC_MEDICO as em on  em.crm = m.crm
	INNER JOIN ESPECIALIDADE_MEDICA e on e.cod_espec = em.cod_espec;

CREATE VIEW VW_CONSULTA(cod_consulta, crm, cod_paciente, nome_medico, nome_paciente, data_consulta, hora_consulta, situacao) AS
	SELECT C.cod_consulta, M.crm, P.cod_paciente, M.nome, P.nome, C.data_consulta, C.hora_consulta, case C.situacao 
																			 when 0 then "PENDENTE"
																			 when 1 then "CONFIRMADA"
																			 when 2 then "CANCELADA"
																			 END AS 'situacao'
	FROM CONSULTA C
	INNER JOIN PACIENTE P ON P.cod_paciente = C.cod_paciente
	INNER JOIN MEDICO M ON M.crm = C.crm_medico;



    
CREATE VIEW VW_AGENDA_MEDICO(crm, nome_medico, dia, hora, estado, descricao_estado) AS
	SELECT A.crm, M.nome, A.dia, A.hora, A.estado, CASE A.estado
												   WHEN 0 THEN "DISPONIVEL"
                                                   WHEN 1 THEN "PENDENTE"
                                                   WHEN 2 THEN "INDISPONIVEL"
												   WHEN 3 THEN "CANCELADA"
                                                   END AS "descricao_estado"
	FROM AGENDA A
	INNER JOIN MEDICO M ON M.crm = A.CRM;

-- DELIMITER $$
-- CREATE TRIGGER TG_ATUALIZA_CONSULTA
-- BEFORE UPDATE ON CONSULTA
-- FOR EACH ROW 
-- BEGIN
-- 		IF NEW.situacao = 0 then
-- 			update AGENDA SET ESTADO = 1 WHERE dia = OLD.data_consulta  and hora= OLD.hora_consulta and crm = OLD.crm_medico;		
-- 		ELSEIF NEW.situacao = 1 then 
-- 			update AGENDA SET ESTADO = 2 WHERE dia = OLD.data_consulta  and hora= OLD.hora_consulta and crm = OLD.crm_medico;
-- 		ELSEIF NEW.situacao = 2 then 
-- 			update AGENDA SET ESTADO = 0 WHERE dia = OLD.data_consulta  and hora= OLD.hora_consulta and crm = OLD.crm_medico;
-- 		END IF;
-- END;$$
-- DELIMITER ;
    
INSERT INTO USUARIO (usuario, senha, nivel) VALUES ('admin', md5('admin'), 0);
INSERT INTO USUARIO (usuario, senha, nivel) VALUES ('paciente', md5('paciente'), 1);
INSERT INTO USUARIO (usuario, senha, nivel) VALUES ('atendente', md5('atendente'), 2);
INSERT INTO USUARIO (usuario, senha, nivel) VALUES ('medico', md5('medico'), 3);

INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Pediatra');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Neurologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Cardiologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Obstetra');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Ginecologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Pneumologista');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Geral');
INSERT INTO ESPECIALIDADE_MEDICA (descricao) VALUES('Traumatologista');

INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (2520, 'Carlos Machado Silva', '5139486791', '5195345769', 'carlos.machado@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (1781, 'Mariana Cardoso Souto', '5134386521', '5195323775', 'mariana.souto@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (2241, 'Marcia Silva Peixoto', '5133487632', '5196434889', 'marcia.peixoto.@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (0111, 'Abílio Santos', '5134598251', '5196434889', 'abilio.santos@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (3592, 'Abelardo Moura Santos', '5133918251', '5196788950', 'abel.santos@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (9447, 'Leonel Padilha Morimoto', '5132348678', '5194438576', 'leonel.morimoto@gmail.com', 4);
INSERT INTO MEDICO(crm, nome, telefone, celular, email, cod_usuario) VALUES (3698, 'Antonia Martins Brasil', '5133597689', '5192364578', 'antonia.brasil@gmail.com', 4);

INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(1781,1); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2241,3);
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(0111,7); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(3592,2); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2520,5); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(2520,4); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(3698,6); 
INSERT INTO ESPEC_MEDICO(crm, cod_espec) VALUES(9447,8); 

-- INSERT INTO AGENDA(crm, dia, hora, estado)
-- VALUES 	(1781, '2014-10-10', '10:00:00', 1),
-- 		(2241, '2015-02-12', '16:00:00', 1),
-- 		(111,  '2014-08-24', '12:00:00', 0),
-- 		(3592, '2015-01-10', '13:00:00', 2),
-- 		(2520, '2015-03-12', '14:00:00', 0),
-- 		(111, '2014-09-30', '17:00:00', 2);

INSERT INTO PACIENTE (nome, endereco, telefone, email, dt_nascimento, cod_usuario ) 
VALUES ('Mohammed Mamebud', 'Av. Assis Brasil, 1568', '5130479896', 'mohammed.mamebud@gmail.com', '1990-09-05', 2),
	   ('Najla Rachid', 'Av. Plínio Brasil Milano, 400', '5134589657', 'najla.rachid@gmail.com', '1993-10-04', 2),
	   ('Maria Cardoso', 'Av. Bento Gonçalves, 410', '5134649241', 'maria.cardoso@gmail.com', '1980-10-04', 2);

INSERT INTO ATENDENTE (nome, cod_usuario) VALUES ('Carla Moreira', 3);

-- INSERT INTO CONSULTA (crm_medico, cod_paciente, data_consulta, hora_consulta, situacao)
-- VALUES 	(2241, 1, '2014-09-30', '13:00:00', 2),
-- 		(3698, 2, '2014-09-30', '17:00:00', 0),
-- 		(111,  3, '2015-02-10', '16:00:00', 1),
-- 		(1781, 1, '2014-05-30', '13:00:00', 1),
-- 	    (1781, 1, '2014-05-30', '13:00:00', 1),
-- 		(3592, 2, '2015-01-20', '15:00:00', 2);

-- registros para teste de alteracoes

insert into AGENDA (crm, dia, hora, estado)
values (111, '2014-12-17', '17:00:00', 1);

insert into CONSULTA (crm_medico, cod_paciente, data_consulta, hora_consulta, situacao)
values (111, 1, '2014-12-17', '17:00:00', 0);

commit;

 select cod_consulta, situacao as 'SITUACAO CONSULTA', estado as 'ESTADO AGENDA'
 from AGENDA 
 INNER JOIN CONSULTA on data_consulta = dia and
   						hora_consulta = hora and
   						crm_medico = crm
