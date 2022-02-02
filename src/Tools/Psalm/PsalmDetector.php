<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Tools\Psalm;

use Composer\Composer;

class PsalmDetector
{
    public static function detectFromComposer(Composer $composer): bool
    {
        $rootPath = rtrim(dirname($composer->getConfig()->get('vendor-dir')), '/');

        if (file_exists($rootPath . '/psalm.xml')) {
            return true;
        }

        return false;
    }
}
