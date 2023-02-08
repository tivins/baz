<?php

namespace Tivins\Baz\Install\Run;

use Tivins\Core\Code\Singleton;
use Tivins\Core\System\File;

class Baz extends Singleton
{
    public function install(array $conf = []): void
    {
        $this->buildSettings($conf);
        $this->buildBootstrap($conf);
        $this->buildIndex($conf);
    }

    /**
     * @param array $conf
     * @return void
     */
    public function buildSettings(array $conf = []): void
    {
        $db = json_decode($conf['db']);
        $conf += [
            'uri' => 'example.com:8080',
            'site_name' => 'site_name',
            'db_name' => $db[0],
            'db_user' => $db[1],
            'db_pass' => $db[2],
            'db_host' => $db[3],
        ];

        $configFile = ROOT_PATH . '/settings/' . $conf['uri'] . '.php';

        $code       = '<?' . "php

use Tivins\Assets\Components\Icon;
use Tivins\Assets\Website;
use Tivins\Baz\App\App;
use Tivins\Baz\App\AppState;
use Tivins\Database\Connectors\MySQLConnector;
use Tivins\Database\Database;

\$baz = App::getInstance(); 
/** @noinspection PhpUnhandledExceptionInspection */
\$baz->setDatabase(new Database(
    new MySQLConnector('{$conf['db_name']}', '{$conf['db_user']}', '{$conf['db_pass']}', '{$conf['db_host']}')
));
\$baz->setState(AppState::DEVEL);

Website::setRootURL('/');
Website::setTitle('{$conf['site_name']}');
Website::setIcon(new Icon('lemon', true));

// App::setSchemaClass(Schema::class);
// App::setModelsFilename(APP_ROOT . '/db_objs.php');
// App::setInstallerClass(Installer::class);
";
        File::save($configFile, $code);
    }

    private function buildBootstrap(array $conf = []): void
    {
        $outFile = ROOT_PATH . '/boot.php';

        $code = '<?'.'php'."\n"
            . 'use Tivins\Assets\Assets;' . "\n"
            . 'use Tivins\Baz\App\App;' . "\n"
            . "
set_error_handler(function (int \$errno, string \$errStr) {
    return true; # catch error
});
set_exception_handler(function (Throwable \$ex) {
    exit('ERROR:' . \$ex->getMessage());
});

if (!isset(\$_SERVER['HTTP_HOST'])) {
    die('Bad configuration: HTTP_HOST is missing.');
}

require __dir__ . '/vendor/autoload.php';
App::getInstance()->setRootDir(__dir__);
require __dir__ . '/settings/' . \$_SERVER['HTTP_HOST'] . '.php';
Assets::compile(__dir__ . '/public');

";

        File::save($outFile, $code);
    }

    private function buildIndex(array $conf)
    {
        $outFile = ROOT_PATH . '/public/index.php';
        $code = '<?'.'php'."\n";
        $code .= '
use Tivins\Assets\Box;
use Tivins\Assets\Size;
use Tivins\Assets\Structures\Page;

require __dir__ . \'/../boot.php\';

$content = (new Box())->setTitle(\'Hello World\')->addBodyClasses(\'p\')->addText(\'From Baz\');
echo (new Page(\'Hello World\', Size::LG))->setContent($content);
        ';
        File::save($outFile, $code);
    }

}