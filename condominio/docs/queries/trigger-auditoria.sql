-- PESSOA
create table auditoria_pessoa
(
   co_auditoria_pessoa  int not null,
   co_pessoa            int not null,
   no_pessoa            varchar(155) not null,
   dt_nascimento        date,
   ds_foto              varchar(150),
   nu_cpf               varchar(11),
   nu_rg                varchar(22),
   st_foto_publica      bool not null default 0,
   dt_hr_registro       datetime not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);

alter table auditoria_pessoa
   add primary key (co_auditoria_pessoa);
ALTER TABLE `auditoria_pessoa` CHANGE `co_auditoria_pessoa` `co_auditoria_pessoa` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaPessoa 
BEFORE UPDATE ON tb_pessoa
FOR EACH ROW BEGIN
INSERT INTO auditoria_pessoa
SET
   co_pessoa = OLD.co_pessoa,
   no_pessoa = OLD.no_pessoa,
   dt_nascimento = OLD.dt_nascimento,
   ds_foto = OLD.ds_foto,
   nu_cpf = OLD.nu_cpf,
   nu_rg = OLD.nu_rg,
   st_foto_publica = OLD.st_foto_publica,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;


-- CONTATO
create table auditoria_contato
(
   co_auditoria_contato int not null,
   co_contato           int not null,
   co_pessoa            int not null,
   co_tipo_contato      int not null,
   ds_contato           varchar(20) not null,
   st_ativo             bool not null,
   dt_hr_registro       timestamp not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);
alter table auditoria_contato
   add primary key (co_auditoria_contato);
ALTER TABLE `auditoria_contato` CHANGE `co_auditoria_contato` `co_auditoria_contato` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaContato 
BEFORE UPDATE ON tb_contato
FOR EACH ROW BEGIN
INSERT INTO auditoria_contato
SET
   co_contato = OLD.co_contato,
   co_pessoa = OLD.co_pessoa,
   co_tipo_contato = OLD.co_tipo_contato,
   ds_contato = OLD.ds_contato,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;

-- 	UNIDADE
create table auditoria_unidade
(
   co_auditoria_unidade int not null,
   co_unidade           int not null,
   nu_numero            varchar(10) not null,
   co_tipo_unidade      int not null,
   co_torre             int,
   co_proprietario      int,
   nu_metragem          decimal(8,2),
   dt_aquisicao         date not null,
   st_ativo             bool not null,
   dt_hr_registro       timestamp not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);
alter table auditoria_contato
   add primary key (co_auditoria_contato);
ALTER TABLE `auditoria_unidade` CHANGE `co_auditoria_unidade` `co_auditoria_unidade` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaUnidade 
BEFORE UPDATE ON tb_unidade
FOR EACH ROW BEGIN
INSERT INTO auditoria_unidade
SET
   co_unidade = OLD.co_unidade,
   nu_numero = OLD.nu_numero,
   co_tipo_unidade = OLD.co_tipo_unidade,
   co_torre = OLD.co_torre,
   co_proprietario = OLD.co_proprietario,
   nu_metragem = OLD.nu_metragem,
   dt_aquisicao = OLD.dt_aquisicao,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;


--MORADOR
create table auditoria_morador
(
   co_auditoria_morador int not null,
   co_pessoa            int not null,
   co_unidade           int not null,
   co_tipo_morador      int not null,
   co_profissao         int,
   dt_inicio            date not null,
   dt_fim               date,
   st_ativo             bool not null,
   dt_hr_registro       timestamp not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);

alter table auditoria_morador
   add primary key (co_auditoria_morador);
ALTER TABLE `auditoria_morador` CHANGE `co_auditoria_morador` `co_auditoria_morador` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaMorador
BEFORE UPDATE ON tb_morador
FOR EACH ROW BEGIN
INSERT INTO auditoria_morador
SET
   co_pessoa = OLD.co_pessoa,
   co_unidade = OLD.co_unidade,
   co_tipo_morador = OLD.co_tipo_morador,
   co_profissao = OLD.co_profissao,
   dt_inicio = OLD.dt_inicio,
   dt_fim = OLD.dt_fim,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;


--CORREIO
create table auditoria_correio
(
   co_auditoria_correio int not null,
   co_item_correio      int not null,
   co_unidade           int not null,
   co_tipo_item_correio int not null,
   ds_item              varchar(255) not null,
   co_funcionario_recebimento int not null,
   dt_hr_chegada        datetime not null,
   ds_observacao        text,
   dt_hr_registro       timestamp not null,
   st_avito             bool not null,
   dt_modificacao       timestamp not null
);
alter table auditoria_correio
   add primary key (co_auditoria_correio);
ALTER TABLE `auditoria_correio` CHANGE `co_auditoria_correio` `co_auditoria_correio` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaCorreio
BEFORE UPDATE ON tb_correio
FOR EACH ROW BEGIN
INSERT INTO auditoria_correio
SET
   co_item_correio = OLD.co_item_correio,
   co_unidade = OLD.co_unidade,
   co_tipo_item_correio = OLD.co_tipo_item_correio,
   ds_item = OLD.ds_item,
   co_funcionario_recebimento = OLD.co_funcionario_recebimento,
   dt_hr_chegada = OLD.dt_hr_chegada,
   ds_observacao = OLD.ds_observacao,
   dt_hr_registro = OLD.dt_hr_registro,
   st_avito = OLD.st_avito,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;


