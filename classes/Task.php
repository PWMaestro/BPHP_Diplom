<?php

class Task extends DataRecordModel
{
    public $executor;
    public $client;
    public $deadline;
    public $langOriginal;
    public $langTarget;
    public $content = [];
    public $status;

    const STATUS_NEW = 1;
    const STATUS_DONE = 2;
    const STATUS_REJECTED = 3;
    const STATUE_RESOLVED = 4;

    public function addTaskFromForm()
    {
        $this->executor = $_POST['executor'];
        $this->client = $_POST['client'];
        $this->deadline = $_POST['deadline'];
        $this->langOriginal = $_POST['original'];
        $this->langTarget= $_POST['target'];
        $this->content['original'] = $_POST['original_text'];
        foreach ($this->langTarget as $lang) {
            $this->content[$lang] = $_POST[$lang] ?? '';
        }
    }

    public function addTaskFromDb()
    {
        $task = (new Tasks())->getTaskById($this->guid);
        $this->executor = $task->executor;
        $this->client = $task->client;
        $this->deadline = $task->deadline;
        $this->langOriginal = $task->langOriginal;
        $this->langTarget= $task->langTarget;
        $this->content = $task->content;
        $this->status = $task->status;
    }
}
