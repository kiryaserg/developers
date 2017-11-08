<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevelopersBundle;

/**
 * Description of Junior
 *
 * @author kiryaserg
 */
class Junior extends AbstractDeveloper{
    const TYPE = 'junior';
    const MAX_TASKS = 5;
    const MAX_TASK_LENGTH = 20;
    const WORK_MESSAGE_TEMPLATE = '%s: Пытаюсь сделать задачу "%s". Осталось задач %d';
    
    public function add_task($task) {
        if (strlen($task) > self::MAX_TASK_LENGTH) {
            throw new Exceptions\DeveloperException('Слишком сложно!');
        }
        
        parent::add_task($task);
    }
}
