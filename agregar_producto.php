
<?php include_once "encabezado.php" ?>
<?php
include_once "funciones.php";
$categorias = obtenerCategorias();
?>
<div class="columns">
    <div class="column is-one-third">
        <h2 class="is-size-2">Nuevo producto</h2>
        <form action="guardar_producto.php" method="post">
            <div class="field">
                <label for="nombre">Nombre</label>
                <div class="control">
                    <input required id="nombre" class="input" type="text" placeholder="Nombre" name="nombre">
                </div>
            </div>
            <div class="field">
                <label for="nombre">Imagen</label>
                <div class="control">
                    <input required id="imagen" class="input" type="text" placeholder="Imagen" name="imagen">
                </div>
            </div>
            <label for="categoria">Categoria</label>
            <div class="field select">
                <select id="categoria" placeholder="categoria" name="categoria">
                    <option selected>Seleccione una categoria</option>
                    <?php foreach($categorias as $categoria) {?>
                        <option value="<?php echo $categoria->id?>">
                            <?php echo $categoria->nombre ?>
                        </option>
                    <?php }?>
                </select>
            </div>
            <div class="field">
                <label for="descripcion">Descripción</label>
                <div class="control">
                    <textarea name="descripcion" class="textarea" id="descripcion" cols="30" rows="5" placeholder="Descripción" required></textarea>
                </div>
            </div>
            <div class="field">
                <label for="precio">Precio</label>
                <div class="control">
                    <input required id="precio" name="precio" class="input" type="number" placeholder="Precio">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-success">Guardar</button>
                    <a href="productos.php" class="button is-warning">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once "pie.php" ?>