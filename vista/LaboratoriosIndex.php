<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

require_once '../controlador/LaboratoriosController.php';
$controlador = new LaboratoriosController();
$laboratorios = $controlador->verTodos();
?>


<!DOCTYPE html>
<html>
<head>
    <?php include('dist/Plantilla.php');?>
</head>
<body>

<?php include('dist/Menu.php');?>
    <div class="content open">
        <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown" style="margin-left: 10%;">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                         <img src="<?php echo $_SESSION['foto']?>" alt="" width="20px"  class="rounded-circle me-lg-2">
                            <span class="d-none d-lg-inline-flex"><?php echo   $_SESSION['nombre'] . " " . $_SESSION['apellido']  ; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="../controlador/cerrar_sesion.php" class="dropdown-item">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                <h2>Catalogo de Laboratorios</h2>
                <!-- Buscador dinámico para buscar por nombre -->
                <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">

                <div class="table-responsive">

                    <?php  if($_SESSION['valor_rol'] == '1'): ?>
                        <br><a class="btn btn-primary" href="LaboratoriosCrear.php">Nuevo Laboratorio</a>
                    <?php endif; ?>


                    <table id="tabla" class="table">
                    <tr>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Valor</th>
                    <th>Descripcion</th>
                    <?php if($_SESSION['valor_rol'] == '1'): ?> 
                        <th>Acciones</th>
                    <?php endif; ?>
                    </tr>
                    <?php foreach($laboratorios as $laboratorio): ?>
                    <tr>
                    <td><?php echo $laboratorio['nombre']; ?></td>

                    <td><?php if ($laboratorio['estatus']== 1)
                    {
                    echo 'activo';
                    } else {
                    echo "inactivo";
                    }


                    ?></td>
                    <td><?php echo $laboratorio['valor'];?></td>
                    <td><?php echo $laboratorio['descripcion'];?></td>
                    <td>
                    <?php if($_SESSION['valor_rol'] == '1'):?>
                    <a  class="btn btn-outline-warning" href="LaboratoriosEditar.php?id=<?php echo $laboratorio['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                    <a class="btn btn-outline-danger" href="LaboratoriosEliminar.php?id=<?php echo $laboratorio['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                    <?php endif; ?>

                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
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
    <script src="dist/plantilla/js/main.js"></script>
    <script src="dist/js/buscar.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
