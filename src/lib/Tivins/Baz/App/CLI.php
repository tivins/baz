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
     * Retourne l'option pour l'URI (`--uri`, `-u`) à utiliser dans les scripts CLI.
     */
    public static function getURIOption(): OptionArg
    {
        return new OptionArg('uri', true, 'u');
    }
}