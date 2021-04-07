<?php
class File
{
    public $name;
    public $path;
    public $commands_list;

    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->commands_list = [];
    }
    public function readInputfile()
    {
        $file_data = file_get_contents($this->path . $this->name);
        $this->$commands_list = explode(PHP_EOL, $file_data);
        return true;
    }
    public function getCommandList()
    {
        $this->readInputfile();
        return $this->$commands_list;
    }
}
