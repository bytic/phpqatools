<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;


use Composer\Composer;

/**
 *
 */
class Configuration
{
    public function __construct(
        private readonly Composer $composer,
        private readonly string $commandPrefix,
        private readonly string $repositoryRoot
    ) {
    }
}