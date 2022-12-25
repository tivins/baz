# Baz Core

## HTTP Client

### Synchronous
```php
use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientException;
try {
    $client = (new Client("https://example.com"))->execute();
}
catch (ClientException $ex) {
    echo "Failed : {$ex->client}\n-> {$ex->getMessage()}\n";
    exit(1);
}
var_dump($client->getCode(),$client->getContent());
```
### Asynchronous
```php
use Tivins\Baz\Core\Net\ClientAsync;
use Tivins\Baz\Core\Net\ClientException;
use Tivins\Baz\Core\Net\ClientMulti;
try {
    $client = (new Client("https://example.com"))
        ->setProgressCallback(function(ClientMulti $client, float $duration) {
            echo "$client => $duration\n"; 
        })
        ->execute();
}
catch (ClientException $ex) {
    echo "Failed : {$ex->client}\n-> {$ex->getMessage()}\n";
    exit(1);
}
var_dump($client->getCode(),$client->getContent());
```