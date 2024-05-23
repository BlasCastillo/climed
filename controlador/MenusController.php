<?php
require_once '../modelo/Menus.php';

class MenusController {
    private $menusModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->menusModelo = new Menus($conexion->Conectar());
    }
    
    public function crear($nombre, $url, $icono, $orden) {
        if ($this->menusModelo->verificarMenusExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Menus ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'MenusCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->menusModelo->crearServicio($nombre, $url, $icono, $orden);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Servicio creado correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'MenusIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->menusModelo->eliminarMenus($id);
        echo "<script> alert ('Completado: Menus Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="MenusIndex.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Menus si es necesario
    }
    
    public function modificar($id, $nombre, $url, $icono, $orden) {
        $this->menusModelo->modificarMenus($id, $nombre, $url, $icono, $orden);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Servicio modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'MenusIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        
        // Puedes agregar lógica adicional después de modificar el Menus si es necesario
    }
    
    public function verTodos() {
        return $this->menusModelo->verTodosMenus();
    }
    
    public function verPorId($id) {
        return $this->menusModelo->verMenusPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->menusModelo->buscarMenusPorNombre($nombre);
    }

    public function verificarMenusExistente($nombre) {
        return $this->menusModelo->verificarMenusExistente($nombre);
    }
}

