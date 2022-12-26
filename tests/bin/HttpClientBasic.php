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
