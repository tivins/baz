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
