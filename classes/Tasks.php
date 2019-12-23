<?php

class Tasks extends JsonDataArray
{
    public function getTaskById($id)
    {
        foreach ($this->newQuery()->getObjs(true) as $guid => $obj) {
            if ($id === $guid) {
                return $obj;
            }
        }
        return false;
    }
}