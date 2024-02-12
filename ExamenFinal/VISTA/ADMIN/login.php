<div class="login">
    <h2>Iniciar sesión</h2>    
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?rol=personal'; ?>" method="post">    
        <div class="login-form">
            <label for="user">Usuario:</label>
            <input type="text" name="user" id="user" required>               
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <?php if(isset($_GET['wrong'])): ?>
                <p class="used-email">El usuario o la contraseña es/son incorrecto/as.</p>
            <?php endif ?>         
            <input name="loginAdmin" type="submit" value="Iniciar sesión">          
        </div>  
    </form>
</div>