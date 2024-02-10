<div class="historico">
    <h2>Reservas Activas</h2>    
    <?php if(isset($current_active_bookings)) : ?>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Mesa</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($current_active_bookings as $fila) : ?>
                <tr>
                    <td><?php echo $fila['FECHA']?></td>
                    <td><?php echo $fila['HORA']?></td>
                    <td><?php echo $fila['MESA']?></td>
                    <td><?php echo $fila['DESCRIPCION']?></td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?gestionar="?>" method="POST">
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
        <h3>NINGUNA RESERVA ACTIVA DISPONIBLE</h3>
    <?php endif ?>
</div>