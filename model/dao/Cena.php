<?php

namespace model\dao;
use PDO, PDOException;

class Cena extends Bd
{
    public static function nuevo(\model\Cena $cena){
        try{
            $sql = "INSERT INTO cena (descripcion, precio_2, precio_3, visible) VALUES(:descripcion, :precio_2, :precio_3, 1);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $cena->getDescripcion(),
                ':precio_2' => $cena->getPrecio2(),
                ':precio_3' => $cena->getPrecio3(),
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function editar(\model\Cena $cena){
        try{
            $sql = "UPDATE cena SET descripcion = :descripcion, precio_2 = :precio_2, precio_3 = :precio_3 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':descripcion' => $cena->getDescripcion(),
                ':precio_2' => $cena->getPrecio2(),
                ':precio_3' => $cena->getPrecio3(),
                ':id' => $cena->getId()
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function eliminar($id){
        try{
            $sql = "UPDATE cena SET visible = 0 WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Cena[] */
    public static function obtenerTodos(){
        try{
            $sql = "SELECT * FROM cena WHERE visible = 1;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_CLASS, '\model\Cena');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Cena */
    public static function obtener($id){
        try{
            $sql = "SELECT * FROM cena WHERE id = :id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':id' => $id ]);
            return $sth->fetchObject('\model\Cena');
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerLite(){
        try{
            $sql = "SELECT id, CONCAT('<strong>Cena: </strong>', descripcion) as descripcion FROM cena;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}