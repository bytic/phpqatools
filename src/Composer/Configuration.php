<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;


use Composer\Composer;

/**
 *
 */
class Configuration
{
    private Composer $composer;
    private string $commandPrefix;
    private string $repositoryRoot;

    public function __construct(
        Composer $composer,
        string $commandPrefix,
        string $repositoryRoot
    ) {
        $this->composer = $composer;
        $this->commandPrefix = $commandPrefix;
        $this->repositoryRoot = $repositoryRoot;
    }
}