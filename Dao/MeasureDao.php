<?php
namespace Dao;

use Domain\Measure;


class MeasureDao extends DaoBase {
    public function __construct($config) {
        parent::__construct($config);
    }
    
    
    
    public function findAllUsers() {
        
        $result = [];
        
        $reponse = $this->bdd->query("SELECT id, temperature, humidity, datetime FROM temp_hum order by id");
        
        while ($donnees = $reponse->fetch()) {
            
            $user_id = $donnees["id"];
            $user_name = $donnees["temperature"];
            $user_mdp = $donnees["humidity"];
            $datetime = $donnees["datetime"];
            
            $test = new Measure($id, $temperature, $humidity, $datetime);
            
            $result[] = $test;
        }
        
        return $result;
    }
    
    public function findUserById($id) {
        
        $result = NULL;
        
        $query = $this->bdd->prepare("SELECT id, temperature, humidity, datetime FROM temp_hum where id = :id");
        
        $query->bindParam(":id", $id);
        
        if ($query->execute()) {
            
            if ($donnees = $query->fetch()) {
                
                $id = $donnees["id"];
                $temperature = $donnees["temperature"];
                $humidity = $donnees["humidity"];
                $datetime = $donnees["datetime"];
                
                $result = new Measure($id, $temperature, $humidity, $datetime);
            }
        }
        return $result;
    }
    
    
    public function insert($test) {
        
        $result;
        
        $query = $this->bdd->prepare("INSERT INTO temp_hum (temperature, humidity, datetime) VALUES (:temperature, :humidity, :datetime)");
        
        $query->bindParam(":temperature", $test->temperature);
        $query->bindParam(":humidity", $test->humidity);
        $query->bindParam(":datetime", $test->datetime);
        
        $query->execute();
        
        $id = $this->bdd->lastInsertId();
        
        $test->id = $id;
        
        return $id;
    }
    
    public function delete($id) {
        
        $query = $this->bdd->prepare("DELETE FROM temp_hum WHERE id = :id");
        
        $query->bindParam(":id", $id);
        
        $query->execute();
    }
    
    public function update($test) {
        
        $result;
        
        $query = $this->bdd->prepare("UPDATE temp_hum SET temperature = :temperature, humidity = :humidity, datetime = :datetime WHERE id = :id");
        
        $query->bindParam(":temperature", $test->temperature);
        $query->bindParam(":humidity", $test->humidity);
        $query->bindParam(":datetime", $test->datetime);
        $query->bindParam(":id", $test->id);
        
        $query->execute();
    }
}
