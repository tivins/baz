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
    }

    /**
     * @param array $conf
     * @return void
     */
    public function buildSettings(array $conf = []): void
    {
        $conf += [
            'host' => 'example.com:8080',
            'site_name' => 'site_name',
            'db_name' => 'db_name',
            'db_user' => 'db_user',
            'db_pass' => 'db_pass',
            'db_host' => 'db_host',
        ];

        $configFile = ROOT_PATH . '/settings/' . $conf['host'] . '.php';

        $code       = '<?' . "php

use Tivins\Assets\Components\Icon;
use Tivins\Assets\Website;
use Tivins\Baz\App\App;
use Tivins\Database\Connectors\MySQLConnector;
use Tivins\Database\Database;

/** @noinspection PhpUnhandledExceptionInspection */
App::getInstance()->setDatabase(new Database(
    new MySQLConnector('{$conf['db_name']}', '{$conf['db_user']}', '{$conf['db_pass']}', '{$conf['db_host']}')
));

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

        $code = '<?'.'php'."\n
require __dir__ . '/vendor/autoload.php';
// Baz::bootstrap();
if (!isset(\$_SERVER['HTTP_HOST'])) {
    die('Bad configuration: Host is missing.');
}
require __dir__ . '/settings/' . \$_SERVER['HTTP_HOST'] . '.php';

";

        File::save($outFile, $code);
    }

}