<?php

namespace model\dao;
use PDO, PDOException;

class Venta extends Bd
{
    public static function nueva(\model\Venta $venta){
        try{
            $sql = "INSERT INTO venta (venta_at, total, pago_tipo_id, rapida, estado_id) VALUES(NOW(), :total, :pago_tipo_id, :rapida, 1);";
            $conn = self::conexion();
            $sth = $conn->prepare($sql);
            $sth->execute([
                ':total' => $venta->getTotal(),
                ':pago_tipo_id' => $venta->getPagoTipoId(),
                ':rapida' => $venta->getRapida()
            ]);
            $id = $conn->lastInsertId();
            foreach ($venta->getDetalle() as $item) {
                self::nuevoDetalle($id, $item);
            }
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function terminar($id){
        try{
            $sql = "UPDATE venta SET estado_id = 5, terminada_at = NOW() WHERE id = :id;";
            $conn = self::conexion();
            $sth = $conn->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function anular($id){
        try{
            $sql = "UPDATE venta SET estado_id = 3 WHERE id = :id;";
            $conn = self::conexion();
            $sth = $conn->prepare($sql);
            $sth->execute([ ':id' => $id ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function nuevoDetalle($venta_id, $detalle){
        try{
            $sql = "INSERT INTO venta_detalle (venta_id, tipo, producto_id, precio, comentario) VALUES(:venta_id, :tipo, :producto_id, :precio, :comentario);";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':venta_id' => $venta_id,
                ':tipo' => $detalle['tipo'],
                ':producto_id' => $detalle['id'],
                ':precio' => $detalle['precio'],
                ':comentario' => $detalle['comentario']
            ]);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    /** @return \model\Venta[] */
    public static function obtenerVentas($dia, $rapido = 0, $estado = [1,5]){
        try{
            $estado = implode(',', $estado);
            $sql = "SELECT v.id, v.venta_at, v.total, v.pago_tipo_id, pt.descripcion AS pago_tipo,
                pe.descripcion AS estado, v.estado_id, TIMESTAMPDIFF(MINUTE, v.venta_at, v.terminada_at) AS espera
                FROM venta_detalle AS vd
                INNER JOIN venta AS v ON vd.venta_id = v.id
                INNER JOIN pago_tipo AS pt ON v.pago_tipo_id = pt.id
                INNER JOIN pedido_estado AS pe ON pe.id = v.estado_id
                WHERE DATE(v.venta_at) = :dia AND v.rapida = :rapido AND v.estado_id IN({$estado})
                GROUP BY v.id, v.venta_at, v.pago_tipo_id ORDER BY v.venta_at;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([
                ':dia' => $dia,
                ':rapido' => $rapido
            ]);
            $ventas = $sth->fetchAll(PDO::FETCH_CLASS, '\model\Venta');
            foreach ($ventas as $venta) {
                $venta->setDetalle(self::obtenerDetalleLite($venta->getId()));
            }
            return $ventas;
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }

    public static function obtenerDetalleLite($venta_id){
        try{
            $sql = "SELECT tipo, producto_id, comentario FROM venta_detalle WHERE venta_id = :venta_id;";
            $sth = self::conexion()->prepare($sql);
            $sth->execute([ ':venta_id' => $venta_id ]);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            var_dump($e);
            die();
        }
    }
}