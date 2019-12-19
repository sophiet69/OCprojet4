<?php

namespace OpenClassrooms\Blog\Soso;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog-ecrivain;charset=utf8', 'root', '');
        // Activation des erreurs PDO
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}

