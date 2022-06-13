<h1 class="nombre-pagina">Crear cuenta</h1>
<?php 

    include_once __DIR__ . '/../templates/alertas.php';
?>
<p class="descripcion-pagina">Ingresa tus datos debajo: </p>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
    <label for="nombre">Tu nombre</label>

    <input 
    type="text"
    id="nombre"
    name="nombre"
    placeholder="Tu nombre"
    value="<?php echo $usuario->nombre ?>"
    
    />
    </div>

    <div class="campo">
    <label for="apellido">Apellido</label>

    <input 
    
    type="text"
    id="apellido"
    name="apellido"
    placeholder="Tu apellido"
    value="<?php echo $usuario->apellido ?>"
    />
    </div>

    <div class="campo">
    <label for="telefono">Teléfono</label>

    <input 
    type="number"
    id="telefono"
    name="telefono"
    placeholder="Tu número de teléfono"
    value="<?php echo $usuario->telefono ?>"
    />
    </div>

    <div class="campo">
    <label for="email">Tu email</label>

    <input 
    type="email"
    id="email"
    name="email"
    placeholder="Tu email"
    value="<?php echo $usuario->email ?>"
    />
    </div>

    <div class="campo">
    <label for="password">Tu contraseña</label>

    <input 
    type="password"
    id="password"
    name="password"
    placeholder="Tu contraseña"
    value="<?php echo $usuario->password ?>"
    />
    </div>

    <input type="submit"
    value="Crear cuenta"
    class="boton"
    />

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/olvide">¿Has olvidado tu contraseña?</a>
    </div>
</form>