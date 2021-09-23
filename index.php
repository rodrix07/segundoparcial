<!doctype html>
<html lang="en">

<head>
    <title>Empresa</title>
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
    <!-- Formulario para crear nuevos productos -->
    <center><h1>Formulario Empresa</h1></center>
    <div class="container">
        <form class="d-flex" action="crud_producto.php" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_producto" class="form-label">Producto</label>
                    <input style= "color:#008f93" type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Producto: Camisa "
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label">Descripcion</label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control"
                        placeholder="Descripcion: Roja" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_precio_costo" class="form-label">Precio Costo</label>
                    <input type="number" name="txt_precio_costo" id="txt_precio_costo" class="form-control"
                        placeholder="Precio Costo: 50" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_precio_venta" class="form-label">Precio Venta</label>
                    <input type="number" name="txt_precio_venta" id="txt_precio_venta" class="form-control"
                        placeholder="Precio Venta: 100" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_existencia" class="form-label">Existencia</label>
                    <input type="number" name="txt_existencia" id="txt_existencia" class="form-control"
                        placeholder="Existencia: 100" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_marca" class="form-label">Marca</label>
                    <select class="form-control" name="drop_marca" id="drop_marca">
                        <option value=0>----Marca----</option>
                        <?php
                        include("datos_conexion.php");
                        $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                        $db_conexion->real_query("SELECT idMarca as id,marca FROM marcas;");
                        $resultado = $db_conexion->use_result();
                        while ($fila = $resultado->fetch_assoc()) {
                            echo ("<option value=" . $fila['id'] . ">" . $fila['marca'] . "</option>");
                        }
                        $db_conexion->close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-success" value="Agregar">
                </div>
            </div>
        </form>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Precio Costo</th>
                    <th>Precio Venta</th>
                    <th>Existencia</th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                $db_conexion->real_query("select e.idProducto,e.producto,e.descripcion,e.precio_costo,e.precio_venta,e.existencia,p.marca from productos as e inner join marcas as p on e.idmarca = p.idmarca  ;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr data-id=" . $fila['idProducto'] . ">";
                    echo ("<th>" . $fila['producto'] . "</th>");
                    echo ("<th>" . $fila['descripcion'] . "</th>");
                    echo ("<th>" . $fila['precio_costo'] . "</th>");
                    echo ("<th>" . $fila['precio_venta'] . "</th>");
                    echo ("<th>" . $fila['existencia'] . "</th>");
                    echo ("<th>" . $fila['marca'] . "</th>");
                    echo ("<th>");
                    echo ("<a class=\"btn btn-primary\" id=\"btn_editar\" href=\"editar.php?id=". $fila['idProducto'] ."\">Editar</a>");
                    echo ("<a class=\"btn btn-danger\" id=\"btn_eliminar\" href=\"crud_producto.php?id=". $fila['idProducto'] ."\" >Eliminar</a>");
                    echo ("</th>");
                    echo "</tr>";
                }
                $db_conexion->close();
                ?>
            </tbody>
        </table>

        <?php
        if (isset($_POST["btn_eliminar"])){
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
            //$txt_producto = utf8_decode($fila['idProducto']);
            $sql="DELETE FROM productos WHERE id == '".$fila['idProducto']."'";
            $resultado = $mysqli->query($sql);
            ob_start();
            header("Refresh:0");
            ob_end_flush();
        }
        ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>