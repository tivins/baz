<?php

namespace Tivins\Baz\App;

enum AppState
{
    case DEVEL;
    case PREPROD;
    case PROD;
}