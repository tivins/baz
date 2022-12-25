<?php

namespace Tivins\Baz\Core\Net\Http;

class Headers
{
    private array $headers = [];

    public function setHeader(Header $header, string $value): static {
        $this->headers[$header->value] = $value;
        return $this;
    }

    /**
     * @return array[string]=string
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

}