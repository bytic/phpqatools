<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Tests\src\Tools;

use Bytic\Phpqa\Tools\PhpStan\PhpStanDetector;
use Bytic\Phpqa\Tools\Psalm\PsalmDetector;
use Composer\Composer;
use Composer\Config;
use PHPUnit\Framework\TestCase;

class ToolDetectorTest extends TestCase
{
    public function testDetectorsUseTheirOwnConfigurationFiles(): void
    {
        $rootPath = sys_get_temp_dir() . '/phpqatools-' . bin2hex(random_bytes(8));
        mkdir($rootPath . '/vendor', 0777, true);

        $config = new Config(false);
        $config->merge(['config' => ['vendor-dir' => $rootPath . '/vendor']]);

        $composer = new Composer();
        $composer->setConfig($config);

        try {
            file_put_contents($rootPath . '/psalm.xml.dist', '<psalm/>');

            self::assertTrue(PsalmDetector::detectFromComposer($composer));
            self::assertFalse(PhpStanDetector::detectFromComposer($composer));

            file_put_contents($rootPath . '/phpstan.neon.dist', "parameters: []\n");

            self::assertTrue(PhpStanDetector::detectFromComposer($composer));
        } finally {
            unlink($rootPath . '/psalm.xml.dist');
            unlink($rootPath . '/phpstan.neon.dist');
            rmdir($rootPath . '/vendor');
            rmdir($rootPath);
        }
    }
}
