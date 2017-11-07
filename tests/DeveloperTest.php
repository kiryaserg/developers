<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:50
 */

use DevelopersBundle\Developer;

/**
 * Class DeveloperTest
 */
class DeveloperTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testDeveloperWithoutTasksCanNotWork()
    {
        $developer = new Developer('Test Name');

        $this->assertFalse($developer->can_work());
    }

    /**
     *
     */
    public function testDeveloperWithTasksCanWork()
    {
        $developer = new Developer('Test Name');
        $developer->add_task('1');
        $this->assertTrue($developer->can_work());
    }

    /**
     *
     */
    public function testDeveloperStatus()
    {
        $developer = new Developer('Test Name');

        $this->assertEquals('свободен', $developer->status());

        for($i=1;$i<10;$i++){
            $developer->add_task($i);
            $this->assertEquals('работаю', $developer->status());
        }

        $developer->add_task('last');

        $this->assertEquals('занят', $developer->status());
    }

    /**
     *
     */
    public function testDeveloperAddTaskThrowsException()
    {
        $this->expectExceptionMessage('Слишком много работы!');
        $developer = new Developer('Test Name');

        for($i=1;$i<=11;$i++){
            $developer->add_task($i);
        }
    }

    /**
     *
     */
    public function testAddTaskReturnsText()
    {
        $name = 'Test Name';
        $task = 'Task';
        $developer = new Developer($name);

        $this->assertEquals(sprintf('%s: Добавлена задача "%s" Всего в списке задач 1', $name, $task),  $developer->add_task($task));
        $this->assertEquals(sprintf('%s: Добавлена задача "%s" Всего в списке задач 2', $name, $task),  $developer->add_task($task));

    }

    /**
     *
     */
    public function testMethodTasksPrintsText()
    {
        $developer = new Developer('Test Name');

        $developer->add_task('Task 1');
        $developer->add_task('Task 2');

        ob_start();
        $developer->tasks();
        $result = ob_get_clean();
        $this->assertEquals("0 Task 1\n1 Task 2\n", $result);

    }

    /**
     *
     */
    public function testWorkThrowsException()
    {
        $this->expectExceptionMessage('Нечего делать!');
        $developer = new Developer('Test Name');
        $developer->work();
    }

    /**
     *
     */
    public function testWorkMethod()
    {
        $name = 'Test Name';
        $task1 = 'Task 1';
        $task2 = 'Task 2';
        $developer = new Developer($name);
        $developer->add_task('Task 1');
        $developer->add_task('Task 2');

        $this->assertEquals(sprintf('%s: Выполнена задача "%s". Осталось задач 1', $name, $task1), $developer->work());
        $this->assertEquals(sprintf('%s: Выполнена задача "%s". Осталось задач 0', $name, $task2), $developer->work());
    }

    /**
     *
     */
    public function testCanAddTask()
    {
        $developer = new Developer('Test Name');

        for($i=1;$i<=10;$i++){
            $this->assertTrue( $developer->can_add_task(), 'We can add tasks');
            $developer->add_task($i);
        }

        $this->assertFalse( $developer->can_add_task(), 'We reached maximum');

    }
}
