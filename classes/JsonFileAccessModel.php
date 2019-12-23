<?php

class JsonFileAccessModel extends FileAccessModel
{
    public function readJson()
    {
        return json_decode($this->read());
    }

    public function writeJson($content)
    {
        $this->write(json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}