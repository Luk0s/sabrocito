<?php

namespace model;

class Cena
{
    private int $id = 0, $precio_2, $precio_3, $visible;
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
    public function getPrecio2(): int
    {
        return $this->precio_2;
    }

    /**
     * @param string $precio_3
     */
    public function setPrecio2(int $precio_2): void
    {
        $this->precio_2 = $precio_2;
    }

    /**
     * @return int
     */
    public function getPrecio3(): int
    {
        return $this->precio_3;
    }

    /**
     * @param string $precio_3
     */
    public function setPrecio3(int $precio_3): void
    {
        $this->precio_3 = $precio_3;
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