<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Fix;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Bytic\Phpqa\Composer\Command\NamespaceCommands\IsNamespaceChildCommand;

/**
 *
 */
class FixCommand extends NamespaceCommand
{
    use IsNamespaceChildCommand;

    public const NAMESPACE_NAME = self::FIX;

    protected function configure(): void
    {
        parent::configure();
        $this->configureNamespaceCommandOption();
    }

}