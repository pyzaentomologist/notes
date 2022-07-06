<?php
declare(strict_types=1);

namespace App;


use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;
use App\Exception\StorageException;
use PDO;
use PDOException;
use Throwable;

class Database
{
  private PDO $conn;

  public function __construct(array $config)
  {
   try {
     $this->validateConfig($config);
     $this->createConnection($config);
     
   } catch(PDOException $e){
      throw new StorageException('Connection error');
   }
  }

  public function getNote(int $id): array
  {
    try{
      $query = "SELECT * FROM notes WHERE id = $id";
      $result = $this->conn->query($query);
      $note = $result->fetch(PDO::FETCH_ASSOC); 
    } catch(Throwable $e){
      dump($e);
      throw new StorageException('Nie udało się pobrać notatki', 400, $e);
    }

    if(!$note){
      throw new NotFoundException("Notatka o id: $id nie istnieje");
    }

    return $note;
  }

  public function getNotes(): array
  {
    try{
      $notes = [];

      $query = "SELECT id, title, created FROM notes";
  
      // $result = $this->conn->query($query, PDO::FETCH_ASSOC);
      $result = $this->conn->query($query);
      $notes = $result->fetchAll(PDO::FETCH_ASSOC);
      // foreach($result as $row){
      //   $notes = $row;
      // }
      return $notes;
    
    } catch(Throwable $e){
      throw new StorageException('Nie udało się pobrać danych o notatkach', 400, $e);
    }
    }

  public function createNote(array $data): void
  {
    try{
      $title = $this->conn->quote($data['title']);
      $description = $this->conn->quote($data['description']);
      $created = $this->conn->quote(date('Y-m-d H:i:s'));

      $query = "INSERT INTO notes(title, description, created) 
      VALUES($title, $description, $created)";
      $this->conn->exec($query);

    } catch(Throwable $e){
      throw new StorageException('Nie udało się utworzyć notatki', 400);
    }


  }

  private function createConnection(array $config):void
  {
    $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
   
    $this->conn = new PDO(
     $dsn, 
     $config['user'],
     $config['password'],
     [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]
    );
  }

  private function validateConfig(array $config): void
  {
    if(
      empty($config['database'])
      ||empty($config['host'])
      ||empty($config['user'])
      ||empty($config['password'])
    ){
      throw new ConfigurationException('Storage configuration error');
    }
  }

}