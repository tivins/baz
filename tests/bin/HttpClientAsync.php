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
