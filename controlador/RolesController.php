<?php
require_once '../modelo/Roles.php';

class RolesController {
    private $rolesModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->rolesModelo = new Roles($conexion->Conectar());
    }
    
    public function crear($nombre, $valor, $descripcion, $fk_cargo) {
        if ($this->rolesModelo->verificarRolExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Rol ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'RolesCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->rolesModelo->crearRol($nombre, '1', $valor, $descripcion, $fk_cargo);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'Rol creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->rolesModelo->eliminarRol($id);
        echo "<script> alert ('Completado: Rol Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="RolesIndex.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }
    
    public function modificar($id,$nombre, $estatus, $valor, $descripcion, $fk_cargo) {
        $this->rolesModelo->modificarRol($id,$nombre, $estatus, $valor, $descripcion, $fk_cargo);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'Rol modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el rol si es necesario
    }
    
    public function verTodos() {
        return $this->rolesModelo->verTodosRol();
    }
    
    public function verPorId($id) {
        return $this->rolesModelo->verRolPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->rolesModelo->buscarRolPorNombre($nombre);
    }

    public function verificarRolExistente($nombre) {
        return $this->rolesModelo->verificarRolExistente($nombre);
    }
}

