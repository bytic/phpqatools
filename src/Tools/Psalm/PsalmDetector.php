<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Tools\Psalm;

use Composer\Composer;

class PsalmDetector
{
    public static function detectFromComposer(Composer $composer): bool
    {
        $rootPath = rtrim(dirname($composer->getConfig()->get('vendor-dir')), '/');

        return is_file($rootPath . '/psalm.xml')
            || is_file($rootPath . '/psalm.xml.dist');
    }
}
