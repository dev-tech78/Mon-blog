<?php

namespace Models;

//use Database;

//require_once('libraries/datbase.php');
 abstract class Model 
{
     protected $pdo;

     protected $table;

    public function __construct()
    {
       $this->pdo = \Database::getPdo();
    }

    /**
 * Retourné la liste des articles  classée par date de création.
 *
 * @return array
 */
public function findAll(?string  $order = "") : array
{
  
   
    $sql  = "SELECT * FROM {$this->table} ";
    if($order) {
        $sql .= " ORDER BY " . $order;
    }
    
    $resultats = $this->pdo->query($sql);
    // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
    return $articles;
}

/**
 * Undocumented function
 *
 * @param integer $id
 * @return array
 */
    public function findByOne(int $id) : array
{

  
    $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
    $query->execute(['id' => $id]);
    $item = $query->fetch();

    return  $item;

}

/**
 * Undocumented function
 *
 * @param integer $id
 * @return void
 */
public function Delete(int $id): void
{
  
    $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
    $query->execute(['id' => $id]);
}

}