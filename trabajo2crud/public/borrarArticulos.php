<?php

require "../vendor/autoload.php";

use Clases\Articulos;

if(!isset($_POST['codigo'])){
    header("Location:index.php");
    die();
}

$esteArticulo = new Articulos();
$esteArticulo->setId($_POST['codigo']);
$esteArticulo->borrar();
$esteArticulo = null;
$_SESSION['mensaje']="Artículo Borrado Correctamente";
header("Location:index.php");