<?php

abstract class Model
{
    protected $db;

    public function __construct($config = array())
    {
        date_default_timezone_set('Europe/Moscow');
        DB::getInstance()->Connect($config["login"], $config["password"], $config["database"]);
    }

    abstract function set($arguments);
    abstract function execute();
    abstract function get();
}