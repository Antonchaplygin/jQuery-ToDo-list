<?php

class Database {

    protected $db;

  public function __construct() {
    $this->mysqli = new mysqli("localhost", "root", "123", "2021");
  }
  public function prepare() {

  $res = $this->db->prepare();

    return $res;

      }

      public function query() {

      $result = $this->db->query();

        return $result;

          }
}

?>
