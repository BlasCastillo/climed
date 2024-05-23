<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Cargos.php';

//clase Roles
class Roles
{

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }


    //para los datos
    private $id;
    private $nombre;
    private $estatus;
    private $valor;
    private $descripcion;
    private $fk_cargo;
    

    //setters y getters
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

    public function getestado(){
		return $this->estatus;
	}

	public function setestado($estatus){
		$this->valor = $estatus;
	}

    public function getdescripcion(){
		return $this->descripcion;
	}

	public function setdescripcion($descripcion){
		$this->valor = $descripcion;
	}

    public function getfk_cargo(){
		return $this->fk_cargo;
	}

	public function setfk_cargo($fk_cargo){
		$this->valor = $fk_cargo;
	}


    public function crearRol( $nombre, $estatus = 1, $valor, $descripcion, $fk_cargo) {
        try {
            $query = "INSERT INTO roles ( nombre, estatus, valor, descripcion, fk_cargo ) VALUES ( :nombre, :estatus, :valor, :descripcion, :fk_cargo)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fk_cargo', $fk_cargo);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los roles: " . $e->getMessage();
            return false;
        }
        
    }
    
    public function eliminarRol($id) {
        try {
            $query = "UPDATE roles SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarRol($id, $nombre, $estatus, $valor, $descripcion, $fk_cargo) {
        try {
            $query = "UPDATE roles SET nombre = :nombre, estatus = :estatus, valor = :valor, descripcion = :descripcion, fk_cargo  = :fk_cargo  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fk_cargo', $fk_cargo);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function verTodosRol() {
        try {
            $query = "SELECT 
            r.id,
            r.nombre,
            r.estatus,
            r.valor,
            r.descripcion,
            c.nombre AS nombre_cargo
        FROM 
            roles r
        JOIN 
            cargos c ON r. fk_cargo = c.id
        ORDER BY 
            r.id ASC;";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function verRolPorId($id) {
        try {
            $query = "SELECT * FROM roles WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarRolPorId($id) {
        try {
            $query = "SELECT * FROM roles WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarRolPorNombre($nombre) {
        try {
            $query = "SELECT * FROM roles WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarRolExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM roles WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los roles: " . $e->getMessage();
            return false;
        }
    }
    
}