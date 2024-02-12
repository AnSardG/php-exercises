<div class="add-user">
    <h2>Añadir Nuevo Usuario</h2>    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    
        <div class="login-form">
            <label for="user">Usuario:</label>
            <input type="text" name="user" id="user" required>               
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required> 
            <?php if(isset($wrong) && $wrong): ?>
                <p class="used-email">El usuario ya se encuentra registrado en la base de datos.</p>
            <?php endif ?>                   
            <input name="newUser" type="submit" value="Añadir Usuario">          
            <div class="botoncito">
                <a class="back-button" href="index.php">Atrás</a>
            </div>            
        </div>  
    </form>
</div>