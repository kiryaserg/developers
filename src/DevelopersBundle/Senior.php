<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevelopersBundle;

/**
 * Description of Senior
 *
 * @author kiryaserg
 */
class Senior extends AbstractDeveloper {

    /**
     *
     */
    const TYPE = 'senior';
    /**
     *
     */
    const MAX_TASKS = 15;
    
    /**
     *
     */
    public function work()
    {
        if(rand(0,1)){
            return sprintf("%s%s", parent::work(),$this->can_work()?("\n".parent::work()):'');
        }
        
        return 'Что то лень';
    }
}
