<?php
use PHPUnit\Framework\TestCase;
use Dao\MeasureDao;
use Domain\Measure;

include '../Inc/autoload.inc';

class MeasureDaoTest2 extends TestCase {
    protected function setUp() {
        
        parent::setUp();
        
        $config = include '../Inc/config.inc';
        
        $this->measureDao = new MeasureDao($config);
    }
    
    
    
    public function testFindAll() {
        
        $users = $this->measureDao->findAllUsers();
        
        $this->assertEquals(1, count($users));
        
        $this->assertEquals(null, $users[0]->temperature);
        
        $this->assertEquals(null, $users[0]->humidity);
        
        $this->assertEquals("2018-02-15", $users[0]->datetime);
        
        $this->assertEquals(null, $users[1]->temperature);
        
        $this->assertEquals(null, $users[1]->humidity);
        
        $this->assertEquals(null, $users[1]->datetime);
    }
    
    public function testFindById() {
        
        $test = $this->measureDao->findUserById(1);
              
        $this->assertEquals("11", $test->temperature);
        
        $this->assertEquals("30", $test->humidity);
        
        $this->assertEquals("2018-02-15", $test->datetime);
    }
    
    public function testInsert() {
        
        $test = new Measure(null,"11", "40", "2018-02-15");
        
        $id = $this->measureDao->insert($test);
        
        $newUser = $this->measureDao->findUserById($id);
        
        $this->assertEquals(null, $newUser->temperature);
        
        $this->assertEquals(null, $newUser->humidity);
        
        $this->assertEquals(null, $newUser->datetime);
        
        $this->measureDao->delete($id);
    }
    
    public function testDelete() {
        
        $test = new Measure(null, "11", "30", "2018-02-15");
        
        $id = $this->measureDao->insert($test);
        
        $newUser = $this->measureDao->findUserById($id);
        
        $this->assertNull($newUser);
        $this->measureDao->delete($id);
        
        $deleted = $this->measureDao->findUserById($id);
        
        $this->assertNull($deleted);
    }
    
    public function testUpdate() {
        
        $test = new Measure(null, "11", "30", "2018-02-15");
        
        $id = $this->measureDao->insert($test);
        
        $newUser = $this->measureDao->findUserById($id);
        
        $newUser->temperature = "12";
        
        $newUser->humidity = "35";
        
        $newUser->datetime = "2018-02-14";
        
        $this->measureDao->update($newUser);
        
        $update = $this->measureDao->findUserById($id);
        
        $this->assertEquals("12", $update->temperature);
        
        $this->assertEquals("35", $update->humidity);
        
        $this->assertEquals("2018-02-14", $update->datetime);
        
        $this->measureDao->delete($id);
    }

}
