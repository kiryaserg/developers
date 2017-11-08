<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:59
 */

namespace DevelopersBundle;

use DevelopersBundle\Exceptions\DeveloperException;

interface DeveloperInterface
{

    /**
     *
     */
    const WORK_STATE_BUSY = 'занят';
    /**
     *
     */
    const WORK_STATE_WORKING = 'работаю';

    /**
     *
     */
    const WORK_STATE_FREE =  'свободен';

    /**
     * @param string $task
     * @throws DeveloperException
     * @return string
     */
    public function add_task($task);

    /**
     * @return string
     * @throws DeveloperException
     */
    public function work();

    /**
     * @return string
     */
    public function status();

    /**
     * @return boolean
     */
    public function can_add_task();

    /**
     * @return boolean
     */
    public function can_work();

    /**
     * @return mixed
     */
    public function tasks();

    /**
     * @return int
     */
    public function count_tasks();

    /**
     * @return string
     */
    public function type();

    /**
     * @return string
     */
    public function name();

}