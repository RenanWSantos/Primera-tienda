
<?php include_once "encabezado.php" ?>
<?php
include_once "funciones.php";
$categorias = obtenerCategorias();
?>
<div class="columns">
    <div class="column">
        <h2 class="is-size-2">Categorias existentes</h2>
        <a class="button is-success" href="agregar_categoria.php">Nuevo&nbsp;<i class="fa fa-plus"></i></a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) { ?>
                    <tr>
                        <td><?php echo $categoria->nombre ?></td>
                        <td>
                            <form action="eliminar_categoria.php" method="post">
                                <input type="hidden" name="id_categoria" value="<?php echo $categoria->id ?>">
                                <button class="button is-danger">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "pie.php" ?>