<?php
namespace Domain;

class Measure
{
    public $id;
    
    public $temperature;
    
    public $humidity;
    
    public $datetime;
    
    public function __construct($id, $temperature, $humidity, $datetime) {
        
        $this->id = $id;
        
        $this->temperature = $temperature;
        
        $this->humidity = $humidity;
        
        $this->datetime = $datetime;
        
    }
}

