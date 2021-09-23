<?php 
    include("datos_conexion.php");
    $id = utf8_decode($_GET["id"]);
    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
    // Select
    $db_conexion->real_query("select * from productos where idProducto = '".$id."' ;");
    $resultado = $db_conexion->use_result();
    while ($fila = $resultado->fetch_assoc()) {
        
?>
<!doctype html>
<html lang="en">

<head>
    <title>Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        body{
            background-color:#81d0f7;
        }
    </style>
</head>

<body>
    <!-- Formulario para editar producto -->
    <center><h1>Formulario Productos</h1></center>
    <div class="container">
        <form class="d-flex" action="" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_producto" class="form-label">Producto</label>
                    <input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Producto: Playera Nike"
                        value="<?php echo $fila['producto'] ?>" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label">Descripcion</label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control"
                        value="<?php echo $fila['descripcion'] ?>" placeholder="Descripcion: Color Azul"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_precio_costo" class="form-label">Precio Costo</label>
                    <input type="number" name="txt_precio_costo" id="txt_precio_costo" class="form-control"
                        value="<?php echo $fila['precio_costo'] ?>" placeholder="Precio Costo: 50"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_precio_venta" class="form-label">Precio Venta</label>
                    <input type="number" name="txt_precio_venta" id="txt_precio_venta" class="form-control"
                        value="<?php echo $fila['precio_venta'] ?>" placeholder="Precio Venta:100 "
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_existencia" class="form-label">Existencia</label>
                    <input type="number" name="txt_existencia" id="txt_existencia" class="form-control"
                        value="<?php echo $fila['existencia'] ?>" placeholder="Existencia: 300"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_marca" class="form-label">Marca</label>
                    <select class="form-control" name="drop_marca" id="drop_marca">
                        <!-- <option value="<?php echo $fila['idmarca'] ?>"> -->
                        <?php 
                            $db_conexion3 = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                            $db_conexion3->real_query("SELECT marca FROM marcas where idmarca = ".$fila['idmarca']." ;");
                            $resultado3 = $db_conexion3->use_result();
                            while ($fila3 = $resultado3->fetch_assoc()) {
                                echo ("<option value=" . $fila3['idmarca'] . ">" . $fila3['marca'] . "</option>");
                            }
                            
                        ?>
                        </option>
                        <?php
                        $db_conexion2 = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                        $db_conexion2->real_query("SELECT idmarca as id,marca FROM marcas;");
                        $resultado2 = $db_conexion2->use_result();
                        while ($fila2 = $resultado2->fetch_assoc()) {
                            if ( $fila2['id'] != $fila3['id']){
                                echo ("<option value=" . $fila2['id'] . ">" . $fila2['marca'] . "</option>");
                            } 
                        }
                        $db_conexion2->close();
                        $db_conexion3->close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                    <a class="btn btn-danger" href="index.php">Cancelar</a>
                </div>
            </div>
        </form>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
    </div>
</body>

<?php 
    } 
    // Editar
    if (isset($_POST["btn_editar"])) {  
        $txt_producto = utf8_decode($_GET["id"]);
        $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
        $txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
        $txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
        $txt_existencia = utf8_decode($_POST["txt_existencia"]);
        $drop_marca= utf8_decode($_POST["drop_marca"]);
        $sql = "update productos set descripcion='".$txt_descripcion."', precio_costo=".$txt_precio_costo.", precio_venta=".$txt_precio_venta.", existencia=".$txt_existencia.", idmarca=".$drop_marca." WHERE idProducto=".$txt_producto.";";
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            //ob_start();
            //header('Location: index.php');
            //ob_end_flush();
        }
        else{
            echo "Error".$sql."</br>".$db_conexion ->close();
        }   

    }        

?>


</html>