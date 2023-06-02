<?php

namespace App\Services;

class SaveToFile
{

    private $string;
    private $filename;

    /**
     * @param mixed $string
     */
    public function setString($string): void
    {
        $this->string = $string;
    }

    public function save()
    {
        $this->setFilename(time());
        file_put_contents(__DIR__.'/../../respuestas/'.$this->getFilename(), $this->string);
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = (string)$filename.'.txt';
    }
}