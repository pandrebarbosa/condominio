DELIMITER $$
CREATE TRIGGER `auditoriaMoradorNotificacao` BEFORE UPDATE ON `tb_morador_notificacao` FOR EACH ROW BEGIN
INSERT INTO auditoria_morador_notificacao
SET
   co_pessoa = OLD.co_pessoa,
   co_unidade = OLD.co_unidade,
   st_autorizado = OLD.st_autorizado,
   dt_hr_registro = OLD.dt_hr_registro,
   co_pessoa_registro = OLD.co_pessoa_registro,
   dt_modificacao = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;


DROP TRIGGER IF EXISTS `auditoriaMoradorNotificacao`