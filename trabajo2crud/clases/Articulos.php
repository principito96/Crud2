<?php

namespace Clases;
require "../clases/Conexion.php";
use Clases\Conexion;
use PDO;
use PDOException;

class Articulos extends Conexion
{
    private $id;
    private $nombre;
    private $pvp;
    private $stock;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $i = "insert into articulos(nombre,pvp,stock) values(:n,:p,:s)";
        $stmt = parent::$conexion->prepare($i);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->pvp,
                ':s' => $this->stock
                ]);
        } catch (PDOException $ex) {
            die("Error al crear un articulo:" . $ex->getMessage());
        }
    }

    public function mostrarDatos(){
        $con = "select * from articulos";
        $stmt = parent::$conexion->prepare($con);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al mostrar todos los articulos" . $ex->getMessage());
        }
        return $stmt;
    }
    
    public function borrar(){
        $c = "delete from articulos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar los articulos:" . $ex->getMessage());
        }
    }

    public function leerDatos()
    {
        $c = "select * from articulos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al leer un tag:" . $ex->getMessage());
        }
        $obj = $stmt->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function existeArticulo($nombre)
    {
        $c = "select * from articulos where nombre=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $nombre
            ]);
        } catch (PDOException $ex) {
            die("Error al comprobar existencia de articulos:" . $ex->getMessage());
        }
        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        return ($fila == null) ? false : true;
    }

    public function update()
    {
        $u = "update articulos set nombre=:n, pvp=:p, stock=:s where id=:i";
        $stmt = parent::$conexion->prepare($u);
        try {
            $stmt->execute([
                ':i' => $this->id,
                ':n' => $this->nombre,
                ':p' => $this->pvp,
                ':s' => $this->stock
            ]);
        } catch (PDOException $ex) {
            die("Error al editar un articulo:" . $ex->getMessage());
        }
    }
    //----------------------------------------
    //GETTER & SETTER
    

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of pvp
     */ 
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * Set the value of pvp
     *
     * @return  self
     */ 
    public function setPvp($pvp)
    {
        $this->pvp = $pvp;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}