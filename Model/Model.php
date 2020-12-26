<?php

namespace App\Model;


class Model extends Logic
{
    /**
     * Table row.
     */
    protected $row;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get table.
     * @return bool 
     * If query has been executed successfully return TRUE|FALSE;
     */
    function get()
    {
        self::setState("SELECT * FROM  {$this->table} ORDER BY id ASC");

        self::getState()->execute();

        $this->disconnect();

        $this->getState();
    }

    /**
     * Delete table row.
     * @return bool 
     * If query has been executed successfully return TRUE|FALSE.
     */
    function delete(int $id)
    {
        self::setState("DELETE FROM {$this->table} WHERE id = :id limit 1");

        $this->bindParameters([
            'id' => $id ?? null
        ]);

        $this->doQuery();
    }

    /**
     * Count table rows.
     * @return int 
     * If query has been executed successfully return number of rows in table.
     */
    function countAll(): int
    {
        self::setState("SELECT id FROM {$this->table}");
        self::getState()->execute();

        return self::getState()->rowCount();
    }
}
