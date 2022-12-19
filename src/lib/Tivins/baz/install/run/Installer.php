<?php

namespace Tivins\baz\install\run;

use Tivins\baz\app\App;

abstract class Installer
{
    abstract protected function install(): void;

    public function run(): void
    {
        $this->install();
        $this->log('Finished in : ' . round(microtime(true) - App::getTimeStart(), 2) . 's');
    }

    protected function log(string $message): void
    {
        echo " > $message\n";
    }
}