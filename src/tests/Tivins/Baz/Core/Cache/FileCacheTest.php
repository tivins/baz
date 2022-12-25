<?php

namespace Tivins\Baz\Core\Cache;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class FileCacheTest extends TestCase
{
    public function testMain()
    {
        $exKey = 'a simple key';
        $cache = new FileCache('/tmp/tmp');
        $cache->delete($exKey);
        // var_dump(shell_exec('ls -al /tmp/tmp/32'));
        $cache->set($exKey, new CacheItem("test"));
        // var_dump(shell_exec('ls -al /tmp/tmp/32'));
        assertEquals('test', $cache->get($exKey)->data);
        assertEquals('test', $cache->get($exKey, 1)->data);
        assertEquals('test', $cache->get($exKey, 10)->data);
        sleep(2);
        assertNull($cache->get($exKey, 1));
        assertNull($cache->get($exKey, Cache::None));
    }

    public function testMainMeta()
    {
        $exKey = 'a simple key';
        $meta = ['a'=>123];
        $cache = new FileCache('/tmp/tmp');
        $cache->set($exKey, new CacheItem('test', $meta));
        // var_dump(shell_exec('ls -al /tmp/tmp/32'));
        assertEquals('test', $cache->get($exKey)->data);
        assertEquals($meta, (array)$cache->get($exKey)->meta);
        assertEquals('test', $cache->get($exKey, 10)->data);
        sleep(2);
        assertEquals('test', $cache->get($exKey, 30)->data);
        assertNull($cache->get($exKey, 1));
    }
}
