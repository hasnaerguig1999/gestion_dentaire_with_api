<?php


  class DB{
      protected $db;
      public function connect(){
          $database=new PDO("mysql:host=localhost;dbname=visa","root","");
          if($database){
              $this->db=$database;
              return $this->db;
          }return 0;
      }
  }