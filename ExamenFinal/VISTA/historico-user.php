<div class="historico">
    <h2>Histórico de Reservas</h2>
    <?php if(isset($current_historic)) : ?>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Mesa</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($current_historic as $fila) : ?>
                <tr>
                    <th><?php echo $fila['FECHA']?></th>
                    <th><?php echo $fila['HORA']?></th>
                    <th><?php echo $fila['MESA']?></th>
                    <th><?php echo $fila['DESCRIPCION']?></th>
                </tr>                                
            <?php endforeach ?>            
        </tbody>
    </table>
    <?php else : ?>
        <h3>NINGUNA RESERVA DISPONIBLE</h3>
    <?php endif ?>
</div>