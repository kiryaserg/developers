<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:50
 */

use DevelopersBundle\Team;

/**
 * Class DeveloperTest
 */
class TeamTest extends \PHPUnit_Framework_TestCase
{
    public function testAddTaskIsSetByPriority()
    {
          $team = new Team();
          foreach($team->juniors() as $dev ){
              $team->add_task('hello');
          };
          
          foreach($team->juniors() as $junior ){
              $this->assertEquals(1, $junior->count_tasks(), 'At first add tasks to juniors');
          };
          
          foreach(array_merge($team->developers(),$team->seniors()) as $developer ){
              $this->assertEquals(0, $developer->count_tasks(), 'Other developers do not have tasks');
          };
          
          foreach($team->developers() as $dev ){
              $team->add_task('hello');
          };
          
          foreach($team->developers() as $developer ){
              $this->assertEquals(1, $developer->count_tasks(), 'When juniors are busy add tasks to developers');
          };
          
           foreach($team->seniors() as $developer ){
              $this->assertEquals(0, $developer->count_tasks(), 'Seniors do not have tasks');
          };
          
          foreach($team->seniors() as $dev ){
              $team->add_task('hello');
          }
          
          foreach($team->seniors() as $senior){
              $this->assertEquals(1, $senior->count_tasks(), "Finaly add tasks to seniors" );
          };

          foreach($team->juniors() as $dev ){
              $team->add_task('hello');
          }
          
          foreach($team->juniors() as $junior ){
              $this->assertEquals(2, $junior->count_tasks(),'Once all busy add tasks to juniors');
          };
          
          foreach(array_merge($team->developers(),$team->seniors()) as $developer ){
              $this->assertEquals(1, $developer->count_tasks(), 'Other developers have only 1 task each');
          };
    }
    
    public function testAddTaskToCertainDeveloper(){
        
        $team = new Team();
        
        $team->add_task('test', null, 'Олег');
        $team->add_task('test', null, 'Олег');
        
        foreach ($team->seniors() as $developer) {
            if($developer->name() === 'Олег'){
                 $this->assertEquals(2, $developer->count_tasks());
            }
        }
    }
    
    public function testAddTaskByComplexity(){
        $type =  'junior';
        $team = new Team();
        foreach(array_merge($team->juniors(), $team->juniors()) as $dev ){
              $team->add_task('hello',  'junior');
        }
        
        foreach($team->juniors() as $junior ){
           $this->assertEquals(2, $junior->count_tasks(), 'All tasks to type');
       };
    }
    
    public function testWhenAddTasksByComplexityAndDeveloper(){
        $type =  'junior';
        $team = new Team();
        foreach(array_merge($team->juniors(), $team->juniors()) as $dev ){
              $team->add_task('hello',  'junior');
        }
        
        foreach($team->juniors() as $junior ){
           $this->assertEquals(2, $junior->count_tasks(), 'All tasks to type');
       };
    }
}
