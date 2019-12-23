<?php

class PageNew extends Page
{
    private $executorsList;

    public function loadUsersList()
    {
        $executors = (new Users())->find('role', User::EXECUTOR)->getObjs();
        foreach ($executors as $user) {
            $tasksCounter = 0;
            foreach ((new Tasks())->find('executor', $user->login)->getObjs() as $task) {
                if ($task->status === Task::STATUS_NEW || $task->status === Task::STATUS_REJECTED) {
                    $tasksCounter++;
                }
            }
            $fullName = $user->name . ' ' . $user->surname;
            $this->executorsList .= "<option value=\"$user->login\">$fullName ($tasksCounter)</option>" . PHP_EOL;
        }
        return $this->executorsList;
    }

    public function loadLangOrig()
    {
        $result = '';
        foreach (Config::get()->availableLang as $item => $value) {
            $checked = '';
            if ($item === 'EN') {
                $checked = 'checked';
            }
            $result .= "
                <label class=\"label-radio\">
                    <input class=\"radio\" type=\"radio\" value=\"$item\" name=\"original\" $checked>
                    $value
                </label>" . PHP_EOL;
        }
        return $result;
    }

    public function loadLangTarget()
    {
        $result = '';
        foreach (Config::get()->availableLang as $item => $value) {
            $result .= "
                <label class=\"label-checkbox\">
                    <input class=\"checkbox\" type=\"checkbox\" value=\"$item\" name=\"target[]\">
                    $value
                </label>" . PHP_EOL;
        }
        return $result;
    }
}