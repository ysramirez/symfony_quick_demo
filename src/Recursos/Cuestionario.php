<?php

namespace App\Recursos;

class Cuestionario
{
    private $pregunta;
    private $oficina ;

    /**
     * @return mixed
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * @param mixed $pregunta
     */
    public function setPregunta($pregunta): void
    {
        $this->pregunta = $pregunta;
    }

    /**
     * @return mixed
     */
    public function getOficina()
    {
        return $this->oficina;
    }

    /**
     * @param mixed $oficina
     */
    public function setOficina($oficina): void
    {
        $this->oficina = $oficina;
    }

}