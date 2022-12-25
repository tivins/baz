# Baz Core

## HTTP Client

### Synchronous

* [Minimal](#minimal)
* [Post + Token Bearer](#post-token-bearer)

#### Minimal

{{{ HttpClientBasic }}}

#### Post + Token Bearer

{{{ HttpClientAuth }}}

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