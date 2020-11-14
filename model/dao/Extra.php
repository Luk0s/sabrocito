<?php

namespace model\dao;
use PDO, PDOException;

class Extra extends Bd
{
    public static function nuevo(\model\Extra $extra){
        try{
            $sql = "INSERT INTO extra (descripcion, precio, visible) VALUES(:descripcion, :precio, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $extra->getDescripcion(),
                ':precio' => $extra->getPrecio()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Extra $extra){
        try{
            $sql = "UPDATE extra SET descripcion = :descripcion, precio = :precio WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $extra->getDescripcion(),
                ':precio' => $extra->getPrecio(),
                ':id' => $extra->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE extra SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Extra[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM extra WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Extra');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Extra */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM extra WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Extra');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Extra: </strong>', descripcion) as descripcion FROM extra;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}