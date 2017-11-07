<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:38
 */

namespace DevelopersBundle;

use DevelopersBundle\Exceptions\InsuficientWorkException;
use DevelopersBundle\Exceptions\TooMuchWorkException;

/**
 * Class Developer
 *
 * @package DevelopersBundle
 */
class Developer implements DeveloperInterface
{

    /**
     *
     */
    const MAX_TASKS = 10;
    /**
     * @var string
     */
    private $name;
    /**
     * @var \SplQueue
     */
    private $tasks;

    /**
     * Developer constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name  = $name;
        $this->tasks = new \SplQueue();
    }

    /**
     * @param string $task
     * @return string
     * @throws TooMuchWorkException
     */
    public function add_task($task)
    {
        if (!$this->can_add_task()) {
            throw new TooMuchWorkException();
        }

        $this->tasks->enqueue($task);

        return sprintf('%s: Добавлена задача "%s" Всего в списке задач %d', $this->name, $task, $this->tasks->count());
    }

    /**
     *
     */
    public function work()
    {
        if (!$this->can_work()) {
            throw new InsuficientWorkException();
        }

        $task = $this->tasks->dequeue();

       return sprintf('%s: Выполнена задача "%s". Осталось задач %d', $this->name, $task, $this->tasks->count());
    }

    /**
     * @return string
     */
    public function status()
    {
        if (!$this->can_work()) {
            return self::WORK_STATE_FREE;
        }

        if (!$this->can_add_task()) {
            return self::WORK_STATE_BUSY;
        }

        return self::WORK_STATE_WORKING;
    }

    /**
     *
     */
    public function can_add_task()
    {
        return count($this->tasks) < self::MAX_TASKS;
    }

    /**
     * @return bool
     */
    public function can_work()
    {
        return count($this->tasks) > 0;
    }

    /**
     *
     */
    public function tasks()
    {
       foreach ($this->tasks as $key=>$value){
           printf("%d %s\n",$key,$value);
       }
    }
}