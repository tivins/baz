# Baz Framework

## Installation

### Create Schema
```php
namespace MyNamespace;

use Tivins\Baz\install\schema\Table;
use Tivins\Baz\install\schema\Field;

class Schema extends \Tivins\Baz\install\schema\Schema 
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

class Installer extends \Tivins\Baz\Core\install\Installer
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
use Tivins\Baz\App;
use Tivins\Baz\DB;

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
use Tivins\Baz\App;
const APP_ROOT = __dir__;
require_once APP_ROOT . '/vendor/autoload.php';
App::loadConfig();
if ( !defined('APP_INSTALL')) {
    require App::getModelsFilename();
}
```