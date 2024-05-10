<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
?>


<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php'); ?>
</head>
    <body>
        <div class="contenedor">
            <div class="container" style="width: 50%;">

                <?php
                    require_once('../controlador/PatologiasController.php');

                    // Crear una instancia de rolcontroller
                    $patologiascontroller = new PatologiasController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $patologiaId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $patologia = $patologiascontroller->verPorId($patologiaId);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['valor']) && isset($_POST['descripcion'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoEstado = $_POST['estado'];
                            $nuevoValor = $_POST['valor'];
                            $nuevoDescripcion = $_POST['descripcion'];
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $patologiascontroller->modificar($patologiaId, $nuevoNombre, $nuevoEstado, $nuevoValor, $nuevoDescripcion);

                            exit();
                        }
                    }
                ?>

                <center><h1>Editar Patologia</h1></center>
                <form method="POST">

                <div class="form-floating mb-3">  
                    <input class="form-control " type="text" name="nombre" id="nombre" value="<?php echo $patologia['nombre']; ?> ">
                    <label  for="nombre">Nombre:</label>
                </div>

                <div class="form-floating mb-3">  
                    <select class="form-select" name="estado" id="estado">
                        <?php if ($patologia['estatus'] == 1) {
                        echo' <option value="1">Activo</option>
                            <option value="0">Inactivo</option>';
                            } else {
                        echo ' <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                            ';
                        }
                        ?>
                    </select>
                    <label  for="estado">Estado:</label>
                </div>

                <div class="form-floating mb-3">  
                    <select class="form-select" name="valor" id="valor">
                    <?php if ($patologia['valor'] == 1) {
                    echo' <option value="1">Enfermedades infecciosas</option>';
                    echo '<option value="2">Enfermedades no infecciosas</option>';
                    echo' <option value="3">Traumatismos</option>';
                    echo' <option value="4">Enfermedades congénitas</option>';
                    echo' <option value="5">Trastornos mentales</option>';
                        } else {
                            if ($patologia['valor'] == 2) {
                                echo' <option value="2">Enfermedades no infecciosas</option>';
                                echo '<option value="1">Enfermedades infecciosas</option>';
                                echo' <option value="3">Traumatismos</option>';
                                echo' <option value="4">Enfermedades congénitas</option>';
                                echo' <option value="5">Trastornos mentales</option>';
                                } else {
                                        if ($patologia['valor'] == 3) {
                                            echo' <option value="3">Traumatismos</option>';
                                            echo '<option value="1">Enfermedades infecciosas</option>';
                                            echo' <option value="2">Enfermedades no infecciosas</option>';
                                            echo' <option value="4">Enfermedades congénitas</option>';
                                            echo' <option value="5">Trastornos mentales</option>';
                                } else{
                                    if ($patologia['valor'] == 4) {
                                        echo' <option value="4">Enfermedades congénitas</option>';
                                        echo '<option value="1">Enfermedades infecciosas</option>';
                                        echo' <option value="2">Enfermedades no infecciosas</option>';
                                        echo' <option value="3">Traumatismos</option>';
                                        echo' <option value="5">Trastornos mentales</option>';
                        } else{
                            if ($patologia['valor'] == 5) {
                                echo' <option value="5">Trastornos mentales</option>';
                                echo '<option value="1">Enfermedades infecciosas</option>';
                                echo' <option value="2">Enfermedades no infecciosas</option>';
                                echo' <option value="3">Traumatismos</option>';
                                echo' <option value="4">Enfermedades congénitas</option>';
                                }
                    }}}}                       
                    ?>
                    </select>
                    <label  for="valor">Valor:</label> 
                </div>

                <div class="form-floating mb-3">  
                    <input class="form-control " type="text" name="descripcion" id="descripcion" value="<?php echo $patologia['descripcion']; ?> ">
                    <label  for="nombre">Descripcion:</label>  
                </div>

                <div class="form-floating mb-3">  
                    <button class="btn btn-outline-success" type="submit">Guardar patologia <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="PatologiasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
                </form>
                <?php /* var_dump($nombre, $estatus, $valor, $descripcion ); */?>

            </div>
        </div>
        <!-- libreries JS -->
    <script src="dist/js/jquery-3.7.1.min.js"></script>
            <script src="dist/plantilla/lib/bootstrap.bundle.min.js"></script>
                <script src="dist/plantilla/lib/chart/chart.min.js"></script>
                    <script src="dist/plantilla/lib/easing/easing.min.js"></script>
                        <script src="dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                    <script src="dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
            <script src="dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="dist/js/LimpiarInput.js"></script>
        <script src="dist/plantilla/js/main.js"></script>
            <script src="dist/js/buscar.js"></script>
        <script src="dist/js/validaciongenerica.js"></script>
        <script src="dist/js/validacionseguridad.js"></script>
    </body>
</html>
