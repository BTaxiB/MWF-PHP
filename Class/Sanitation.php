<?php

namespace App\Tools;

class Sanitation
{
    /**
     * Removing unnecessary characters from string.
     */
    static function validInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
