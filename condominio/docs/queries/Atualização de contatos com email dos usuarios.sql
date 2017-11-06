INSERT INTO tb_contato (co_pessoa, co_tipo_contato, ds_contato, st_ativo, dt_hr_registro, co_pessoa_registro)
SELECT usu.co_pessoa, 3, usu.ds_email, true, CURRENT_TIMESTAMP, 1
FROM tb_usuario AS usu
INNER JOIN tb_morador AS mo ON mo.co_pessoa=usu.co_pessoa
GROUP BY usu.ds_email