<div class="new-booking">
    <h2>Realizar Nueva Reserva</h2>    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    
        <div class="login-form">
            <label for="fecha">Fecha:</label>  
            <input type="date" name="fecha" id="fecha" required>                   

            <label for="hora">Hora:</label>
            <select name="hora" id="hora" required>
                <option value="20:30:00">20:30</option>
                <option value="21:00:00">21:00</option>
                <option value="21:30:00">21:30</option>
                <option value="22:00:00">22:00</option>
                <option value="22:30:00">22:30</option>
                <option value="23:00:00">23:00</option>                
            </select>

            <label for="mesas">Mesa:</label>
            <select name="mesa" id="mesa" required>
                <option value="1">Mesa 1</option>
                <option value="2">Mesa 2</option>
                <option value="3">Mesa 3</option>
                <option value="4">Mesa 4</option>
                <option value="5">Mesa 5</option>
            </select>

            <label for="descripcion">Descripción (opcional):</label>
            <textarea type="text" name="descripcion" id="descripcion" placeholder="Añada una descripción"></textarea>

                <?php if(isset($_GET['wrong'])): ?>
                    <p class="used-email">La reserva está ocupada.</p>
                <?php endif ?>

            <input name="reservar" type="submit" value="Reservar">          
        </div>  
    </form>    
</div>
