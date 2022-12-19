<?php

namespace Tivins\baz\core\net\http;

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers
 */
enum Header: string
{
    case Accept = 'Accept';
    case Location = 'Location';
    case Cookie = 'Cookie';
    case Authorization = 'Authorization';
    case ContentType = 'Content-Type';
    case ContentDisposition = 'Content-Disposition';
    case ContentLocation = 'Content-Location';
}
