<?php
namespace Services;

class MeasureService {
    public function __construct() {
        
    }
    
    public function isValid($test) {
        
        $result = [];
        
        if ($test->temperature == '') {
            
            $result['measure.temperature'] = "Temperature is required";
        }
        
        if ($test->humidity == '') {
            
            $result['measure.humidity'] = "Humidity is required";
        }
        
        if ($test->datetime == '') {
            
            $result['measure.datetime'] = "Datetime is required";
        }
        
        return $result;
    }
    
}

