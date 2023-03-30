
<?php
if (!isset($_POST["id_categoria"])) {
    exit("No hay datos");
}

include_once "funciones.php";
eliminarCategoria($_POST["id_categoria"]);
header("Location: categorias.php");