--USUARIOS
ALTER TABLE `tb_usuario` CHANGE `ds_login` `ds_login` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
create table auditoria_usuario
(
   co_auditoria_usuario int not null,
   co_pessoa            int not null,
   co_tipo_usuario      int not null,
   ds_email             varchar(50) not null,
   ds_login             varchar(20) not null,
   ds_senha             varchar(50) not null,
   st_ativo             boolean not null,
   dt_hr_registro       datetime not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);
alter table auditoria_usuario
   add primary key (co_auditoria_usuario);
ALTER TABLE `auditoria_usuario` CHANGE `co_auditoria_usuario` `co_auditoria_usuario` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaUsuario
BEFORE UPDATE ON tb_usuario
FOR EACH ROW BEGIN
INSERT INTO auditoria_usuario
SET
   co_pessoa = OLD.co_pessoa,
   co_tipo_usuario = OLD.co_tipo_usuario,
   ds_email = OLD.ds_email,
   ds_login = OLD.ds_login,
   ds_senha = OLD.ds_senha,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;

-- FUNCIONARIO
ALTER TABLE `tb_funcionario` CHANGE `st_ativo` `st_ativo` TINYINT(1) NOT NULL DEFAULT '1';
create table auditoria_funcionario
(
   co_auditoria_funcionario  int not null,
   co_pessoa            int not null,
   co_cargo_funcionario int not null,
   no_empresa_contratante varchar(255) not null,
   st_ativo             boolean not null,
   dt_hr_registro       datetime not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);

alter table auditoria_funcionario
   add primary key (co_auditoria_funcionario);
ALTER TABLE `auditoria_funcionario` CHANGE `co_auditoria_funcionario` `co_auditoria_funcionario` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaFuncionario
BEFORE UPDATE ON tb_funcionario
FOR EACH ROW BEGIN
INSERT INTO auditoria_funcionario
SET
   co_pessoa = OLD.co_pessoa,
   co_cargo_funcionario = OLD.co_cargo_funcionario,
   no_empresa_contratante = OLD.no_empresa_contratante,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;


-- ANIMAL DE ESTIMAÇÃO
create table auditoria_animal_estimacao
(
   co_auditoria_animal_estimacao int not null,
   co_animal_domestico  int not null,
   co_unidade           int not null,
   co_tipo_animal       int not null,
   co_raca              int,
   ds_cor               varchar(15) not null,
   ds_nome              varchar(20),
   ds_foto              varchar(150),
   st_ativo             boolean not null,
   dt_hr_registro       timestamp not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);

alter table auditoria_animal_estimacao
   add primary key (co_auditoria_animal_estimacao);
ALTER TABLE `auditoria_animal_estimacao` CHANGE `co_auditoria_animal_estimacao` `co_auditoria_animal_estimacao` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaAnimalEstimacao
BEFORE UPDATE ON tb_animal_domestico
FOR EACH ROW BEGIN
INSERT INTO auditoria_animal_estimacao
SET
   co_animal_domestico = OLD.co_animal_domestico,
   co_unidade = OLD.co_unidade,
   co_tipo_animal = OLD.co_tipo_animal,
   co_raca = OLD.co_raca,
   ds_cor = OLD.ds_cor,
   ds_nome = OLD.ds_nome,
   ds_foto = OLD.ds_foto,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;



-- VEICULOS
create table auditoria_veiculo
(
   co_auditoria_veiculo int not null,
   co_veiculo           int not null,
   co_unidade           int not null,
   co_tipo_veiculo      int not null,
   co_vaga              int not null,
   co_modelo_veiculo    int,
   ds_placa             varchar(7) not null,
   ds_cor               varchar(20) not null,
   st_ativo             boolean not null,
   dt_hr_registro       timestamp not null,
   co_pessoa_registro   int not null,
   dt_modificacao       timestamp not null
);
alter table auditoria_veiculo
   add primary key (co_auditoria_veiculo);
ALTER TABLE `auditoria_veiculo` CHANGE `co_auditoria_veiculo` `co_auditoria_veiculo` INT(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
CREATE TRIGGER auditoriaVeiculo
BEFORE UPDATE ON tb_veiculo
FOR EACH ROW BEGIN
INSERT INTO auditoria_veiculo
SET
   co_veiculo = OLD.co_veiculo,
   co_unidade = OLD.co_unidade,
   co_tipo_veiculo = OLD.co_tipo_veiculo,
   co_vaga = OLD.co_vaga,
   co_modelo_veiculo = OLD.co_modelo_veiculo,
   ds_placa = OLD.ds_placa,
   ds_cor = OLD.ds_cor,
   st_ativo = OLD.st_ativo,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END$$
DELIMITER ;