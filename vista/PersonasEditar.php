<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>


<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php');?>
</head>
<body>
    <div class="container-fluid pt-4 px-4">
                

                <?php
                    require_once('../controlador/PersonasController.php');

                    // Crear una instancia de rolcontroller
                    $PersonasController = new PersonasController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $personaId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $persona = $PersonasController->verPersonaPorId($personaId);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['correo']) && isset($_POST['sexo']) && isset($_POST['direccion']) && isset($_POST['f_nacimiento']) && isset($_POST['estatus'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoApellido = $_POST['apellido'];
                            $nuevaCedula = $_POST['cedula'];
                            $nuevoTelefono = $_POST['telefono'];
                            $nuevoCorreo = $_POST['correo'];
                            $nuevoSexo = $_POST['sexo'];
                            $nuevaDireccion = $_POST['direccion'];
                            $nuevaf_nacimiento = $_POST['f_nacimiento'];
                            $nuevoEstatus = $_POST['estatus'];
                            
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $PersonasController->modificarPersona($personaId, $nuevoNombre, $nuevoApellido, $nuevaCedula, $nuevoTelefono, $nuevoCorreo, $nuevoSexo, $nuevaDireccion, $nuevaf_nacimiento, $nuevoEstatus);

                            exit();
                            
                        }
                    }

                ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

            <center><h1>Editar Persona</h1></center>

            <form method="POST">

                <div class="form-floating mb-3">
                <input class="form-control " type="text" name="nombre" id="nombre" value="<?php echo $persona['nombre']; ?> " required>
                <label  for="nombre">Nombre:</label>
                </div>


                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="apellido" id="apellido" value="<?php echo $persona['apellido']; ?> " required>
                    <label  for="apellido">Apellido:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="cedula" id="cedula" value="<?php echo $persona['cedula']; ?> " required>
                    <label  for="cedula">Cedula:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="telefono" id="telefono" value="<?php echo $persona['telefono']; ?> " required>
                    <label  for="telefono">Telefono:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="correo" id="correo" value="<?php echo $persona['correo']; ?> " required>
                    <label  for="correo">Correo:</label>
                </div>

                <div class="form-floating mb-3">

                    <div class="form-floating mb-3">
                    <p>Sexo:</p>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" id="masculino" name="sexo" value="1">
                    <label class="form-check-label" for="masculino">Masculino</label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" id="femenino" name="sexo" value="0">
                    <label class="form-check-label" for="femenino">Femenino</label>
                    </div>
                
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="direccion" id="direccion" value="<?php echo $persona['direccion']; ?> " required>
                    <label  for="direccion">Direccion:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="date" name="f_nacimiento" id="f_nacimiento" value="<?php echo date('Y-m-d', strtotime($persona['f_nacimiento'])); ?>" required>
                    <label  for="f_nacimiento">Fecha Nacimiento:</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="estatus" id="estatus">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <label  for="estatus">Estatus:</label>                    
                </div>

                <div class="form-floating mb-3">
                    <button class="btn btn-outline-success" type="submit">Editar persona. <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="PersonasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>

            </form>

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
    <script src="dist/js/validarpersona.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>