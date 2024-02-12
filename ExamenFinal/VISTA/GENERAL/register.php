<div class="login">
    <h2>Regístrate</h2>    
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?login=false"; ?>" method="post">    
        <div class="login-form">
            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" id="email" required>
            <?php if(isset($alreadyRegistered) && $alreadyRegistered): ?>
                <p class="used-email">Este correo ya se encuentra en uso</p>
            <?php endif ?>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <input name="register" type="submit" value="Registrarse">          
        </div>  
    </form>    
    <p>¿Ya tienes cuenta? <a href="index.php?login=true">Inicia sesión aquí</a>.</p>
</div>