<?php

namespace App\Services;

class TaskService
{
    protected $task = []; 

    public function add($name)
    {
        $this->task[] = $name;
    }

    public function getAllTask()
    {
        return $this->task;
    }
}
