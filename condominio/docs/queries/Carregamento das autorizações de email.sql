INSERT INTO tb_morador_notificacao (co_pessoa,co_unidade,st_autorizado,co_pessoa_registro,dt_hr_registro)
SELECT re.co_pessoa, mo.co_unidade, re.st_deseja_receber, re.co_pessoa_registro, re.dt_hr_registro
FROM sanraphael.tb_recebimento_email AS re
	INNER JOIN tb_usuario AS usu ON usu.co_pessoa = re.co_pessoa
	INNER JOIN tb_morador AS mo ON mo.co_pessoa=usu.co_pessoa AND mo.st_ativo IS TRUE
WHERE re.st_deseja_receber IS TRUE
GROUP BY re.co_pessoa;