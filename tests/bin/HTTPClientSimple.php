<?php

use Tivins\Baz\Core\Net\Client;
use Tivins\Baz\Core\Net\ClientException;

require 'vendor/autoload.php';

try {
    $client = (new Client('https://example.com'))->execute();
} catch (ClientException $ex) {
    exit($ex->client." : ". $ex->getMessage()."\n");
}

echo $client . ' ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')', PHP_EOL;
echo $client->getContent()."\n";
