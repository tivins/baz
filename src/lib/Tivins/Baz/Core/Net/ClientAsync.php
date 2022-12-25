<?php

namespace Tivins\Baz\Core\Net;

use Tivins\Baz\Core\Cache\Cache;

class ClientAsync extends Client
{
    private ClientMulti $multi;

    public function __construct(string $url, ?Cache $cache = null, int $cacheLifeTime = Cache::None)
    {
        parent::__construct($url, $cache, $cacheLifeTime);
        $this->multi = new ClientMulti($cache, $cacheLifeTime);
        $this->multi->addClients($this);
    }

    public function setProgressCallback(callable|null $callback): static
    {
        $this->multi->setProgressCallback($callback);
        return $this;
    }

    public function execute(): static
    {
        $this->duration = $this->multi->execute();
        return $this;
    }
}
