<?php  
    // INSERTAR
    include("datos_conexion.php");
    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
    $txt_producto = utf8_decode($_POST["txt_producto"]);
    $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
    $txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
    $txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
    $txt_existencia = utf8_decode($_POST["txt_existencia"]);
    $drop_marca= utf8_decode($_POST["drop_marca"]);

    $sql = "INSERT INTO productos(producto,descripcion,precio_costo,precio_venta,existencia,idmarca)VALUES('".$txt_producto."','".$txt_descripcion."',".$txt_precio_costo.",".$txt_precio_venta.",".$txt_existencia.",".$drop_marca.");";
    if($db_conexion->query($sql)===true){
        $db_conexion ->close();
        echo"Exito";
        ob_start();
        header('Location: index.php');
        ob_end_flush();
    }
    else{
        echo "Error".$sql."</br>".$db_conexion ->close();
    }       
?>

<?php
    // ELIMINAR
    include("datos_conexion.php");
    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
    $txt_id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE idProducto= '".$txt_id."';";
    if($db_conexion->query($sql)===true){
        $db_conexion ->close();
        echo"Exito";
        ob_start();
        header('Location: index.php');
        ob_end_flush();
    }
    else{
        echo "Error".$sql."</br>".$db_conexion ->close();
    }       
?>