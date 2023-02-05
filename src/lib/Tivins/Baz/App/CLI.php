<?php

namespace Tivins\Baz\App;

use Composer\Autoload\ClassLoader;
use Tivins\Core\OptionArg;
use Tivins\Core\OptionsArgs;

class CLI
{
    /**
     * Initialize the application for CLI program.
     *
     *     $opts = OptionsArgs::newParsed(CLI::getURIOption());
     *     CLI::bootstrap($opts);
     *
     * * Parse options and detect `--uri` required argument.
     * * Defines the `$_SERVER['HTTP_HOST']` super-global.
     * * Loads the proper setting file.
     * * Call bootstrap program.
     */
    public static function bootstrap(OptionsArgs $args): void
    {
        $uri = $args->getValue('uri');
        if (empty($uri)) {
            die("Argument is missing : --uri, -u\n");
        }
        $_SERVER['HTTP_HOST'] = $uri;
        $rootDir              = realpath(key(ClassLoader::getRegisteredLoaders()) . '/..');
        $bootFile = rtrim($rootDir, '/') . '/boot.php';
        if (!file_exists($bootFile)) {
            die("'/boot.php' is missing. Check your configuration.\n");
        }
        require $bootFile;
    }

    /**
     * Returns the option for the URI (`--uri`, `-u`) to use in CLI scripts.
     */
    public static function getURIOption(): OptionArg
    {
        return new OptionArg('uri', true, 'u');
    }
}