<?php

class PageEdit extends PageNew
{
    private $executorsList;
    private $task;
    private $taskId;
    private $langList;
    private $access;

    public function __construct()
    {
        parent::__construct();
        Authorization::init()->restrictAccessRights(true)
            ? $this->access = true
            : $this->access = false;
    }

    public function loadTask($id)
    {
        $this->taskId = $id;
        $this->task = (new Tasks())->byGuid($id)->getObjs(true)[$id];
    }

    public function getGuid()
    {
        return $this->taskId;
    }

    public function loadUsersList()
    {
        $this->executorsList .= "<option value=\"none\">Не назначать</option>";
        $executors = (new Users())->find('role', User::EXECUTOR)->getObjs();
        foreach ($executors as $user) {
            $tasksCounter = 0;
            $ownTasks = (new Tasks())->find('executor', $user->login)->getObjs();
            $selected = '';
            if ($this->task->executor === $user->login) {
                $selected .= 'selected';
            }
            foreach ($ownTasks as $task) {
                if ($task->status === Task::STATUS_NEW || $task->status === Task::STATUS_REJECTED) {
                    $tasksCounter++;
                }
            }
            $fullName = $user->name . ' ' . $user->surname;
            $this->executorsList .= "<option value=\"$user->login\" $selected >$fullName ($tasksCounter)</option>";
        }
        return $this->executorsList;
    }

    public function loadContent()
    {
        $result = "
            <label for=\"original_text\">Язык оригинала</label>
            <textarea id=\"original_text\" name=\"original_text\">" . $this->task->content->original . "</textarea>"
            . PHP_EOL;
        foreach ($this->task->langTarget as $lang) {
            $result .= "
            <label for=\"text_$lang\">$lang</label>
            <textarea id=\"text_$lang\" name=\"$lang\">" . $this->task->content->{$lang} . "</textarea>"
            . PHP_EOL;
        }
        return $result;
    }

    public function loadClient()
    {
        return $this->task->client;
    }

    public function loadDeadline()
    {
        $result = $this->task->deadline;
        if (!$this->access) {
             $result = "<div class=\"input_field\">$result</div>";
        }
        return $result;
    }

    private function toParseLangs(): array
    {
        return explode(' ', $this->task->langTarget);
    }

    public function loadLangOrig()
    {
        $result = '';
        if ($this->access) {
            foreach (Config::get()->availableLang as $item => $value) {
                $checked = '';
                if ($this->task->langOriginal === $item) {
                    $checked = 'checked';
                }
                $result .= "
                <label class=\"label-radio\">
                    <input class=\"radio\" type=\"radio\" value=\"$item\" name=\"original\" $checked>
                    $value
                </label>" . PHP_EOL;
            }
        } else {
            $lang = $this->task->langOriginal;
            $result .= "<div>$lang</div>";
        }

        return $result;
    }

    public function loadLangTarget()
    {
        $result = '';
        if ($this->access) {
            foreach (Config::get()->availableLang as $item => $value) {
                $checked = '';
                if (in_array($item, $this->task->langTarget)) {
                    $checked = 'checked';
                }
                $result .= "
                <label class=\"label-checkbox\">
                    <input class=\"checkbox\" type=\"checkbox\" value=\"$item\" name=\"target[]\" $checked>
                    $value
                </label>" . PHP_EOL;
            }
        } else {
            $lang = implode(' ', $this->task->langTarget);
            $result .= "<div>$lang</div>";
        }
        return $result;
    }

    public function loadButtonReject()
    {
        return $this->access
            ? "<button class=\"btn\" id=\"btn_refactor\" name=\"refactor\">Доработать</button>"
            : '';
    }

    public function loadButtonsMain()
    {
        $outPut = "
            <button class=\"btn\" id=\"btn_done\" name=\"done\">Готово</button>
            <button class=\"btn\" id=\"btn_save\" name=\"save\">Сохранить</button>";
        if ($this->task->status === Task::STATUS_DONE) {
            $outPut = '';
        }
        return $outPut;
    }
}