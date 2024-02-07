<div class="login">
    <h3>Bienvenido <?php echo $email ?></h3>    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    
        <div class="login-form">
            <label for="opcion">Selecciona una opción:</label>
            <input name="gestionar" type="submit" value="Ver y Gestionar Reservas Activas">
            <input name="nueva" type="submit" value="Hacer Nueva Reserva">
            <input name="historico" type="submit" value="Ver Histórico de Reservas">
        </div>  
    </form>    
</div>