<?php
session_start();
require '../vendor/autoload.php';

use Clases\Articulos;


if (isset($_POST['crear'])) {

    $catn = trim($_POST['nombre']);
    $catp = trim($_POST['pvp']);
    $cats = trim($_POST['stock']);

    $esteArticulo = new Articulos();
    if (!$esteArticulo->existeArticulo(ucwords($catn))) {
        $esteArticulo->setNombre(ucwords($catn));
        $esteArticulo->setPvp(ucwords($catp));
        $esteArticulo->setStock(ucwords($cats));
        $esteArticulo->create();
        $esteArticulo = null;
        $_SESSION['mensaje'] = "Articulo creado";
        header("Location:index.php");
    }else {
        $_SESSION['mensaje'] = "El articulo ya existe";
        $esteArticulo = null;
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }
} else {
    //pintamos el form

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>Crear Articulos</title>
    </head>

    <body style="background-color:bisque">
        <h3 class="text-center mt-3">Crear Articulos</h3>
        <div class="container mt-3 text-center">
        <?php
        //llamamos a la clase mensaje para mostrar los mensajes
        require 'resources/mensaje.php';
        ?>
            <form name="nt" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mt-2">
                    <input type="text" name="nombre" placeholder="Nombre" required />
                </div>
                <div class="mt-2">
                    <input type="number" name="pvp" placeholder="Pvp" required />
                </div>
                <div class="mt-2">
                    <input type="number" name="stock" placeholder="Stock" required />
                </div>
                <div class="mt-2">
                    <input type="submit" name="crear" placeholder="Crear" class="btn btn-success mr-2" />
                    <input type="reset" value="Limpiar" class="btn btn-warning mr-2">
                    <a href="index.php" class="btn btn-primary">Volver</a>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php } ?>