<h1 class="nombre-pagina">Restablecer tu contraseña</h1>
<p class="descripcion-pagina">Coloca tu contraseña a continuación</p>

<?php
include_once __DIR__ . '/../templates/alertas.php';
?>

<?php if ($error){ return; } ?> 
<!--Si traemos el error, es que no se ha coincidido con el token buscado -->
<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Introduce tu contraseña:</label>
        <input 
        type="password"
        id="password"
        placeholder="tu nueva contraseña"
        name="password"
        />
    </div>

    <input type="submit" class="boton" value="Cambiar mi contraseña">

    <div class="acciones">
        <a href="/">Ya tienes una cuenta? Inicia sesión</a>
        <a href="/">¿Aún no tienes una cuenta? Crear una</a>
    </div>
</form>