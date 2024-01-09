<?php
    $dwes = new mysqli();
    try {
        $dwes->connect('localhost', 'user_dwes', 'userUSER2', 'dwes');
        $dwes->autocommit(false);
        if($dwes->connect_errno == 0){
            $result = $dwes->query(
                "UPDATE STOCK 
                SET UNIDADES = UNIDADES - 1
                WHERE PRODUCTO = '3DSNG' AND TIENDA = 1;
            ");
    
            try{
                $result = $dwes->query("
                INSERT INTO STOCK(PRODUCTO, TIENDA, UNIDADES)
                VALUES ('3DSNG', 3, 1);
                ");    
    
                print "<p>Se han modificado $dwes->affected_rows registros.</p>";        
                $dwes->commit();
                $result->free();
    
            }catch(Exception $e){
                
                echo "<p>Ha ocurrido un error en la consulta.</p>";
                $dwes->rollback();
            }       
                         
            $dwes->close();
        }                
    } catch (mysqli_sql_exception $e) {}    
    
?>