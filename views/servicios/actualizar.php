<h2 class="nombre-pagina">Servicios</h2>
<p class="descripcion-pagina">Actualizar Servicios</p>

<?php 

include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';

?>

<form method="POST" class="formulario">

<?php include_once __DIR__ . '/formulario.php'; ?>  
    
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>
