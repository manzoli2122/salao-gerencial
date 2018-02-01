 CREATE VIEW pagamentos_view
 
  AS SELECT pagamentos.id, 
  				users.name as cliente, 
 				
                CONCAT( "R$", ROUND( pagamentos.valor, 2 ) ) as valor ,
  				
                DATE_FORMAT( pagamentos.created_at, "%Y-%m-%d") as created_at, 
                
  				      pagamentos.formaPagamento,

                pagamentos.operadora_confirm,

                pagamentos.deleted_at,
                pagamentos.bandeira,
                operadoras.nome
                
  
  FROM pagamentos
  
  LEFT JOIN users 
  ON users.id = pagamentos.cliente_id 
  

  LEFT JOIN operadoras 
  ON operadoras.id = pagamentos.operadora_id 


  ;