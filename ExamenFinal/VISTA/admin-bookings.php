<!-- Los estilos de historico son adecuados para esta vista también -->
<div class="historico">
    <h2>Visualizar Reservas</h2>    
    <?php if(!$bookings_history_empty) : ?>
    <table>
        <thead>
            <tr>
                <th>Correo</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($bookings_history as $fila) : ?>
                <tr>
                    <td><?php echo $fila['CORREO_CLIENTE']?></td>
                    <td><?php echo $fila['FECHA']?></td>
                    <td><?php echo $fila['HORA']?></td>
                    <td><?php echo $fila['DESCRIPCION']?></td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?cancelar='?>" method="POST">
                            <input type="hidden" name="fecha" value="<?php echo $fila['FECHA']?>">
                            <input type="hidden" name="hora" value="<?php echo $fila['HORA']?>">
                            <input type="hidden" name="mesa" value="<?php echo $fila['MESA']?>">
                            <input type="submit" name="cancelar" value="Cancelar"></input>                                                        
                        </form>          
                    </td>          
                </tr>                                
            <?php endforeach ?>            
        </tbody>
    </table>
    <?php else : ?>
        <h3>Aún no se han hecho reservas.</h3>
    <?php endif ?>
    <a href="index.php"><button class="back-button">Atrás</button></a>
</div>