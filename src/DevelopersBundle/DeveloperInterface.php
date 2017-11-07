<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 16:59
 */

namespace DevelopersBundle;

use DevelopersBundle\Exceptions\InsuficientWorkException;
use DevelopersBundle\Exceptions\TooMuchWorkException;

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
     * @throws TooMuchWorkException
     * @return string
     */
    public function add_task($task);

    /**
     * @return string
     * @throws InsuficientWorkException
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

}