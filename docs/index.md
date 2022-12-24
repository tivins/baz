# Baz

## Install

```shell
cd path/to/new/project
composer init
composer require tivins/baz-core dev-main
mkdir src/app
```

### Create Schema
```php
namespace MyNamespace;

use Tivins\baz\install\schema\Table;
use Tivins\baz\install\schema\Field;

class Schema extends \Tivins\baz\install\schema\Schema 
{
    public function build(): static
    {
        $this->setNamespace('myApp', 'Short description of myApp.');
        
        // Generic modules
        $this->setMembers(...DRM::getModuleUser());
        $this->setMembers(DRM::getModuleTranslation());
        
        // App-specific modules
        $this->setMembers(
            $this->createTableExample(),
            // ...
        );
    }

    public function createTableExample(): Table
    {
        $id = Field::newSerial('id');
        $name = Field::newString('name', 32)->setNotEmpty();
        return (new Table('examples', 'Example'))
            ->addFields($id, $name)
            ->setPrimaryKey($id);
    }
}
```
### Create Installer

```php
namespace MyNamespace;

class Installer extends \Tivins\baz\core\install\Installer
{
    protected function install(): void
    {
        (new Example())
            ->set_name("test")
            ->save();
    }
}
```

### Create Host configuration

For host `http://my-app.test:9991`,<br> 
create a file : `${ROOT}/config/my-app.test:9991.php`
```php
<?php

use Tivins\app\install\Installer;
use Tivins\app\Schema;
use Tivins\baz\App;
use Tivins\baz\DB;

App::start(historize: true, log_dir: APP_ROOT . '/logs');
DB::initMariaDB('my_project', 'root', 'some-password');
App::setSchemaClass(Schema::class);
App::setModelsFilename(APP_ROOT . '/db_objs.php');
App::setInstallerClass(Installer::class);
const DEBUG = false;
```

### Bootstrap

in `${ROOT}/boot.php`

```php
<?php
use Tivins\baz\App;
const APP_ROOT = __dir__;
require_once APP_ROOT . '/vendor/autoload.php';
App::loadConfig();
if ( !defined('APP_INSTALL')) {
    require App::getModelsFilename();
}
```