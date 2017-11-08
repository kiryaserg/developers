<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:50
 */

use DevelopersBundle\Junior;

/**
 * Class DeveloperTest
 */
class JuniorDeveloperTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testAddTaskThrowsException()
    {
        $this->expectExceptionMessage('Слишком сложно!');
        $developer = new Junior('Test Name');
        $developer->add_task(str_repeat('1',21));
    }
    
    /**
     *
     */
    public function testMaximumTasks()
    {
        $developer = new Junior('Test Name');
        $task = str_repeat('1',20);
        for($i=1;$i<5;$i++){
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
        $developer = new Junior($name);
        $developer->add_task('Task 1');
        $developer->add_task('Task 2');

        $this->assertEquals(sprintf('%s: Пытаюсь сделать задачу "%s". Осталось задач 1', $name, $task1), $developer->work());
        $this->assertEquals(sprintf('%s: Пытаюсь сделать задачу "%s". Осталось задач 0', $name, $task2), $developer->work());
    }
}