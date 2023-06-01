<?php

namespace App\Services;

class PasswordGenerator
{
    private string $sourceString;

    /**
     * @param string $sourceString
     */
    public function __construct()
    {
        $this->sourceString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_';
    }

    public function generatePassword($length = 8) {

        $password = '';
        $max = strlen($this->sourceString) - 1;

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $max);
            $password .= $this->sourceString[$randomIndex];
        }

        return $password;
    }
}