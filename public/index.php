<?php

use App\Kernel;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// init file system
$filesystem = new Filesystem();

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
