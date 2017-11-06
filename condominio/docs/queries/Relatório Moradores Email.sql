SELECT DISTINCT(pe.co_pessoa), pe.no_pessoa, pe.nu_cpf, un.co_torre, un.nu_numero, co.ds_contato
FROM tb_morador AS mo
INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
INNER JOIN tb_unidade AS un ON un.co_unidade=mo.co_unidade AND un.st_ativo IS TRUE AND un.co_tipo_unidade IN (1,2,4,7)
LEFT JOIN tb_contato AS co ON co.co_pessoa=mo.co_pessoa AND co.st_ativo IS TRUE AND co.co_tipo_contato = 3
WHERE mo.st_ativo IS TRUE
