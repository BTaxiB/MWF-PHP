<?php

namespace App\Config;

require_once "config.php";

class Database extends \PDO
{

    

    public function __construct()
    {

        try {
            parent::__construct(DBTYPE . ':host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPASS);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $custom_errormsg = 'Error occurred while trying to connect to database - <u>check your database config file!</u>';
            echo "<br>\n <div style ='color:red'><strong>" . $custom_errormsg . "</strong></div><br>\n<br>\n " . $e->getMessage();
            echo "<br>\nPHP Version : " . phpversion() . "<br>\n";
        }
    }

    /** TODO Vrati mi instancu ove klase pozivom staticne metode */
    public static function serve(): Database
    {
        return new static;
    }
}
