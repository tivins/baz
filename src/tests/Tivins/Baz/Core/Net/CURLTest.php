<?php

namespace Tivins\Baz\Core\Net;

use PHPUnit\Framework\TestCase;
use Tivins\Baz\Core\Cache\Cache;
use Tivins\Baz\Core\Cache\FileCache;

class CURLTest extends TestCase
{
    public function testSimple() {

        $client = (new Client('https://httpbin.org/anything'))->execute();
        self::assertEquals(200, $client->getCode());
    }

    public function _testCachedAsyncFast()
    {
        $cache = new FileCache('/tmp/tmp');

        $progress = function(ClientAsync $client, float $duration) {
            // do something
        };

        (new ClientAsync('https://example.com', $cache, 3600))
            ->setProgressCallback($progress)
            ->execute();
        (new ClientAsync('https://example.com', $cache, 3600))
            ->setProgressCallback($progress)
            ->execute();

    }
    public function _testAsync()
    {
        $cache = new FileCache('/tmp/tmp');


        $client = new Client('https://example.com');
        $client->setCache($cache);
        if ($client->execute()) {
            var_dump($client->getCode());
        }
        $client = new Client('https://example.com');
        $client->setCache($cache, Cache::Unlimited);
        if ($client->execute()) {
            var_dump($client->getCode());
        }
        return;

        $prog = [];
        (new ClientMulti())->addClients('https://example.com')
            ->setProgressCallback(function (ClientMulti $curl, float $duration) use (&$prog) {
                $prog[] = 'Progress ' . round($curl->getProgress() * 100) . "% / ($duration s.)";
            })
            ->execute();
        //
        var_dump($prog);
    }
    public function _testMulti()
    {
        $cache = new FileCache('/tmp/tmp');

        $messages = '';
        $curl     = (new ClientMulti())
            ->setCache($cache, Cache::Unlimited)
            ->addClients(
                'http://localhost',
                (new Client('https://example.com'))->setCache($cache, 3600),
                'this-is-a-bad-url'
            )
            ->setProgressCallback(function (ClientMulti $curl, float $duration) use (&$messages) {
                $messages .= "Progress " . round($curl->getProgress() * 100) . "% / ($duration s.)" . PHP_EOL;
            })
            ->setReceiveCallback(function (ClientMulti $curl, Client $client) use (&$messages): void {
                $messages .= "Client: " . $client->getURL() . ' : ' . $client->getCode() . " (" . strlen($client->getContent()) . ")" . PHP_EOL;
            });
        $duration = $curl->execute();
        //
        //var_dump(shell_exec('ls -alR /tmp/tmp'));
        //
        //
        $curl     = (new ClientMulti())
            ->setCache($cache, Cache::Unlimited)
            ->addClients(
                'http://localhost',
                (new Client('https://example.com'))->setCache($cache, 3600),
                'this-is-a-bad-url'
            )
            ->setProgressCallback(function (ClientMulti $curl, float $duration) use (&$messages) {
                $messages .= 'Progress ' . round($curl->getProgress() * 100) . "% / ($duration s.)" . PHP_EOL;
            })
            ->setReceiveCallback(function (ClientMulti $curl, Client $client) use (&$messages): void {
                $messages .= 'Client: ' . $client->getURL() . ' : ' . $client->getCode() . ' (' . strlen($client->getContent()) . ')' . PHP_EOL;
            });
        $duration = $curl->execute();
        //
        //
        //
        self::assertGreaterThan(0, $duration);
        self::assertTrue(str_contains($messages, "Progress 0%"));
        self::assertTrue(str_contains($messages, "Progress 100%"));
        self::assertTrue(str_contains($messages, "https://example.com : 200 (1256)"));
        self::assertEquals(200, $curl->getClientByURL('https://example.com')->getCode());
        self::assertEquals(0, $curl->getClientByURL('this-is-a-bad-url')->getCode());
    }
}
