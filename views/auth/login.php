<?php
include_once __DIR__ . '/../templates/alertas.php';

?>
<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina" >Inicia sesión con tus datos</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email: </label>
        <input 
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
        />
    </div>

    <div class="campo">
        <label for="password">Password: </label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu contraseña"
        />
    </div>

    <input type="submit"
    value="Iniciar Sesión"
    class="boton"
    />

    <div class="acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
        <a href="/olvide">¿Has olvidado tu contraseña?</a>
    </div>
</form>