 CREATE VIEW atendimentos_view
 
  AS SELECT atendimentos.id, 
  				users.name as cliente, 
 				
                CONCAT( "R$", ROUND( atendimentos.valor, 2 ) ) as valor ,
  				
                DATE_FORMAT( atendimentos.created_at, "%Y-%m-%d") as created_at, 
                
  				atendimentos.deleted_at
  
  FROM atendimentos
  
  LEFT JOIN users 
  ON users.id = atendimentos.cliente_id 
  
  
  
  ;