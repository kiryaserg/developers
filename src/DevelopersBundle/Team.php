<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevelopersBundle;

/**
 * Description of Team
 *
 * @author kiryaserg
 */
class Team {

    private $seniors;
    private $developers;
    private $juniors;
    private $priority = ['junior', 'developer', 'senior'];

    public function __construct() {
        $this->seniors = [new Senior('Олег'), new Senior('Оксана')];
        $this->developers = [new Developer('Олеся'), new Developer('Василий'), new Developer('Оля')];
        $this->juniors = [new Junior('Владислава'), new Junior('Аркадий'), new Junior('Игорь')];
        $this->team = array_merge($this->juniors, $this->developers, $this->seniors);
        $this->complexities = ['junior' => $this->juniors, 'developer' => $this->developers, 'senior' => $this->seniors];
    }

    /**
     * 
     * @param type $task
     * @param type $complexity
     * @param type $to
     * @return type
     */
    public function add_task($task, $complexity = null, $to = null) {

        if ($to) {
            $this->find_first_by_name($to)->add_task($task);
            
            return;
        }
        
        if ($complexity) {
            $this->find_first_by_complexity($complexity)->add_task($task);
            
            return;
        }

        usort($this->team, [$this, 'sort']);
        $this->team[0]->add_task($task);
    }

    public function report() {
        usort($this->team, [$this, 'sort']);

        foreach ($this->team as $developer) {
            printf("%s (%s) ", $developer->name(), $developer->type());
            $developer->tasks();
        }
    }

    public function seniors() {
        return $this->seniors;
    }

    public function developers() {
        return $this->developers;
    }

    public function juniors() {
        return $this->juniors;
    }

    private function find_first_by_name($name) {
        foreach ($this->team as $developer) {
            if ($name === $developer->name()) {
                return $developer;
            }
        }
    }
    
    private function find_first_by_complexity($complexity) {
        usort($this->complexities[$complexity], [$this, 'sort']);
        
        return $this->complexities[$complexity][0];
    }


    private function sort($a, $b) {
        if ($a->count_tasks() > $b->count_tasks()) {
            return 1;
        } elseif ($a->count_tasks() < $b->count_tasks()) {
            return -1;
        } elseif ($this->priority($a) < $this->priority($b)) {
            return -1;
        } elseif ($this->priority($a) > $this->priority($b)) {
            return 1;
        }

        return 0;
    }

    private function priority($developer) {
        return array_search($developer->type(), $this->priority);
    }

}
