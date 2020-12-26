<?php

namespace App\Model;


/**
 * Data:
 * 1. title
 * 2. description
 * 3. textTop
 * 4. textBottom
 */
class About extends Model
{
  //table name
  private string $table = 'about';

  public $path = 'C:/xampp/htdocs/*website-name*/*images-folder*/';

  protected ?string $title;
  protected ?string $description;
  protected ?string $textTop;
  protected ?string $textBottom;

  function __construct()
  {
    parent::__construct();
  }

  /**
   * Update table row.
   * @return bool 
   * If query has been executed successfully return TRUE|FALSE;
   */
  function store(array $data): void
  {
    self::setState("INSERT INTO {$this->table} SET title = :title, description = :description");

    $this->bindParameters($data);

    $this->doQuery();
  }

  /**
   * @EDIT
   * Show table row.
   * @return void
   * If query has been executed successfully return 
   */
  function show(int $id): void
  {
    self::setState("SELECT * FROM {$this->table} WHERE id = :id limit 1");

    $this->bindParameters([
      'id' => $id ?? null,
    ]);

    $this->doQuery() ? $this->fetchRow() : exit;

    // $this->title = $this->row['title'];
    // $this->desc  = $this->row['description'];
  }

  /**
   * Update table row.
   * @return bool 
   * If query has been executed successfully return TRUE|FALSE.
   */
  function update(array $data): void
  {
    self::setState("UPDATE {$this->table} SET title = :title, description = :description WHERE id = :id");

    $this->bindParameters($data);

    $this->doQuery();
  }
}
