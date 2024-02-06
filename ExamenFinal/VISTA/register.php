<div class="login">
    <h2>Regístrate</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" id="email">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Registrarse">
    </form>
    <p>¿Ya tienes cuenta? <a href="">Inicia sesión aquí</a>.</p>
</div>