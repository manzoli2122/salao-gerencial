 CREATE VIEW pagamentos_view
 
  AS SELECT pagamentos.id, 
  				users.name as cliente, 
 				
                CONCAT( "R$", ROUND( pagamentos.valor, 2 ) ) as valor ,

  				      IF(pagamentos.operadora_confirm = 0, 'não', 'sim') AS operado,

                IF(pagamentos.caiu_conta = 0, 'não', 'sim') AS na_conta,

                DATE_FORMAT( pagamentos.created_at, "%Y-%m-%d") as created_at, 
                
  				      pagamentos.formaPagamento,

                pagamentos.operadora_confirm,

                pagamentos.deleted_at,
                pagamentos.bandeira,
                operadoras.nome,
                pagamentos.caiu_conta
                
                
  
  FROM pagamentos

 
  
  LEFT JOIN users 
  ON users.id = pagamentos.cliente_id 
  

  LEFT JOIN operadoras 
  ON operadoras.id = pagamentos.operadora_id 

   WHERE pagamentos.deleted_at is NULL
  ;