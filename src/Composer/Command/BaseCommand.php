<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

use Bytic\Phpqa\Composer\DevToolsPlugin;
use Composer\Command\BaseCommand as ComposerBaseCommand;

/**
 */
abstract class BaseCommand extends ComposerBaseCommand
{
    public function __construct(string $name = null)
    {
        $name = $name ?? $this->withPrefix($this->getBaseName());

        parent::__construct($name);
    }

    public function withPrefix(string $name): string
    {
        return $this->getPrefix() . ':' . $name;
    }

    public function getPrefix(): string
    {
        return DevToolsPlugin::$prefix;
    }
}