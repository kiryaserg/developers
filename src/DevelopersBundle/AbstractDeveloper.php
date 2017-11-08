<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:38
 */

namespace DevelopersBundle;

use DevelopersBundle\Exceptions\DeveloperException;
use DevelopersBundle\Exceptions\InsuficientWorkException;
use DevelopersBundle\Exceptions\TooMuchWorkException;

/**
 * Class Developer
 *
 * @package DevelopersBundle
 */
abstract class AbstractDeveloper implements DeveloperInterface
{
    /**
     *
     */
    const WORK_MESSAGE_TEMPLATE = '%s: Выполнена задача "%s". Осталось задач %d';
    /**
     * @var string
     */
    protected $name;
    /**
     * @var \SplQueue
     */
    protected $tasks;

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
     * @throws DeveloperException
     */
    public function add_task($task)
    {
        if (!$this->can_add_task()) {
            throw new DeveloperException('Слишком много работы!');
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
            throw new DeveloperException('Нечего делать!');
        }

        $task = $this->tasks->dequeue();

       return sprintf(static::WORK_MESSAGE_TEMPLATE, $this->name, $task, $this->tasks->count());
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
        return count($this->tasks) < static::MAX_TASKS;
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
       foreach ($this->tasks as $key => $value){
           printf("%d %s\n", $key, $value);
       }
    }

    /**
     * @return int
     */
    public function count_tasks()
    {
        return count($this->tasks);
    }

    /**
     * @return string
     */
    public function type(){
        return static::TYPE;
    }

    /**
     * @return string
     */
    public function name(){
        return $this->name;
    }
    
}