<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Tools\PhpStan;

use Composer\Composer;

class PhpStanDetector
{
    public static function detectFromComposer(Composer $composer): bool
    {
        $rootPath = rtrim(dirname($composer->getConfig()->get('vendor-dir')), '/');

        return is_file($rootPath . '/phpstan.neon')
            || is_file($rootPath . '/phpstan.neon.dist');
    }
}
