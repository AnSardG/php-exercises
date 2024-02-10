<div class="login">
    <h2>Inicia sesión</h2>    
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?login=true"; ?>" method="post">    
        <div class="login-form">
            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" id="email" required>               
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <?php if(isset($_SESSION['logged_succesfully']) && !$_SESSION['logged_succesfully']): ?>
                <p class="used-email">El correo o la contraseña es/son incorrecto/as.</p>
            <?php endif ?>         
            <input name="login" type="submit" value="Iniciar sesión">          
        </div>  
    </form>    
    <p>¿No tienes cuenta? <a href="index.php?login=false">Regístrate aquí</a>.</p>
</div>