
<?php
if (!isset($_POST["nombre"])) {
    exit("Faltan datos");
}
include_once "funciones.php";
guardarCategoria($_POST["nombre"]);
header("Location: categorias.php");
