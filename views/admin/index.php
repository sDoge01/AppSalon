<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once( __DIR__ . '/../templates/barra.php');
?>
<h2>Buscar Citas</h2>

<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
            type="date"
            id="fecha"
            name="fecha"
            value= "<?php echo $fecha ?>"
            />
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0){
        echo "<h2>No hay citas para esta fecha</h2>";
    }

?>

<div id="citas-admin">
    <ul class="citas">
        <?php 
        $IdCita = 0; 
        foreach($citas as $key => $cita) { //key es el índice
        if($IdCita != $cita->id){
            $total = 0; 
            //Cada que hay un servicio nuevo, crea un total en 0
            ?>
        <li>
            <h2>Cita:</h2>
            <p>ID:  <span><?php echo $cita->id; ?></span></p>
            <p>Hora:  <span><?php echo $cita->hora; ?></span></p>
            <p>Correo:  <span><?php echo $cita->email; ?></span></p>
            <p>Teléfono:  <span><?php echo $cita->telefono; ?></span></p>
            <p>Nombre:  <span><?php echo $cita->cliente; ?> </span></p>
            <h2>Servicios</h2>
            <?php 
        $IdCita = $cita->id;
    } //Termina el IF 
        $total += $cita->precio; //Suma iterativamente entre cada servicio
    ?>

            <p class="servicio"><?php echo $cita->servicio . ' $' . $cita->precio; ?> </p>

            <?php 
            $actual = $cita->id;
            $proximo = $citas[$key + 1]->id ?? 0;


            if(esUltimo($actual,$proximo)){?>
                <p>Total del servicio: <span><?php echo "$" . $total; ?> </span></p>
                
                <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            <?php }
            } //Termina el FOR EACH; ?>

        </li>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>" //Nuestro buscador de citas
?>