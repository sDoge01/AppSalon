<h1 class="nombre-pagina">Olvidé mi contraseña</h1>
<p class="descripcion-pagina">Tranqui, nos pasa a todos ;)</p>
<?php
include_once __DIR__ . '/../templates/alertas.php';
?>
<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Ingresa tu email</label>
        <input 
        type="email"
        id="email"
        name="email"
        placeholder=" y te mandamos un correo :D"
        >
    </div>

    <input type="submit"
    value="Enviar instrucciones"
    class="boton"
    />
    
</form>

<div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/crear-cuenta">¿No tienes una cuenta? Crea una!</a>
    </div>