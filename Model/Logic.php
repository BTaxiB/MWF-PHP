<?php

namespace App\Model;

use App\Config\Database;
use PDOStatement;

class Logic
{

    /**
     * Prepared SQL statement.
     */
    protected static PDOStatement $prep_state;

    /**
     * Database connection.
     */
    protected static $db_conn;

    protected function __construct(): void
    {
        $this->db_conn = Database::serve();
    }

    /**
     * Get static connection.
     */
    protected static function getDB()
    {
        return self::$db_conn;
    }

    /**
     * Close static connection.
     */
    protected function disconnect(): void
    {
        self::$db_conn = null;
    }

    protected static function setState(string $sql): void
    {
        self::$prep_state = self::getDB()->prepare($sql);
    }

    protected static function getState(): PDOStatement
    {
        return self::$prep_state;
    }

    protected function bindParameters(array $data): Logic
    {
        foreach ($data as $key => $value) {
            self::getState()->bindParam(":$key", $value);
        }

        return $this;
    }

    protected function doQuery(): bool
    {
        return (self::getState()->execute()) ? true : false;
    }

    protected function setRow($fetch): void
    {
        $this->row = $fetch;
    }

    protected function getRow()
    {
        return $this->row;
    }

    protected function fetchRow(): void
    {
        $this->setRow(self::getState()->fetch(\PDO::FETCH_ASSOC));
    }
}
