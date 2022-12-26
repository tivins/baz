# Baz\Core

NB: outputs are stored at pre-commit time.

## HTTP Client (`Tivins\Baz\Core\Net\Client`)

* [Minimal](#minimal)
* [Post + Token Bearer](#post--token-bearer)
* [Asynchronous](#asynchronous)


### Minimal



```php
<?php

use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientException;

require 'vendor/autoload.php';

try {
    $client = (new Client('https://httpbin.org/anything'))->execute();
}
catch (ClientException $ex) {
    exit($ex->client . ' : ' . $ex->getMessage() . "\n");
}

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL;
echo $client->getContent(), PHP_EOL;
```
<details><summary>See output</summary>

```
Tivins\Baz\Core\Net\Client#4 200 (497)
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
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:101.0) Gecko/xx.xx.xx.xx Firefox/101.0", 
    "X-Amzn-Trace-Id": "Root=xx.xx.xx.xxb-786fdxx.xx.xx.xxbxx.xx.xx.xx"
  }, 
  "json": null, 
  "method": "GET", 
  "origin": "xx.xx.xx.xx", 
  "url": "https://httpbin.org/anything"
}

```
</details>


### Post + Token Bearer



```php
<?php

use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientException;
use Tivins\Baz\Core\Net\Http\Header;
use Tivins\Baz\Core\Net\Http\Headers;

require 'vendor/autoload.php';

$token = 'a-token-from-elsewhere';

$headers = (new Headers())
    ->setHeader(Header::Authorization, 'Bearer ' . $token);

try {
    $client = (new Client('https://httpbin.org/anything'))
        ->setHeaders($headers)
        ->postJSON(['yo' => 'lo'])
        ->execute();
}
catch (ClientException $e) {
    exit($e->client . ' ' . $e->getMessage() . "\n");
}

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL;
echo $client->getContent(), PHP_EOL;
```
<details><summary>See output</summary>

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
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:101.0) Gecko/xx.xx.xx.xx Firefox/101.0", 
    "X-Amzn-Trace-Id": "Root=xx.xx.xx.xxb-1cf5a2cc3ddeea2a1630bb96"
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
<?php
use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientMulti;
use Tivins\Baz\Core\Net\Http\Header;
use Tivins\Baz\Core\Net\Http\Headers;

require 'vendor/autoload.php';

$client = (new \Tivins\Baz\Core\Net\ClientAsync('https://httpbin.org/anything'))
    ->setProgressCallback(function(ClientMulti $client, float $duration) {
        echo "$client => ".number_format($duration,1)."s\n";
    })
    ->postJSON(['yo'=>'lo'])
    ->execute();

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL,
$client->getContent(), PHP_EOL;
```
<details><summary>See output</summary>

```
Tivins\Baz\Core\Net\ClientMulti#5 => 0.0s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.1s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.2s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.3s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.4s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.5s
Tivins\Baz\Core\Net\ClientMulti#5 => 0.6s
Tivins\Baz\Core\Net\ClientAsync#4 200 (497)
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
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:100.0) Gecko/xx.xx.xx.xx Firefox/100.0", 
    "X-Amzn-Trace-Id": "Root=xx.xx.xx.xxc-03bce492742dfd8f421ef82b"
  }, 
  "json": null, 
  "method": "GET", 
  "origin": "xx.xx.xx.xx", 
  "url": "https://httpbin.org/anything"
}

```
</details>
