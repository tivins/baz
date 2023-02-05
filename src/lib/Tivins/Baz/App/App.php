<?php

namespace Tivins\Baz\App;

use Tivins\Core\Code\Singleton;
use Tivins\Database\Database;

class App extends Singleton
{
    private Database $database;
    private float $timeStart = 0;

    protected function __construct()
    {
        parent::__construct();
        $this->timeStart = microtime(true);
    }

    public function getTimeStart(): float
    {
        return $this->timeStart;
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    public function db(): Database
    {
        return $this->database;
    }

}