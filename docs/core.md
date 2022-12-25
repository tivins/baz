# Baz Core

## HTTP Client

### Synchronous

* [Minimal](#minimal)
* [Post + Token Bearer](#post-token-bearer)

#### Minimal



```php
<?php

use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientException;

require 'vendor/autoload.php';

try {
    $client = (new Client('https://httpbin.org/anything'))->execute();
} catch (ClientException $ex) {
    exit($ex->client . ' : ' . $ex->getMessage() . "\n");
}

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL,
    $client->getContent(), PHP_EOL;
```
<details><summary>See the response result</summary>

output:
```
Tivins\Baz\Core\Net\Client#4 200 (495)
{
  "args": {}, 
  "data": "", 
  "files": {}, 
  "form": {}, 
  "headers": {
    "Accept": "*/*", 
    "Content-Length": "0", 
    "Content-Type": "application/x-www-form-urlencoded", 
    "Host": "httpbin.org", 
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:98.0) Gecko/xx.xx.xx.xx Firefox/98.0", 
    "X-Amzn-Trace-Id": "Root=xx.xx.xx.xxd-661d02dexx.xx.xx.xxea7f"
  }, 
  "json": null, 
  "method": "GET", 
  "origin": "xx.xx.xx.xx", 
  "url": "https://httpbin.org/anything"
}

```
</details>


#### Post + Token Bearer



```php
<?php
use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\Http\Header;
use Tivins\Baz\Core\Net\Http\Headers;

require 'vendor/autoload.php';

$token = 'a-token-from-elsewhere';

$headers = (new Headers())
    ->setHeader(Header::Authorization, 'Bearer ' . $token);

$client = (new Client('https://httpbin.org/anything'))
    ->setHeaders($headers)
    ->postJSON(['yo'=>'lo'])
    ->execute();

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL,
$client->getContent(), PHP_EOL;
```
<details><summary>See the response result</summary>

output:
```
Tivins\Baz\Core\Net\Client#21 200 (568)
{
  "args": {}, 
  "data": "{\"yo\":\"lo\"}", 
  "files": {}, 
  "form": {}, 
  "headers": {
    "Accept": "*/*", 
    "Authorization": "Bearer a-token-from-elsewhere", 
    "Content-Length": "11", 
    "Content-Type": "application/json", 
    "Host": "httpbin.org", 
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/xx.xx.xx.xx Firefox/108.0", 
    "X-Amzn-Trace-Id": "Root=xx.xx.xx.xxe-xx.xx.xx.xxeefxx.xx.xx.xxe"
  }, 
  "json": {
    "yo": "lo"
  }, 
  "method": "POST", 
  "origin": "xx.xx.xx.xx", 
  "url": "https://httpbin.org/anything"
}

```
</details>


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