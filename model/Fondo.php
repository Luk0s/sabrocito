<?php

namespace model;

class Fondo
{
    private int $id = 0, $precio, $visible;
    private string $descripcion;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPrecio(): int
    {
        return $this->precio;
    }

    /**
     * @param string $precio
     */
    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return int
     */
    public function getVisible(): int
    {
        return $this->visible;
    }

    /**
     * @param int $visible
     */
    public function setVisible(int $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }
}