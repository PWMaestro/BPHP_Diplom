<?php

class FileAccessModel
{
    protected $fileName;
    protected $file;

    public function __construct($name)
    {
        $this->fileName = Config::get()->path['db'] . $name . '.json';
    }

    private function connect()
    {
        $this->file = fopen($this->fileName, 'r+');
    }

    private function disconnect()
    {
        fclose($this->file);
    }

    public function read()
    {
        $this->connect();
        $contentJSON = fread($this->file, filesize($this->fileName));
        $this->disconnect();
        return $contentJSON;
    }

    public function write($contentJSON)
    {
        $this->connect();
        ftruncate($this->file, 0);
        fwrite($this->file, $contentJSON);
        $this->disconnect();
    }
}
