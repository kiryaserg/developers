<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:50
 */

use DevelopersBundle\Senior;

/**
 * Class DeveloperTest
 */
class SeniorDeveloperTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testMaximumTasks()
    {
        $developer = new Senior('Test Name');
        $task = str_repeat('1',200);
        for($i=1;$i<15;$i++){
             $developer->add_task($task);
             $this->assertEquals('работаю', $developer->status());
        }
        
        $developer->add_task('last');

        $this->assertEquals('занят', $developer->status());
    }
    
    /**
     *
     */
   public function testWorkMethod()
    {
        $name = 'Test Name';
        $task1 = 'Task 1';
        $task2 = 'Task 2';
        $developer = new Senior($name);
        $developer->add_task('Task 1');
        $developer->add_task('Task 2');
        $work = sprintf("%s: Выполнена задача \"%s\". Осталось задач 1\n%s: Выполнена задача \"%s\". Осталось задач 0", $name, $task1, $name, $task2);
        $procrastination = 'Что то лень';
        
        $possibilities = [
            $work => $work,
            $procrastination => $procrastination,    
        ];
        
        $result = $developer->work();
        
        $this->assertTrue(isset($possibilities[$result]), $result);
    }
    
    /**
     *
     */
   public function testWorkMethodDoesNotThrowExceptionWhenThereIsOnlyOneTask()
    {
        $name = 'Test Name';
        $task1 = 'Task 1';
        $developer = new Senior($name);
        $developer->add_task('Task 1');
        $work = sprintf("%s: Выполнена задача \"%s\". Осталось задач 0", $name, $task1);
        $procrastination = 'Что то лень';
        
        $possibilities = [
            $work => $work,
            $procrastination => $procrastination,    
        ];
        
        $result = $developer->work();
        
        $this->assertTrue(isset($possibilities[$result]), $result);
    }
}
