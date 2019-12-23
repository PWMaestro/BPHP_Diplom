<?php

class PageMain extends Page
{
    private $access;
    private $tasksList;
    private $sortRequest;

    const PREVIEW_STRING_MAX_LENGTH = 180;

    const SORT_REQUEST_ALL = 0;
    const SORT_REQUEST_NEW = 1;
    const SORT_REQUEST_DONE = 2;
    const SORT_REQUEST_REJECTED = 3;
    const SORT_REQUEST_RESOLVED = 4;

    public function __construct()
    {
        parent::__construct();
        $this->setSortRequest();
        Authorization::init()->restrictAccessRights(true)
            ? $this->access = true
            : $this->access = false;
        $this->setTasksList();
    }

    private function setSortRequest()
    {
        if (!isset($_GET['show'])) {
            $this->sortRequest = self::SORT_REQUEST_ALL;
        } else {
            switch ($_GET['show']) {
                case 'new':
                    $this->sortRequest = self::SORT_REQUEST_NEW;
                    break;
                case 'resolved':
                    $this->sortRequest = self::SORT_REQUEST_RESOLVED;
                    break;
                case 'rejected':
                    $this->sortRequest = self::SORT_REQUEST_REJECTED;
                    break;
                case 'done':
                    $this->sortRequest = self::SORT_REQUEST_DONE;
                    break;
                default:
                    $this->sortRequest = self::SORT_REQUEST_ALL;
                    break;
            }
        }
    }

    private function setTasksList()
    {
        if ($this->access) {
            $this->tasksList = (new Tasks())
                ->orderBy('deadline')
                ->getObjs(true);
        } else {
            $this->tasksList = (new Tasks())
                ->orderBy('deadline')
                ->find('executor', $_SESSION['user']->login)
                ->getObjs(true);
        }
    }

    private function toCutOffContent($string)
    {
        if (mb_strlen($string) > self::PREVIEW_STRING_MAX_LENGTH) {
            return mb_substr($string, 0, self::PREVIEW_STRING_MAX_LENGTH) . ' ...';
        }
        return $string;
    }

    private function toSortByStatus()
    {
        $result = [];
        if ($this->sortRequest === self::SORT_REQUEST_ALL) {
            return $this->tasksList;
        } else {
            foreach ($this->tasksList as $guid => $task) {
                if ($task->status === $this->sortRequest) {
                    $result[$guid] = $task;
                }
            }
        }
        return $result;
    }

    public function displayTasksList()
    {
        $outPut = '';
        foreach ($this->toSortByStatus() as $id => $obj) {
            $content = $this->toCutOffContent($obj->content->original);
            $languages = implode(' ', $obj->langTarget);
            $buttonDelete = (new PageMain())->loadButtonDelete();
            $outPut .= "
					<li class=\"task_wrap\">
                        <form class=\"task\" action=\"index.php?page=edit\" method=\"post\">
                        <input name=\"guid\" value=\"$id\" hidden>
                            <header class=\"task_info\">
                                <div class=\"task_date\">$obj->deadline</div>
                                <div class=\"task_lang\">$languages</div>
                            </header>
                            <label>
                                <textarea name=\"text\" class=\"preview\" readonly>$content</textarea>
                            </label>
                            <footer class=\"task_controls\">
                                <button class=\"task_btn\" id=\"btn_change\" type=\"submit\" name=\"redact\">Редактировать</button>
                                $buttonDelete
                            </footer>
                        </form>
                    </li>
				";
        };
        echo $outPut;
    }

    public function loadButtonNew($request = 'index.php?page=new')
    {
        if ($this->access) {
            return "
                <li class=\"bar_item\" id=\"new_task\">
                    <a class=\"value\" href=\"$request\">+ Новое</a>
                    <div class=\"icon_wrap\"><img class=\"icon\" src=\"style/icons/create.png\" alt=\"+\"></div>
                </li>";
        }
        return '';
    }

    public function loadButtonDelete($action = 'formActions/deleteTask.php')
    {
        if ($this->access) {
            return "
                <button class=\"task_btn\" id=\"btn_delete\" name=\"delete\" formaction=\"$action\">
                    Удалить
                </button>";
        }
        return '';
    }
}