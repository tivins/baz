<?php

namespace Tivins\Baz\App;

use Tivins\Core\Code\Singleton;
use Tivins\Database\Database;

class App extends Singleton
{
    private Database $database;
    private float    $timeStart = 0;
    private AppState $state;
    private string   $rootDir;

    protected function __construct()
    {
        parent::__construct();
        $this->timeStart = microtime(true);
    }

    public function getTimeStart(): float
    {
        return $this->timeStart;
    }

    public function setDatabase(Database $database): static
    {
        $this->database = $database;
        return $this;
    }

    public function getState(): AppState
    {
        return $this->state;
    }

    public function setState(AppState $state): static
    {
        $this->state = $state;
        return $this;
    }

    public function db(): Database
    {
        return $this->database;
    }

    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    public function setRootDir(string $rootDir): static
    {
        $this->rootDir = $rootDir;
        return $this;
    }

}