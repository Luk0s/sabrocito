<?php

namespace model\dao;
use PDO, PDOException;

class Agregado extends Bd
{
    public static function nuevo(\model\Agregado $agregado){
        try{
            $sql = "INSERT INTO agregado (descripcion, visible) VALUES(:descripcion, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':descripcion' => $agregado->getDescripcion() ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Agregado $agregado){
        try{
            $sql = "UPDATE agregado SET descripcion = :descripcion WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $agregado->getDescripcion(),
                ':id' => $agregado->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE agregado SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Agregado[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM agregado WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Agregado');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Agregado */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM agregado WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Agregado');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Agregado: </strong>', descripcion) as descripcion FROM agregado;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}