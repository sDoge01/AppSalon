<div class="campo">

    <label for="nombre">Nombre:</label>

    <input 
    type="text"
    placeholder="Nombre del servicio"
    name="nombre"
    id="nombre"
    value="<?php echo $servicio->nombre; ?>"
    />
</div>

<div class="campo">

    <label for="precio">Precio</label>

    <input 
    type="text"
    placeholder="Precio del servicio"
    name="precio"
    id="precio"
    value="<?php echo $servicio->precio; ?>"
    />
</div>