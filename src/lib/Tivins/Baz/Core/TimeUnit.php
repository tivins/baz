<?php

namespace Tivins\Baz\Core;

enum TimeUnit
{
    case MICROSECOND;
    case MILLISECOND;
    case SECOND;
    case MINUTE;
    case HOUR;
    case DAY;
    case MONTH;
    case YEAR;
}