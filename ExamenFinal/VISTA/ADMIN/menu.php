<div class="login">
    <h3>Usuario: <?php echo $_SESSION['current_user'] ?></h3>    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    
        <div class="login-form">            
            <input name="addUser" type="submit" value="Añadir Nuevo Usuario">
            <input name="viewBookings" type="submit" value="Visualizar Reservas">                        
            <?php if(isset($_GET['addUser']) && $_GET['addUser'] == "true"): ?>
                <p class="succesful">¡Usuario añadido con éxito!</p>
            <?php endif ?> 
        </div>  
    </form>    
</div>