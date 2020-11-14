<?php

namespace model;

class Venta
{
    private int $id, $pago_tipo_id, $total, $rapida, $estado_id;
    private string $venta_at, $terminada_at;

    /**
     * @return string
     */
    public function getTerminadaAt(): string
    {
        return $this->terminada_at;
    }

    /**
     * @param string $terminada_at
     */
    public function setTerminadaAt(string $terminada_at): void
    {
        $this->terminada_at = $terminada_at;
    }
    private array $detalle;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPagoTipoId(): int
    {
        return $this->pago_tipo_id;
    }

    /**
     * @param int $pago_tipo_id
     */
    public function setPagoTipoId(int $pago_tipo_id): void
    {
        $this->pago_tipo_id = $pago_tipo_id;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getVentaAt(): string
    {
        return $this->venta_at;
    }

    /**
     * @param string $venta_at
     */
    public function setVentaAt(string $venta_at): void
    {
        $this->venta_at = $venta_at;
    }

    /**
     * @return array
     */
    public function getDetalle(): array
    {
        return $this->detalle;
    }

    /**
     * @param array $detalle
     */
    public function setDetalle(array $detalle): void
    {
        $this->detalle = $detalle;
    }

    /**
     * @return int
     */
    public function getRapida(): int
    {
        return $this->rapida;
    }

    /**
     * @param int $rapida
     */
    public function setRapida(int $rapida): void
    {
        $this->rapida = $rapida;
    }

    /**
     * @return int
     */
    public function getEstadoId(): int
    {
        return $this->estado_id;
    }

    /**
     * @param int $estado
     */
    public function setEstadoId(int $estado): void
    {
        $this->estado_id = $estado;
    }

}